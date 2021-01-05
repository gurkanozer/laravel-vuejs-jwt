const state = {
    users: []
};

const getters = {
    getUsers: state => {
        return state.users;
    }
};

const mutations = {
    setUsers(state, payload) {
        state.users = payload;
    },
    addToUsers(state, payload) {
        state.users.push(payload);
    },
    updateUsers(state, payload) {
        state.users = state.users.map(user => {
            if (user.id === payload.id) return payload;
            else return user;
        });
    },
    removeFromUsers(state, payload) {
        const stateAfterDelete = state.users.filter(
            user => user.id !== payload
        );
        state.users = stateAfterDelete;
    }
};

const actions = {
    async getUsers({ commit }) {
        const res = await Vue.callApi("get", "/api/get_users");
        if (res.status === 200) commit("setUsers", res.data);
        else {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
        }
    },
    async createUser({ commit }, payload) {
        const res = await Vue.callApi("post", "/api/add_user", payload,true);
        if (res.status === 201) {
            commit("addToUsers", res.data);
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
        }
        else{ console.log("Error: ", res.data, "Status: ", res.status); return false}
    },
    async editUser({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/edit_user`, payload);
        if (res.status === 200) {
            commit("updateUsers", res.data);
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
    async deleteUser({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/delete_user`, payload);
        if (res.status === 200) {
            commit("removeFromUsers", payload.id);
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
