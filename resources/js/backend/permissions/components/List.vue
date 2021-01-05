<template>
  <div class="container p-4">
    <bread-crumb />
    <access-denied v-if="!permission.up" />
    <div v-else>
      <table class="table">
        <thead>
          <tr>
            <th class="text-center">TITLE</th>
            <th class="text-center">READ</th>
            <th class="text-center">WRITE</th>
            <th class="text-center">UPDATE</th>
            <th class="text-center">DELETE</th>
          </tr>
        </thead>
        <tbody>
          <Row
            v-for="(permission, index) in permissions"
            :permission="permission"
            :key="index"
            :id="role.id"
          />
        </tbody>
      </table>
      <div class="align-items-center d-flex shadow bg-white p-3">
        <button
          class="btn btn-success ml-auto"
          :disabled="isLoading"
          @click="update"
        ><i class="fa fa-floppy-o "></i>
          Kaydet
        </button>
        <router-link class="btn btn-primary ml-2" :to="{ name: 'list-roles' }"
          ><i class="fa fa-arrow-left "></i> Geri</router-link
        >
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import BreadCrumb from "../../components/BreadCrumb";
import AccessDenied from "../../components/AccessDenied";
import Row from "./Row";
export default {
  components: {
    BreadCrumb,
    AccessDenied,
    Row,
  },
  data() {
    return {
      role: {},
      permissions: [],
      isLoading: false,
    };
  },
  mounted() {
    // if (this.getRoles.length <= 0) this.$store.dispatch("getRoles");
    this.permissions = JSON.parse(this.role.permissions);
  },
  methods: {
    async setData(role) {
      this.role = role;
    },
    async update() {
      let data = {
        ...this.role,
        permissions: JSON.stringify(this.permissions),
      };
      this.isLoading = true;
      this.$store.dispatch("editPermission", data);
      this.isLoading = false;
    },
  },
  beforeRouteEnter(to, from, next) {
    const apiRes = Vue.callApi("get", `/api/get_roles/${to.params.id}`);
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