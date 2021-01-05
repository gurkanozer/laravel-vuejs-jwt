<template>
  <div class="card shadow-sm row m-0">
    <div class="card-body col-md-12">
      <label>Post:</label>
      <ckeditor v-model="editorData" :config="editorConfig"></ckeditor>
    </div>
    <div class="col-md-12 form-group d-flex justify-content-end">
      <button @click="pageAction" class="btn btn-primary ml-2">
        <i class="fa fa-arrow-left"></i> Geri
      </button>
      <button
        @click="onAction"
        :disabled="isLoading"
        class="btn btn-success ml-2"
      >
        <i class="fa fa-floppy-o"></i> Kaydet
      </button>
      <router-link class="btn btn-danger ml-2" :to="{ name: 'list-posts' }"
        ><i class="fa fa-times"></i> İptal</router-link
      >
    </div>
  </div>
</template>
<script>
export default {
  props: {
    content: {},
  },
  data() {
    return {
      isLoading:false,
      editorData: "",
      editorConfig: {
        // The configuration of the editor.
      },
    };
  },
  async created() {
    this.$nextTick(function () {
    this.editorData = this.content;
      });
  },
  methods: {
    pageAction() {
      this.$emit("pageAction", false);
    },
    async onAction(event) {
      this.isLoading = true;
      await this.$emit("saveAction", this.editorData);
      this.isLoading = false;
    },
  },
};
</script>