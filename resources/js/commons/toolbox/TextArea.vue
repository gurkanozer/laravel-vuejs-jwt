<template>
  <div class="form-group row">
    <label class="col-sm-3 pr-0">{{
      _label
    }}</label>
    <div class="col-sm-9">
      <textarea
        :class="_class"
        :rows="_rows"
        class="form-control"
        :name="_name"
        v-model="data.value"
        @keyup="emitToParent"
      >
      </textarea>
    </div>
  </div>
</template>
<script>
export default {
  props: [
    "_id",
    "_label",
    "_class",
    "_name",
    "_value",
    "_rows",
  ],
  data() {
    return {
      data: {
        name: this._name,
        value: "",
      },
    };
  },
  created() {
    this.setData()
  },
  methods: {
    setData() {
      this.$nextTick(function () {
        this.data.value = this._value;
      });
    },
    emitToParent(event) {
      this.$emit("onChange", this.data);
    },
  },
};
</script>
<style scoped>
textarea {
  border-radius: 0%;
  margin: 0;
  outline: none;
  border: none;
  border: 1px solid #2d3436;
}
textarea:focus {
  outline: none;
  box-shadow: none;
}
label {
  text-align: right;
  color: #2d3436;
  font-size: 16px;
}

@media (max-width: 768px) {
  label {
    text-align: left !important;
  }
}
</style>