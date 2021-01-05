<template>
  <div class="form-group row">
    <label :for="_id" class="col-sm-3 col-form-label align-self-center pr-0">{{
      _label
    }}</label>
    <div class="col-sm-9">
      <select class="form-control" :class="_class" :id="_id" :name="_name" v-model="data.value" @change="emitToParent">
        <option
          v-for="option in _options"
          :key="option.id"
          :id="option.id"
          :value="option.id"
          :selected="option.id == _defaultValue ? true : false"
        >
          {{ findValue(option) }}
        </option>
      </select>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    _options: { type: Array },
    _id: { type: String, required: false },
    _label: { type: String, default: "Label", required: false },
    _class: { type: String },
    _name: { type: String },
    _optionKey: { type: String, required: false, default: "name" },
    _defaultValue: {
      required: false,
      default: null,
    },
  },
  data() {
  return {
    data: {
      name: this._name,
      value: "",
    },
  };
},
created(){
  this.setData()
},
  methods: {
    setData() {
      this.$nextTick(function () {
        this.data.value = this._defaultValue;
      });
    },
    emitToParent(event) {
      this.$emit("onChange", this.data);
    },
    findValue(object) {
      for (const [key, value] of Object.entries(object)) {
        if (key === this._optionKey) return value;
      }
    },
  },
};
</script>
<style scoped>
.form-control{
  border:none;
  border-radius: 0%;
  border:1px solid #2d3436;
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