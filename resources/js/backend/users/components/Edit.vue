<template>
  <div class="container p-4">
    <bread-crumb />
    <access-denied v-if="!permission.up" />
    <Form v-else formTitle="Edit User" :roles="getRoles" :user="user" @onAction="update" />
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
      user: {},
    };
  },
  methods: {
    async setData(user) {
      this.user = user;
    },
    async update(data) {
      console.log(data)
      const formData =  new FormData();
      formData.append('full_name',data.full_name)
      formData.append('email',data.email)
      formData.append('role_id',data.role_id)
      formData.append('id',data.id)
      console.log(data.role_id)
      if(data.img)
      formData.append('img',data.img)
      let result = await this.$store.dispatch("editUser", formData);
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
  beforeRouteEnter(to, from, next) {
    const apiRes = Vue.callApi("get", `/api/get_users/${to.params.id}`);
    apiRes
      .then((res) => {
        if (res.status === 200) {
          next((vm) => vm.setData(res.data));
        }
      })
      .catch((err) => {
        if (res.status === 403) {
          next(false);
        }
      });
  },
};
</script>