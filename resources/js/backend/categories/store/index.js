const state = {
    categories: []
};
const getters = {
    getCategories: state => {
        return state.categories;
    }
};

const mutations = {
    setCategories(state, payload) {
        state.categories = payload;
    },
    addToCategories(state, payload) {
        state.categories.push(payload);
    },
    updateCategories(state, payload) {
        state.categories = state.categories.map(category => {
            if (category.id === payload.id) return payload;
            else return category;
        });
    },
    removeFromCategories(state, payload) {
        const stateAfterDelete = state.categories.filter(
            category => category.id !== payload
        );
        state.categories = stateAfterDelete;
    }
};

const actions = {
    async getCategories({ commit }) {
        const res = await Vue.callApi("get", "/api/get_categories");
        if (res.status === 200) commit("setCategories", res.data);
        else {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
        }
    },
    async createCategory({ commit }, payload) {
        const res = await Vue.callApi("post", "/api/add_category", payload);
        if (res.status === 201) {
            commit("addToCategories", res.data);
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
        } else{ console.log("Error: ", res.data, "Status: ", res.status); return false}
    },
    async editCategory({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/edit_category`, payload);
        if (res.status === 200) {
            commit("updateCategories", res.data);
            commit("setAlert", {
                type: "success",
                isActive: true,
                message: "İşlem Tamamlandı"
            });
            return true;
        } else if (res.status === 422) {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
            return false;
        } else{ console.log("Error: ", res.data, "Status: ", res.status); return false}
    },
    async deleteCategory({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/delete_category`, payload);
        if (res.status === 200) {
            commit("removeFromCategories", payload.id);
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
