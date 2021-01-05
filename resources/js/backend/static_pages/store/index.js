const state={
    static_pages:""
}

const getters={
    getStaticPages: state => {
        return state.static_pages;
    }
}

const mutations={
    setStaticPages(state, payload) {
        state.static_pages = payload;
    },
    updateStaticPages(state, payload) {
        state.static_pages = state.static_pages.map(page => {
            if (page.id === payload.id) return payload;
            else return page;
        });
    },
}

const actions={
    async getStaticPages({ commit }) {
        const res = await Vue.callApi("get", `/api/get_static_pages`);
        if (res.status === 200) commit("setStaticPages", res.data);
        else {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
        }
    },
    async editStaticPages({ commit }, payload) {
        const res = await Vue.callApi("post", "/api/edit_static_pages", payload);
        if (res.status === 200) {
            commit("updateStaticPages", res.data);
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
