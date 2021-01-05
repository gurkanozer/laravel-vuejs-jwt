<template>
  <div class="wrapper">
    <Alert />
    <Sidebar :settings="getSettings"/>
    <div id="content">
      <Navbar />
      <router-view />
    </div>
  </div>
</template>
<script>
import Navbar from "./components/Navbar";
import Sidebar from "./components/Sidebar";
import Alert from "./components/Alert";
import {mapGetters} from "vuex";
export default {
  components: {
    Navbar,
    Sidebar,
    Alert
  },
  computed:{
    ...mapGetters(["isAuthenticated","getAuth","getSettings"])
  },
  async created(){
    if(this.getAuth.length <= 0) this.$store.dispatch("initAuth")
    if(this.getSettings.length <= 0) this.$store.dispatch("getSettings")
  }
}
</script>