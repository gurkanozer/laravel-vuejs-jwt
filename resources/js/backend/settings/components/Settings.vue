<template>
    <div class="container p-4">
        <bread-crumb />
        <div class="card shadow-sm col-md-8">
            <div class="card-body">
                <div class="row d-flex justify-content-end">
                    <div class="form-group">
                        <router-link
                            :to="{ name: 'edit-settings' }"
                            class="btn btn-outline-primary m-3"
                        >
                            Genel Ayarlar
                        </router-link>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 text-right"> Site Adı: </label>
                    <p class="col-sm-8 text-left">
                        {{ getSettings.blog_name }}
                    </p>
                </div>
                <div class="row">
                    <label class="col-sm-4 text-right"> Eposta: </label>
                    <p class="col-sm-8 text-left">
                        {{ getSettings.contact_email }}
                    </p>
                </div>
                <div class="row">
                    <label class="col-sm-4 text-right"> Logo: </label>
                    <div class="col-sm-8">
                        <img
                            :src="'/uploads/thumbnail/' + getSettings.blog_logo"
                            style="width:50px height:50px"
                        />
                    </div>
                </div>
                <div class="row mt-4">
                    <table class="table">
                        <thead>
                            <th>Sayfa</th>
                            <th>Düzenle</th>
                        </thead>
                        <tbody>
                            <tr
                                v-for="(static_page, index) in getStaticPages"
                                :key="index"
                            >
                                <td>
                                    {{ static_page.title }}
                                </td>
                                <td>
                                    <router-link
                                        :to="{
                                            name: 'edit-static-pages',
                                            params: { id: static_page.id }
                                        }"
                                        class="btn btn-success btn-sm"
                                    >
                                        <i class="fa fa-edit"></i> Düzenle
                                    </router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
            settings: {
                blog_name: "",
                blog_logo: "",
                contact_email: ""
            }
        };
    },
    computed: {
        ...mapGetters(["getSettings", "getStaticPages"])
    },
    async created() {
        if (this.getSettings.length <= 0) this.$store.dispatch("getSettings");
        if (this.getStaticPages.length <= 0)
            this.$store.dispatch("getStaticPages");
    }
};
</script>
<style scoped>
@media (max-width: 768px) {
    label {
        text-align: left !important;
    }
}
</style>
