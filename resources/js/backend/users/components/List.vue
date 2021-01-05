<template>
  <div class="container p-4">
    <bread-crumb
      _buttonTag="router-link"
      _to="add-user"
      :_withButton="permission.wr"
      _buttonLabel=" Yeni Kullanıcı Ekle"
      _buttonIcon="fa fa-plus"
    />
    <table class="table">
      <thead>
        <tr>
          <th>Id</th>
          <th class="text-center">Ad Soyad</th>
          <th class="text-center">Eposta</th>
          <th class="text-center">Kullanıcı Rolü</th>
          <th class="text-center">İşlemler</th>
        </tr>
      </thead>
      <tbody>
        <Row
          v-for="(user, index) in getUsers"
          :user="user"
          :key="index"
          :role="user.role.title"
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
    if (this.getUsers.length <= 0) this.$store.dispatch("getUsers");
    this.permission = Vue.checkPermission(this.$route.path.split("/"));
  },
  computed: {
    ...mapGetters(["getUsers"]),
  },
};
</script>
