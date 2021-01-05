<template>
    <div class="container p-4">
        <bread-crumb />
        <access-denied v-if="!permission.wr" />
        <Form v-else formTitle="Etiket Ekle" @onAction="create" />
    </div>
</template>
<script>
import Form from "./Form";
import BreadCrumb from "../../components/BreadCrumb";
import AccessDenied from "../../components/AccessDenied";
export default {
    components: {
        Form,
        BreadCrumb,
        AccessDenied
    },
    methods: {
        async create(data) {
            let reuslt = await this.$store.dispatch("createTag", data);
            if (result) this.$router.push({ name: "list-tags" });
        }
    },

    async created() {
        this.permission = Vue.checkPermission(this.$route.path.split("/"));
    }
};
</script>
