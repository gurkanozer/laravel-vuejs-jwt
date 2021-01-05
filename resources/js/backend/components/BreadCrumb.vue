<template>
  <div class="bread-crumb d-flex align-items-center shadow bg-white">
    <ul class="breadcrumb">
      <li v-for="(p,i) in path" :key="i">{{p}}</li>
    </ul>
    <component
      v-if="_withButton"
      :is="_buttonTag"
      class="btn btn-success btn-sm ml-auto"
      :to="{ name: _to }"
      :href="_href"
    ><i :class="_buttonIcon"></i>
      {{ _buttonLabel }}
    </component>
  </div>
</template>
<script>
export default {
  props: {
    _buttonTag: {
      type: String,
      default: "a",
      required: false,
    },
    _to: {
      type: String,
      default: null,
      required: false,
    },
    _href: {
      type: String,
      default: "/",
      required: false,
    },
    _withButton: {
      type: Boolean,
      default: false,
    },
    _buttonLabel: {
      type: String,
      default: "Button",
      required: false,
    },
    _buttonIcon:{
        type:String,
        default:null,
        required:false
    }
  },
  data(){
    return{
      path:[]
    }
  },
  mounted(){
    let fullpath = this.$route.path.split("/")
    fullpath.splice(0, 2)
    this.path = fullpath
}
};
</script>