<template>
  <div class="form-group row mx-0">
    <div class="col-sm-3 px-0 d-flex justify-content-center mb-2">
      <img :src="_src" />
    </div>
    <div class="custom-file col-sm-9">
      <input
        type="file"
        class="custom-file-input"
        :id="_id"
        :name="_name"
        :class="_class"
        @change="emitToParent"
      />
      <label class="custom-file-label" :for="_id">{{ file.name }}</label>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    _id: {
      type: String,
      default: "label",
      required: false,
    },
    _name: {
      type: String,
      default: "name",
      required: true,
    },
    _label: {
      type: String,
      default: "label",
      required: false,
    },
    _class: {
      type: String,
      required: false,
    },
    _value: {
      type: File,
      required: false,
    },
    _src: {
      type: String,
      required: false,
    },
  },
  data(){
      return{
          file:{
              name:"",
              value:"",
          }
      }
  },

  methods: {
    emitToParent(event) {
      this.file.name = event.target.files[0].name
      this.file.value = event.target.value
      this.$emit("onChange", event.target.files[0]);
    },
  },
};
</script>
<style scoped>
.custom-file-input ~ .custom-file-label::after {
  content: "Seç" !important;
  background: #fff;
}
.custom-file-label{  
    border-radius: 0%;
  border: 1px solid #2d3436!important;
}
img{
    width:55px;
    height:55px;
}
</style>