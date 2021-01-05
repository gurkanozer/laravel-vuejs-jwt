<template>
  <form @submit.prevent="onAction" method="post" enctype='multipart/form-data' class="card shadow-sm col-md-8">
    <div class="card-body">
      <h5 class="card-title">
        {{ formTitle }}
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
      <select-input
        :_options="roles"
        _id="role"
        _name="role_id"
        _label="Kullanıcı Rolü:"
        _optionKey="title"
        :_defaultValue="user.role_id"
        @onChange="change"
      />
      <file-input
      _id="img"
      _name="img"
      _label="Profil Fotoğrafı"
      @onChange="file"
      :_src="'/uploads/thumbnail/'+user.img"
      />
      <div class="form-group d-flex justify-content-end">
        <button class="btn btn-success ml-2" :disabled="isLoading">
          <i class="fa fa-floppy-o"></i> Kaydet
        </button>
        <router-link class="btn btn-danger ml-2" :to="{ name: 'list-users' }"
          ><i class="fa fa-times"></i> İptal</router-link
        >
      </div>
    </div>
  </form>
</template>
<script>
import FileInput from '../../../commons/toolbox/FileInput.vue';
export default {
  components: { FileInput },
  props: {
    formTitle: { type: String, default: "Title", required: false },
    roles: { type: Array, required: true },
    user: {
      type: Object,
      required: false,
      default() {
        return {
          full_name: "",
          email: "",
          role_id: "",
          img:""
        };
      },
    },
  },
  data() {
    return {
      isLoading: false,
      formImg:null,
    };
  },
  methods: {
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
    async onAction(event) {
      if(this.formImg)
        this.user.img = this.formImg
      else this.user.img = null
      this.isLoading = true;
      await this.$emit("onAction", this.user);
      this.isLoading = false;
    },
  },
};
</script>