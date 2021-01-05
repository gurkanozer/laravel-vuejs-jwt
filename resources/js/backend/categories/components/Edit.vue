<template>
  <div class="container p-4">
    <bread-crumb />
    <access-denied v-if="!permission.up" />
    <Form
      v-else
      formTitle="Kategori Düzenle"
      :category="category"
      @onAction="update"
    />
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
      category: {},
      permission: [],
    };
  },
  methods: {
    async setData(category) {
      this.category = category;
    },
    async update(data) {
      this.category = { ...this.category, title: data.title };
      let result = await this.$store.dispatch("editCategory", this.category);
      if(result)
        this.$router.push({name:"list-categories"})
    },
  },
  beforeRouteEnter(to, from, next) {
    const apiRes = Vue.callApi("get", `/api/get_categories/${to.params.id}`);
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
  async created() {
       this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
};
</script>
