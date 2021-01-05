<template>
  <form @submit.prevent="onAction" class="card shadow-sm col-md-8">
    <div class="card-body">
      <h5 class="card-title">
        {{ formTitle }}
      </h5>
      <hr />
      <text-input
        _type="text"
        _id="title"
        _label="Kategori:"
        _name="category"
        @onChange="change"
        :_value="category.title"
      />
      <div class="form-group d-flex justify-content-end">
        <button
          class="btn btn-success ml-2"
          type="submit"
          :disabled="isLoading"
        ><i class="fa fa-floppy-o "></i>
          Kaydet
        </button>
        <router-link
          class="btn btn-danger ml-2"
          :to="{ name: 'list-categories' }"
          ><i class="fa fa-times "></i> İptal</router-link
        >
      </div>
    </div>
  </form>
</template>
<script>
export default {
  props: {
    formTitle: {
      type: String,
      default: "Title",
      required: false,
    },
    category: {
      type: Object,
      default() {
        return { title: "" };
      },
      required: false,
    },
  },
  data() {
    return {
      formData: { title: "" },
      isLoading:false
    };
  },
  methods: {
    change(data) {
      this.formData.title = data.value;
    },
    async onAction(event) {
      this.isLoading = true
      await this.$emit("onAction", this.formData);
      this.isLoading = false
    },
  },
};
</script>