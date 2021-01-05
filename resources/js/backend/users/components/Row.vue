<template>
  <tr>
    <td>{{ user.id }}</td>
    <td class="text-center">{{ user.full_name }}</td>
    <td class="text-center">{{ user.email }}</td>
    <td class="text-center">{{ role }}</td>
    <td class="d-flex justify-content-center">
      <div class="btn-group" role="group">
        <router-link
          v-if="canUpdate"
          :to="{ name: 'edit-user', params: { id: user.id } }"
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
  props: {
    user: {
      type: Object,
      required: false,
      default() {
        return {
          full_name: "",
          email: "",
          role_id: "",
        };
      },
    },
    role: {
      type: String,
      default: "User",
      required: false,
    },
    canUpdate: {
      type: Boolean,
      default: false,
      required: false,
    },
    canDelete: {
      type: Boolean,
      default: false,
      required: false,
    },
  },
  data() {
    return {
      isLoading: false,
    };
  },
  methods: {
    remove() {
      this.isLoading = true;
      this.$store.dispatch("deleteUser", { id: this.user.id });
      this.isLoading = false;
    },
  },
};
</script>