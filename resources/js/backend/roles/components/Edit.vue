<template>
  <div class="container p-4">
    <bread-crumb />
    <access-denied v-if="!permission.up" />
    <Form
      v-else
      formTitle="Kullanıcı Rolünü Düzenle"
      :role="role"
      @onAction="update"
    />
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
  data() {
    return {
      role: {},
    };
  },
  methods: {
    async setData(role) {
      this.role = role;
    },
    async update(data) {
      this.role = { ...this.role, title: data.title };
      let result = await this.$store.dispatch("editRole", this.role);
      if(result)
        this.$router.push({name:"list-roles"})
    },
  },
  async beforeRouteEnter(to, from, next) {
    const res = await Vue.callApi("get", `/api/get_roles/${to.params.id}`);
        if (res.status === 200) {
          next((vm) => vm.setData(res.data));
        }
        else if (res.status === 403) {
          next(false);
        }
  },

  async created() {
    this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
};
</script>
