import TextInputNoLabel  from "./TextInputNoLabel";
import TextInput from "./TextInput";
import TextArea from "./TextArea";
import SelectInput  from "./SelectInput";
import FileInput  from "./FileInput";

const Toolbox = {
  install(Vue) {
    Vue.component("test-input-no-label", TextInputNoLabel);
    Vue.component("text-input", TextInput);
    Vue.component("text-area-input", TextArea);
    Vue.component("select-input", SelectInput);
    Vue.component("file-input", FileInput);
  }
};

export default Toolbox;
