<template>
    <div class="container p-4">
        <bread-crumb />
        <access-denied v-if="!permission.up" />
        <div v-else class="card shadow-sm col-md-8">
            <div class="card-body">
                <h5 class="card-title">Site Ayarları</h5>
                <hr />
                <text-input
                    _type="text"
                    _id="blog_name"
                    _label="Site Adı:"
                    _name="blog_name"
                    @onChange="change"
                    :_value="settings.blog_name"
                />
                <text-input
                    _type="text"
                    _id="contact_email"
                    _label="İletişim Epostası:"
                    _name="contact_email"
                    @onChange="change"
                    :_value="settings.contact_email"
                />
                <file-input
                    _id="img"
                    _name="blog_logo"
                    _label="Site Logosu:"
                    @onChange="file"
                    :_src="src"
                />
            </div>
            <div class="form-group d-flex justify-content-end">
                <button
                    class="btn btn-success ml-2"
                    :disabled="isLoading"
                    @click="update"
                >
                    <i class="fa fa-floppy-o"></i> Kaydet
                </button>
                <router-link
                    class="btn btn-danger ml-2"
                    :to="{ name: 'settings' }"
                    ><i class="fa fa-times"></i> İptal</router-link
                >
            </div>
        </div>
    </div>
</template>
<script>
import BreadCrumb from "../../components/BreadCrumb";
import { mapGetters } from "vuex";
export default {
    components: {
        BreadCrumb
    },
    data() {
        return {
            isLoading: false,
            formImg: null,
            src: "",
            settings: {
                blog_name: "",
                contacat_email: "",
                blog_logo: ""
            }
        };
    },

    computed: {
        ...mapGetters(["getSettings"])
    },
    async created() {
        this.permission = Vue.checkPermission(this.$route.path.split("/"));
    },
    async beforeRouteEnter(to, from, next) {
        const res = await Vue.callApi("get", "/api/get_settings");
        if (res.status === 200) {
            next(vm => vm.setData(res.data));
        } else if (res.status === 403) {
            next(false);
        }
    },

    methods: {
        setData(data) {
            this.settings = data;
            this.$nextTick(function() {
                this.src = `/uploads/thumbnail/${data.blog_logo}`;
            });
        },
        change(data) {
            for (const [key, value] of Object.entries(this.settings)) {
                if (key === data.name) {
                    this.settings[key] = data.value;
                }
            }
        },
        file(data) {
            this.formImg = data;
        },
        async update() {
            const formData = new FormData();
            formData.append("blog_name", this.settings.blog_name);
            formData.append("contact_email", this.settings.contact_email);
            if (this.formImg) formData.append("blog_logo", this.formImg);
            let result = await this.$store.dispatch("editSettings", formData);
            if (result) this.$router.push({ name: "settings" });
        }
    }
};
</script>
