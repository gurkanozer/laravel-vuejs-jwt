const state = {};
const getters = {};

const mutations = {};

const actions = {
    async editPermission({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/edit_permissions`, payload);
        if (res.status === 200) {
            commit("updateRoles", payload);
            commit("setAlert", {
                type: "success",
                isActive: true,
                message: "İşlem Tamamlandı"
            });
        } else if (res.status === 422) {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
        } else console.log("Error: ", res.data, "Status: ", res.status);
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
