const state={

}

const getters={

}

const mutations={

}

const actions={
    async editAuthUser({ commit }, payload) {
        const res = await Vue.callApi("post", `/api/edit_user`, payload);
        if (res.status === 200){ 
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
    async chanePassword({commit},payload){
        const res = await Vue.callApi("post","/api/change_password",payload);
        if(res.status === 200){
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
    }
}

export default {
    state,
    getters,
    mutations,
    actions
};
