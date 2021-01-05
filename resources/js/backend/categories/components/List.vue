<template>
  <div class="container p-4">
    <bread-crumb
      _buttonTag="router-link"
      _to="add-category"
      :_withButton="permission.wr"
      _buttonLabel=" Yeni Kategori Ekle"
      _buttonIcon="fa fa-plus"
    />
    <table class="table">
      <thead>
        <tr>
          <th>#Id</th>
          <th class="text-center">Başlık</th>
          <th class="text-center">Slug</th>
          <th class="text-center">İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <Row
          v-for="(category, index) in getCategories"
          :category="category"
          :key="index"
          :canUpdate="permission.up"
          :canDelete="permission.de"
        />
      </tbody>
    </table>
  </div>
</template>
<script>
import BreadCrumb from "../../components/BreadCrumb";
import { mapGetters } from "vuex";
import Row from "./Row";
export default {
  components: {
    BreadCrumb,
    Row,
  },
  data() {
    return {
      permission: [],
    };
  },
  async created() {
    if (this.getCategories.length <= 0) this.$store.dispatch("getCategories");
    this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
  computed: {
    ...mapGetters(["getCategories"]),
  },
};
</script>