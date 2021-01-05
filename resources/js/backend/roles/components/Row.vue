<template>
  <tr>
    <td>{{ role.id }}</td>
    <td class="text-center">{{ role.title }}</td>
    <td class="text-center">
      <button
        disabled
        v-if="role.is_admin || !canUpdate"
        class="btn btn-warning btn-sm"
      >
        <i class="fa fa-eye"></i> Yetkiler
      </button>
      <router-link
        v-else
        :to="{ name: 'permissions', params: { id: role.id } }"
        class="btn btn-primary btn-sm"
      >
        <i class="fa fa-eye"></i> Yetkiler
      </router-link>
    </td>
    <td class="d-flex justify-content-center">
      <div class="btn-group" role="group">
        <router-link
          v-if="canUpdate"
          :to="{ name: 'edit-role', params: { id: role.id } }"
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
  props: ["role", "canUpdate", "canDelete"],
  data() {
    return {
      isLoading: false,
    };
  },
  methods: {
    remove() {
      this.isLoading = true;
      this.$store.dispatch("deleteRole", { id: this.role.id });
      this.isLoading = false;
    },
  },
};
</script>