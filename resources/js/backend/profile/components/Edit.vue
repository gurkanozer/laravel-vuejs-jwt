<template>
<div class="container p-4">
    <bread-crumb />
  <div class="card shadow-sm col-md-8">
    <div class="card-body">
      <h5 class="card-title">
          Profil Bilgilerini Güncelle
      </h5>
      <hr />
      <text-input
        _type="text"
        _id="full_name"
        _label="Ad Soyad:"
        _name="full_name"
        @onChange="change"
        :_value="user.full_name"
      />
      <text-input
        _type="email"
        _id="email"
        _label="Eposta:"
        _name="email"
        @onChange="change"
        :_value="user.email"
      />
      <file-input
      _id="img"
      _name="img"
      _label="Profil Fotoğrafı"
      @onChange="file"
      :_src="'/uploads/thumbnail/'+user.img"
      /> 
      <div class="form-group d-flex justify-content-end">
        <button class="btn btn-success ml-2" :disabled="isLoading" @click="update"><i class="fa fa-floppy-o "></i> Kaydet</button>
        <router-link class="btn btn-danger ml-2" :to="{ name: 'profile' }"
          ><i class="fa fa-times "></i> İptal</router-link
        >
      </div>
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
  data(){
    return{
      user:{
        full_name:"",
        email:"",
        role_id:""
      },
      isLoading:false,
      formImg:""
    }
  },
  methods: {
    async update(){
      const formData =  new FormData();
      formData.append("id",this.user.id);
      formData.append("full_name",this.user.full_name)
      formData.append("email",this.user.email)
      formData.append("role_id",this.user.role_id)
      if(this.formImg)
        formData.append("img",this.formImg)
      this.isLoading = true;
      let result = await this.$store.dispatch("editAuthUser", formData);
       this.isLoading = false;
       if(result)
        this.$router.push({name:"profile"})
    },
    change(data) {
      for (const [key, value] of Object.entries(this.user)) {
        if (key === data.name) {
          this.user[key] = data.value;
        }
      }
    },
    file(data){
      this.formImg = data
    },
  },
  computed: {
    ...mapGetters(["getAuth"]),
  },
  async created() {
    if (this.getAuth.length <= 0) this.$store.dispatch("getAuth");
    this.user = this.getAuth.user
  },
};
</script>