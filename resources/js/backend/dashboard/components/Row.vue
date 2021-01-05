<template>
  <tr>
    <td>{{ index + 1 }}</td>
    <td class="text-center">
      <p>{{ post.title }}</p>
      <span>{{ post.slug }}</span>
    </td>
    <td class="text-center">{{ post.category.title }}</td>
    <td class="text-center">
      <span v-for="(tag, i) in tags" :key="i" class="badge badge-success mr-1"
        >{{ tag.title }}
      </span>
    </td>
  </tr>
</template>
<script>
export default {
  props: ["post","index"],
  data() {
    return {
      tags: [],
    };
  },
  async created() {
    this.post.tag.forEach((t) => {
      this.tags.push(t);
    });
  },
};
</script>