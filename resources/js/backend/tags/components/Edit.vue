<template>
    <div class="container p-4">
        <bread-crumb />
        <access-denied v-if="!permission.up" />
        <Form v-else formTitle="Etiket Düzenle" :tag="tag" @onAction="update" />
    </div>
</template>
<script>
import Form from "./Form";
import BreadCrumb from "../../components/BreadCrumb";
import AccessDenied from "../../components/AccessDenied";
import { mapGetters } from "vuex";

export default {
    components: {
        Form,
        BreadCrumb,
        AccessDenied
    },
    data() {
        return {
            tag: {}
        };
    },
    methods: {
        async setData(tag) {
            this.tag = tag;
        },
        async update(data) {
            this.tag = { ...this.tag, title: data.title };
            let result = await this.$store.dispatch("editTag", this.tag);
            if(result)
                this.$router.push({name:"list-tags"})
        }
    },
    beforeRouteEnter(to, from, next) {
        const apiRes = Vue.callApi("get", `/api/get_tags/${to.params.id}`);
        apiRes
            .then(res => {
                if (res.status === 200) {
                    next(vm => vm.setData(res.data));
                }
            })
            .catch(err => {
                if (res.status === 403) {
                    next(false);
                }
            });
    },

    async created() {
        this.permission = Vue.checkPermission(this.$route.path.split("/"));
    }
};
</script>
