<template>
  <tr>
    <td>{{ tag.id }}</td>
    <td class="text-center">{{ tag.title }}</td>
    <td class="d-flex justify-content-center">
      <div class="btn-group" tag="group">
        <router-link
          v-if="canUpdate"
          :to="{ name: 'edit-tag', params: { id: tag.id } }"
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
  props: ["tag", "canUpdate", "canDelete"],
  data() {
    return {
      isLoading: false,
    };
  },
  methods: {
    remove() {
      this.isLoading = true;
      this.$store.dispatch("deleteTag", { id: this.tag.id });
      this.isLoading = false;
    },
  },
};
</script>