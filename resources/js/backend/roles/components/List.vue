<template>
  <div class="container p-4">
    <bread-crumb
      _buttonTag="router-link"
      _to="add-role"
      :_withButton="permission.wr"
      _buttonLabel=" Yeni Kullanıcı Rolü Ekle"
      _buttonIcon="fa fa-plus"
    />
    <table class="table">
      <thead>
        <tr>
          <th>#Id</th>
          <th class="text-center">Başlık</th>
          <th class="text-center">Yetkiler</th>
          <th class="text-center">İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <Row
          v-for="(role, index) in getRoles"
          :role="role"
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
    if (this.getRoles.length <= 0) this.$store.dispatch("getRoles");
    this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
  computed: {
    ...mapGetters(["getRoles"]),
  },
};
</script>