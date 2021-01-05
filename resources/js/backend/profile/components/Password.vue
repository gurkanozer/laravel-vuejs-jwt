<template>
  <div class="container p-4">
    <bread-crumb />
    <div class="card card-body col-md-8 shadow-sm">
      <text-input
        _type="password"
        _name="password"
        _label="Şifre:"
        @onChange="change"
        :_value="data.password"
      />
      <text-input
        _type="password"
        _name="password_confirmation"
        _label="Şifre Tekrar:"
        @onChange="change"
        :_value="data.password_confirmation"
      />
      <div class="input-group">
        <button
          @click="changePassword"
          :disabled="isLoading"
          class="btn btn-success ml-auto"
        >
          <i class="fa fa-floppy-o"></i> Kaydet
        </button>
        <router-link
        :to="{name:'profile'}"
          class="btn btn-danger ml-2"
        >
          <i class="fa fa-times"></i> İptal
        </router-link>
      </div>
    </div>
  </div>
</template>
<script>
import BreadCrumb from "../../components/BreadCrumb";
import {mapGetters} from "vuex";
export default {
  components:{
    BreadCrumb
  },
  data() {
    return {
      data: {
        password: "",
        password_confirmation: "",
      },
      isLoading: false,
    };
  },
  methods: {
    async changePassword() {
      this.isLoading = true;
      this.data ={...this.data, id:this.getAuth.user.id}
      let result = await this.$store.dispatch("chanePassword", this.data);
      this.isLoading = false;  
      if(result)
        this.$router.push({name:"profile"})
    },
    change(data) {
      for (const [key, value] of Object.entries(this.data)) {
        if (key === data.name) {
          this.data[key] = data.value;
        }
      }
    }
  },
    computed: {
    ...mapGetters(["getAuth"]),
  },
  async created() {
    if (this.getAuth.length <= 0) this.$store.dispatch("getAuth");
  },
};
</script>