import store from "../store"
const axios = require("axios").default;
const Utils = {};

export default Utils.install = function(Vue) {
    Vue.callApi = async (method, url, dataObj,file) => {
        //Get token from state
        const token = localStorage.getItem("access_token");
        //Headers
        const headers = {
            "Content-Type": "application/json"
        };
        if(file){
            headers["Content-Type"] = "multipart/form-data; boundary=${form._boundary}"
        }
        //If token, add to headers config
        if (token) {
            headers["Authorization"] = `bearer ${token}`;
        }
        try {
            return await axios({
                method: method,
                url: url,
                data: dataObj,
                headers: headers
            });
        } catch (e) {
            return e.response;
        }
    };
    Vue.checkPermission = (resource) =>{
        const rules = store.state.auth.auth.permissions
        return rules.find(rule =>
          rule.resource_name === resource[2]
        )
    }
};
