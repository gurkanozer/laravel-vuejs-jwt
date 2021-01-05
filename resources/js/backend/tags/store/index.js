const state = {
    tags: []
};

const getters = {
    getTags: state => {
        return state.tags;
    }
};

const mutations = {
    setTags(state, payload) {
        state.tags = payload;
    },
    addToTags(state, payload) {
        state.tags.push(payload);
    },
    updateTags(state, payload) {
        state.tags = state.tags.map(tag => {
            if (tag.id === payload.id) return payload;
            else return tag;
        });
    },
    removeFromTags(state, payload) {
        const stateAfterDelete = state.tags.filter(tag => tag.id !== payload);
        state.tags = stateAfterDelete;
    }
};

const actions = {
    async getTags({ commit }) {
        const res = await Vue.callApi("get", "/api/get_tags");
        if (res.status === 200) commit("setTags", res.data);
        else {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
        }
    },
    async createTag({ commit }, payload) {
        const res = await Vue.callApi("post", "/api/add_tag", payload);
        if (res.status === 201) {
            commit("addToTags", res.data);
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
            return false
        } else{ console.log("Error: ", res.data, "Status: ", res.status); return false}
    },
    async editTag({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/edit_tag`, payload);
        if (res.status === 200) {
            commit("updateTags", payload);
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
    async deleteTag({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/delete_tag`, payload);
        if (res.status === 200) {
            commit("removeFromTags", payload.id);
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
