<template>
    <div class="container p-4">
        <bread-crumb />
        <access-denied v-if="!permission.up" />
        <div v-else class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h5 class="card-title">{{ static_page.title }}</h5>
                        <hr />
                        <text-input
                            _type="text"
                            _id="display_name"
                            _label="Görünen Ad:"
                            _name="display_name"
                            @onChange="change"
                            :_value="static_page.display_name"
                        />
                        <text-area-input
                            _rows="3"
                            _label="Sayfa Mesajı:"
                            _name="message"
                            _id="message"
                            @onChange="change"
                            :_value="static_page.message"
                        />
                        <text-area-input
                            _rows="8"
                            _label="İçerik:"
                            _name="content"
                            _id="content"
                            @onChange="change"
                            :_value="static_page.content"
                        />
                        <file-input
                            _id="img"
                            _name="blog_logo"
                            _label="Site Logosu:"
                            @onChange="file"
                            :_src="src"
                        />
                    </div>
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
            static_page: {},
            src: ""
        };
    },

    computed: {
        ...mapGetters(["getStaticPages"])
    },

    async created() {
        this.permission = Vue.checkPermission(this.$route.path.split("/"));
    },
    async beforeRouteEnter(to, from, next) {
        const res = await Vue.callApi(
            "get",
            `/api/get_static_pages/${to.params.id}`
        );
        if (res.status === 200) {
            next(vm => vm.setData(res.data));
        } else if (res.status === 403) {
            next(false);
        }
    },
    methods: {
        setData(data) {
            this.static_page = data;
            this.$nextTick(function() {
                this.src = `/uploads/thumbnail/${data.img}`;
            });
        },
        change(data) {
            for (const [key, value] of Object.entries(this.static_page)) {
                if (key === data.name) {
                    this.static_page[key] = data.value;
                }
            }
        },
        file(data) {
            this.formImg = data;
        },
        async update() {
            const formData = new FormData();
            formData.append("id", this.static_page.id);
            formData.append("title", this.static_page.title);
            formData.append("display_name", this.static_page.display_name);
            formData.append("message", this.static_page.message);
            formData.append("content", this.static_page.content);
            if (this.formImg) formData.append("img", this.formImg);
            let result = await this.$store.dispatch(
                "editStaticPages",
                formData
            );
            if (result) this.$router.push({ name: "settings" });
        }
    }
};
</script>
