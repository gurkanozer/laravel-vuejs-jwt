<template>
  <div class="card card-body login-form p-4">
    <h4 class="card-title text-success">Giriş Yap</h4>
    <text-input-no-label
      _type="email"
      _name="email"
      _placeholder="Eposta..."
      @onChange="change"
      :_value="user.email"
    />
    <text-input-no-label
      _type="password"
      _name="password"
      _placeholder="Şifre..."
      @onChange="change"
      :_value="user.password"
    />
    <button
      @click="login"
      type="submit"
      :disabled="isLoading"
      class="btn btn-success"
    >
      Giriş Yap
    </button>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import TextInputNoLabel from "../../../commons/toolbox/TextInputNoLabel.vue";
export default {
  components: { TextInputNoLabel },
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      isLoading: false,
    };
  },
  methods: {
    async login() {
      this.isLoading = true;
      await this.$store.dispatch("loginUser", this.user);
      this.isLoading = false;
    },
    change(data) {
      for (const [key, value] of Object.entries(this.user)) {
        if (key === data.name) {
          this.user[key] = data.value;
        }
      }
    },
  },
  computed: {
    ...mapGetters(["isAuthenticated", "getAuth"]),
  },
  // async beforeRouteEnter (to, from, next) {
  // if(this.getAuth.access_token && !this.isAuthenticated){
  //       await this.$store.dispatch("initAuth")
  //     }
  //      if(!this.isAuthenticated)
  //          this.$router.push("/login")

  // }
};
</script>
<style scoped>
.login-form {
  text-align: center;
  width: 360px;
  position: fixed;
  top: 40%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>