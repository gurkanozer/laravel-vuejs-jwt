<template>
  <div class="container p-4">
    <bread-crumb />
    <access-denied v-if="!permission.wr" />
    <Form v-else formTitle="Kullanıcı Rolü Ekle" @onAction="create" />
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
      defaultPermissions: [
        {
          resource_name: "profile",
          title: "Profile",
          re: true,
          wr: true,
          de: true,
          up: true,
        },        
        {
          resource_name: "dashboard",
          title: "Dashboard",
          re: true,
          wr: true,
          de: true,
          up: true,
        },
        {
          resource_name: "settings",
          title: "Settings",
          re: true,
          wr: true,
          de: true,
          up: true,
        },
        {
          resource_name: "static-pages",
          title: "Static Pages",
          re: true,
          wr: true,
          de: true,
          up: true,
        },          
        {
          resource_name: "user-roles",
          title: "Kullanıcı Rolleri",
          re: false,
          wr: false,
          de: false,
          up: false,
        },
        {
          resource_name: "users",
          title: "Kullanıcılar",
          re: false,
          wr: false,
          de: false,
          up: false,
        },
        {
          resource_name: "posts",
          title: "Postlar",
          re: true,
          wr: false,
          de: false,
          up: false,
        },
        {
          resource_name: "categories",
          title: "Kategoriler",
          re: true,
          wr: false,
          de: false,
          up: false,
        },
        {
          resource_name: "tags",
          title: "Etiketler",
          re: true,
          wr: false,
          de: false,
          up: false,
        },
      ],
    };
  },
  methods: {
    async create(data) {
        let role = {
            title: data.title,
            permissions: JSON.stringify(this.defaultPermissions)
        }
      let result = await this.$store.dispatch("createRole", role);
      this.$router.push({name:"list-roles"})
    },
  },
  async created() {
    this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
};
</script>
