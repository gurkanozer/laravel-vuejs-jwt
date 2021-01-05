<template>
  <div class="card shadow-sm row m-0">
    <div class="card-body col-md-8">
      <h5 class="card-title">
        {{ formTitle }}
      </h5>
      <hr />
      <text-input
        _type="text"
        _id="title"
        _label="Başlık:"
        _name="title"
        @onChange="change"
        :_value="post.title"
      />
      <select-input
        :_options="getCategories"
        _id="category"
        _name="category_id"
        _label="Kategori:"
        _optionKey="title"
        :_defaultValue="post.category_id"
        @onChange="change"
      />
      <div class="form-group row">
        <label class="col-sm-3 col-form-label align-self-center pr-0"
          >Etiketler:</label
        >
        <div class="col-sm-9">
          <multiselect
            v-model="post.tags"
            :options="getTags"
            :multiple="true"
            label="title"
            trackBy="id"
            placeholder=""
            selectLabel="Ekle"
            :hideSelected="true"
            :name="getTags.title"
          ></multiselect>
        </div>
      </div>
                <file-input
            _id="img"
            _name="img"
            _label="Kapak Fotoğrafı"
            @onChange="file"
            :_src="src"
          />
    </div>
    <div class="col-md-12 form-group d-flex justify-content-end">
      <button @click="onAction" class="btn btn-primary ml-2">
        <i class="fa fa-arrow-right"></i> Devam
      </button>
      <router-link class="btn btn-danger ml-2" :to="{ name: 'list-posts' }"
        ><i class="fa fa-times"></i> İptal</router-link
      >
    </div>
  </div>
</template>
<script>
import Multiselect from "vue-multiselect";
import { mapGetters } from "vuex";
export default {
  props: {
    formTitle: { type: String, default: "Title", required: false },
    post: {
      type: Object,
      required: false,
      default() {
        return {
          title: "",
          category_id: "",
          tags: [],
          img:""
        };
      },
    },
  },
  components: {
    Multiselect,
  },
  data() {
    return {
      formImg: null,
      src: "",
    };
  },
  computed: {
    ...mapGetters(["getCategories", "getTags"]),
  },
  async created() {
    if (this.getCategories.length <= 0) this.$store.dispatch("getCategories");
    if (this.getTags.length <= 0) this.$store.dispatch("getTags");
    this.setData();
  },
  methods: {
    setData() {
      this.$nextTick(function () {
        this.src = `/uploads/banner/${this.post.img}`;
      });
    },
    file(data){
      this.formImg = data
    },
    change(data) {
      for (const [key, value] of Object.entries(this.post)) {
        if (key === data.name) {
          this.post[key] = data.value;
        }
      }
    },
    onAction(event) {
      if(this.formImg){
      this.post.img = this.formImg
      } 
      else this.post.img = null     
      let data = {
        post: this.post,
        showEditor: true,
      };
      this.$emit("onAction", data);
    },
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style  scoped>
label {
  text-align: right;
  color: #2d3436;
  font-size: 16px;
}
.multiselect {
  border: none !important;
  border-bottom: 1px solid #2d3436 !important;
}

@media (max-width: 768px) {
  label {
    text-align: left !important;
  }
}
</style>