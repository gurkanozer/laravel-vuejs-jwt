<template>
  <div class="container p-4">
    <bread-crumb />
    <access-denied v-if="!permission.wr" />
    <Form v-else formTitle="Add User" :roles="getRoles" @onAction="create"/>
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
    AccessDenied,
  },
  methods: {
    async create(data) {
            const formData =  new FormData();
      formData.append('full_name',data.full_name)
      formData.append('email',data.email)
      formData.append('role_id',data.role_id)
      formData.append('id',data.id)
      formData.append('img',data.img)
      let result = await this.$store.dispatch("createUser", formData);
      if(result)
      this.$router.push({name:"list-users"})
    },
  },
  computed: {
    ...mapGetters(["getRoles"]),
  },
  async created() {
    if (this.getRoles.length <= 0) {
      this.$store.dispatch("getRoles");
    }
    this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
};
</script>