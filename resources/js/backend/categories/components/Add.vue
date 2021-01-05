<template>
  <div class="container p-4">
    <bread-crumb />
    <access-denied v-if="!permission.wr" />
    <Form v-else formTitle="Kategori Ekle" @onAction="create" />
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
    AccessDenied,
  },
  data() {
    return {
      permission: {}
    };
  },
  methods: {
    async create(data) {
      let result = await this.$store.dispatch("createCategory", data);
      if(result)
        this.$router.push({name:"list-categories"})
    }
  },
  async created() {
    this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
};
</script>
