<template>
  <div class="container p-4">
    <bread-crumb
      _buttonTag="router-link"
      _to="add-tag"
      :_withButton="permission.wr"
      _buttonLabel=" Yeni Etiket Ekle"
      _buttonIcon="fa fa-plus"
    />
    <table class="table">
      <thead>
        <tr>
          <th>#Id</th>
          <th class="text-center">Başlık</th>
          <th class="text-center">İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <Row
          v-for="(tag, index) in getTags"
          :tag="tag"
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
    if (this.getTags.length <= 0) this.$store.dispatch("getTags");
    this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
  computed: {
    ...mapGetters(["getTags"]),
  },
};
</script>