const state = {
    roles: []
};
const getters = {
    getRoles: state => {
        return state.roles;
    }
};

const mutations = {
    setRoles(state, payload) {
        state.roles = payload;
    },
    addToRoles(state, payload) {
        state.roles.push(payload);
    },
    updateRoles(state, payload) {
        state.roles = state.roles.map(role => {
            if (role.id === payload.id) return payload;
            else return role;
        });
    },
    removeFromRoles(state, payload) {
        const stateAfterDelete = state.roles.filter(
            role => role.id !== payload
        );
        state.roles = stateAfterDelete;
    }
};

const actions = {
    async getRoles({ commit }) {
        const res = await Vue.callApi("get", "/api/get_roles");
        if (res.status === 200) commit("setRoles", res.data);
        else
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
    },
    async createRole({ commit }, payload) {
        const res = await Vue.callApi("post", "/api/add_role", payload);
        if (res.status === 201) {
            commit("addToRoles", res.data);
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
    async editRole({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/edit_role`, payload);
        if (res.status === 200) {
            commit("updateRoles", payload);
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
        } else{ console.log("Error: ", res.data, "Status: ", res.status);return false}
    },
    async deleteRole({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/delete_role`, payload);
        if (res.status === 200) {
            commit("removeFromRoles", payload.id);
            commit("setAlert", {
                type: "success",
                isActive: true,
                message: "İşlem Tamamlandı"
            });
        } else {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
        }
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
