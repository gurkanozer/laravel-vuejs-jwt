const state={
    settings:""
}

const getters={
    getSettings: state => {
        return state.settings;
    }
}

const mutations={
    setSettings(state, payload) {
        state.settings = payload;
    },
    updateSettings(state, payload) {
        state.settings = payload
    },
}

const actions={
    async getSettings({ commit }) {
        const res = await Vue.callApi("get", "/api/get_settings");
        if (res.status === 200) commit("setSettings", res.data);
        else {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
        }
    },
    async editSettings({ commit }, payload) {
        const res = await Vue.callApi("post", "/api/edit_settings", payload);
        if (res.status === 200) {
            commit("updateSettings", res.data);
            commit("setAlert", {
                type: "success",
                isActive: true,
                message: "İşlem Tamamlandı"
            });
            return true
        } else if (res.status === 422) {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
            return false
        } else {console.log("Error: ", res.data, "Status: ", res.status); return false}
    },
}

export default {
    state,
    getters,
    mutations,
    actions
};
