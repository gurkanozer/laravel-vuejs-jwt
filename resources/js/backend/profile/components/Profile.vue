<template>
  <div class="container p-4">
    <bread-crumb />
    <div class="card shadow-sm" style="max-width: 420px">
      <img :src="'/uploads/thumbnail/'+getAuth.user.img" class="align-self-center mt-3 rounded-circle" width="125px" height="125px" :alt="getAuth.user.img">
      <div class="card-body">
        <div class="row">
          <label class="col-sm-4 text-right">Ad Soyad:</label>
          <p class="col-sm-8 text-left">
            {{ getAuth.user.full_name }}
          </p>
        </div>
        <div class="row">
          <label class="col-sm-4 text-right">Eposta:</label>
          <p class="col-sm-8 text-left">
            {{ getAuth.user.email }}
          </p>
        </div>
        <div class="row">
          <label class="col-sm-4 text-right">Yetki:</label>
          <p class="col-sm-8 text-left">
            {{ getAuth.user.role.title }}
          </p>
        </div>
      </div>
      <div class="row m-0">
        <div class="col-md-12 form-group d-flex">
          <router-link
            :to="{ name: 'edit-profile' }"
            class="btn btn-outline-primary ml-auto ml-2"
          >
            Profili Güncelle
          </router-link>
          <router-link
            :to="{ name: 'change-password' }"
            class="btn btn-outline-primary ml-2"
          >
            Şifre Değiştir
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import BreadCrumb from "../../components/BreadCrumb";
import { mapGetters } from "vuex";

export default {
  components: {
    BreadCrumb,
  },
  data() {
    return {};
  },
  computed: {
    ...mapGetters(["getAuth"]),
  },
  async created() {
    if (this.getAuth.length <= 0) this.$store.dispatch("getAuth");
  },
};
</script>
<style scoped>
@media (max-width: 768px) {
  label {
    text-align: left !important;
  }
}
</style>