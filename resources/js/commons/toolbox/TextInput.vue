<template>
  <div class="form-group row">
    <label :for="_id" class="col-sm-3 col-form-label align-self-center pr-0">{{
      _label
    }}</label>
    <div class="col-sm-9">
      <input
        :type="_type"
        :class="_class"
        class="form-control"
        :id="_id"
        :name="_name"
        :placeholder="_placeholder"
        v-model="data.value"
        @keyup="emitToParent"
      />
    </div>
  </div>
</template>
<script>
export default {
  props: [
    "_type",
    "_id",
    "_label",
    "_class",
    "_name",
    "_placeholder",
    "_value",
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
input {
  border-radius: 0%;
  margin: 0;
  outline: none;
  border: none;
  border: 1px solid #2d3436;
}
input:focus {
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