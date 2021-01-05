<template>
  <div class="container p-4">
    <bread-crumb
      _buttonTag="router-link"
      _to="add-post"
      :_withButton="true"
      _buttonLabel=" Yeni Post Ekle"
      _buttonIcon="fa fa-plus"
    />
    <div class="row d-flex justify-content-center">
      <Card title="Toplam Post" :count="getPosts.length" />
      <Card title="Toplam Kategori" :count="getCategories.length" />
      <Card title="Toplam Etiket" :count="getTags.length" />
    </div>
    <div class="row">
      <div class="col-md-8 m-auto">
        <List :posts="getPosts" />
      </div>
    </div>
  </div>
</template>
<script>
import BreadCrumb from "../../components/BreadCrumb";
import Card from "./Card";
import List from "./List";
import {mapGetters} from "vuex";
export default {
  components: {
    BreadCrumb,
    Card,
    List
  },
  computed:{
    ...mapGetters(["getPosts","getCategories","getTags"])
  },
  created(){
    if(this.getPosts.length <= 0) this.$store.dispatch("getPosts")
    if(this.getCategories.length <= 0) this.$store.dispatch("getCategories")
    if(this.getTags.length <= 0) this.$store.dispatch("getTags")
  }
};
</script>