<template>
  <tr>
    <td>{{ post.id }}</td>
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
    <td class="d-flex justify-content-center">
      <div class="btn-group" post="group">
        <router-link
          v-if="canUpdate"
          :to="{ name: 'edit-post', params: { id: post.id } }"
          class="btn btn-success btn-sm"
        >
          <i class="fa fa-edit"></i> Düzenle
        </router-link>
        <button
          :disabled="isLoading"
          v-if="canDelete"
          class="btn btn-danger btn-sm"
          @click="remove()"
        >
          <i class="fa fa-trash"></i> Sil
        </button>
      </div>
    </td>
  </tr>
</template>
<script>
export default {
  props: ["post", "canUpdate", "canDelete"],
  data() {
    return {
      tags: [],
      isLoading: false,
    };
  },
  methods: {
    remove() {
      this.isLoading = true;
      this.$store.dispatch("deletePost", { id: this.post.id });
      this.isLoading = false;
    },
  },

  async created() {
    this.post.tag.forEach((t) => {
      this.tags.push(t);
    });
  },
};
</script>