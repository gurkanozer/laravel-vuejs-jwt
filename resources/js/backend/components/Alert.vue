<template>
  <div></div>
</template>
<script>
import { mapState } from "vuex";
export default {
  methods: {
    showAlert(payload) {
      if (payload.isActive === true) {
        switch (payload.type) {
          case "success":
            this.$alertify.success(payload.message);
            this.$store.dispatch("setAlert",{
              isActive:false
            })
            break;

          case "warning":
            this.$alertify.warning(payload.message);
            this.$store.dispatch("setAlert",{
              isActive:false
            })
            break;

          default:
            break;
        }
      }
    },
    success: function () {
      this.$alertify.success("success");
    },
    alert: function () {
      this.$alertify.alert("This is alert", () =>
        this.$alertify.warning("alert is closed")
      );
    },
    alertWithTitle: function () {
      this.$alertify.alert("alert title", "This is alert", () =>
        this.$alertify.warning("alert is closed")
      );
    },
    confirm: function () {
      this.$alertify.confirm(
        "This is comfirm",
        () => this.$alertify.success("ok"),
        () => this.$alertify.error("cancel")
      );
    },
    confirmWithTitle: function () {
      this.$alertify.confirm(
        "confirm title",
        "This is comfirm",
        () => this.$alertify.success("ok"),
        () => this.$alertify.error("cancel")
      );
    },
  },
  computed: mapState(["systemAlert"]),
  watch: {
    systemAlert(newValue, oldValue) {
      this.showAlert(newValue);
    },
  },
};
</script>