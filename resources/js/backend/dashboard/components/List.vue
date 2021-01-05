<template>
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th class="text-center">Başlık</th>
        <th class="text-center">Kategori</th>
        <th class="text-center">Etiketler</th>
      </tr>
    </thead>
    <tbody>
        <row v-for="(post,index) in posts" :key="index" :index="index" :post="post" />
    </tbody>
  </table>
</template>
<script>
import Row from "./Row";
export default {
    components:{
        Row
    },
props:["posts"]    
}
</script>