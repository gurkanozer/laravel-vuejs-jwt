import router from "../../../router";
const state = {
    auth: {
        user: null,
        isAuthenticated:false,
        permissions:[],
        access_token: localStorage.getItem("access_token")
    }
};
const getters = {
    getAuth(state) {
        return state.auth;
    },
    isAuthenticated(state) {
        if (state.auth.isAuthenticated) {
            return true;
        } else return false;
    },
    getPermissions(state){
        return state.auth.permissions
    }
};

const mutations = {
    setAuth(state, payload) {
        state.auth={
            user : payload.user,
            isAuthenticated: payload.isAuthenticated
        };
    },
    setPermissions(state,payload){
        state.auth.permissions = JSON.parse(payload)
    }
};

const actions = {
    async loginUser({ state, commit }, payload) {
        const res = await Vue.callApi("post", "/api/auth/login", {
            email: payload.email,
            password: payload.password
        });
        if(res.status === 200){
            localStorage.setItem("access_token", res.data.access_token);
            let payload = {
                user: res.data.user,
                isAuthenticated: true,
            }
            commit("setAuth", payload);
            commit("setPermissions",res.data.user.role.permissions)
            console.log("logged in")
            router.push({name:"dashboard"})
            //TODO SUCCESS MESSAGE
        } else if(res.status === 401){
            //UNAUTHERIZATION ERROR
            //TODO ERR MESSAGE
            console.log("unautherize")
        }else{
            //BİR SORUN OLUŞTU
        }
    },
    async logout({commit}){
        const res = await Vue.callApi("post", "/api/auth/logout")
        if(res.status === 200){
            console.log("logged out")
            localStorage.removeItem("access_token");
            let payload = {
                user:null,
                isAuthenticated: false
            }
            commit("setAuth",payload)
            window.location.replace("/v1/login")
        }
    },
    async initAuth({commit}){
        const res = await Vue.callApi("get", "/api/auth/current-user")
        if(res.status === 200){
            let payload = {
                user: res.data,
                isAuthenticated: true,
            }
            commit("setAuth",payload)
            commit("setPermissions",res.data.role.permissions)
        }
        else{
            console.log(res.status)
        }
    }
};

export default {
    state,
    getters,
    mutations,
    actions
};
