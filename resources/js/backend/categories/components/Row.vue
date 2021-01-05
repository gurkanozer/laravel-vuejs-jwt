<template>
  <tr>
    <td>{{ category.id }}</td>
    <td class="text-center">{{ category.title }}</td>
    <td class="text-center">{{ category.slug }}</td>
    <td class="d-flex justify-content-center">
      <div class="btn-group" category="group">
        <router-link
          v-if="canUpdate"
          :to="{ name: 'edit-category', params: { id: category.id } }"
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
  props: ["category", "canUpdate", "canDelete"],
  data() {
    return {
      isLoading: false,
    };
  },
  methods: {
    async remove() {
      this.isLoading = true;
      this.$store.dispatch("deleteCategory", { id: this.category.id });
      this.isLoading = false;
    },
  },
};
</script>