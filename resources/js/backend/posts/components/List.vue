<template>
  <div class="container p-4">
    <bread-crumb
      _buttonTag="router-link"
      _to="add-post"
      :_withButton="true"
      _buttonLabel=" Yeni Post Ekle"
      _buttonIcon="fa fa-plus"
    />
    <table class="table">
      <thead>
        <tr>
          <th>id</th>
          <th class="text-center">Başlık</th>
          <th class="text-center">Kategori</th>
          <th class="text-center">Etiketler</th>
          <th class="text-center">İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <Row
          v-for="(post, index) in getPosts"
          :post="post"
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
import Row from "./Row";
import { mapGetters } from "vuex";

export default {
  components: {
    BreadCrumb,
    Row,
  },
  async created() {
    if (this.getPosts.length <= 0) this.$store.dispatch("getPosts");
    this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
  computed: {
    ...mapGetters(["getPosts"]),
  },
};
</script>