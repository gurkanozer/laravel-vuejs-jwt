import Vue from "vue";
import Vuex from "vuex";

/**BACKEND */
import users from "../backend/users/store";
import roles from "../backend/roles/store";
import permissions from "../backend/permissions/store";
import posts from "../backend/posts/store";
import categories from "../backend/categories/store";
import tags from "../backend/tags/store";
import auth from "../backend/auth/store";
import profile from "../backend/profile/store";
import settings from "../backend/settings/store";
import static_pages from "../backend/static_pages/store";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        systemAlert:{
            type:"success",
            message:"This is alert test",
            isActive:false
        },
        token: window.Laravel.csrf_token
    },
    getters: {
       getAlert(){
           return state.systemAlert
       } 
    },
    mutations:{
       setAlert(state,payload){
        state.systemAlert = payload
       },
    },
    actions: {
        setAlert({commit},payload){
            commit("setAlert",payload)
        },
    },
    modules: {
        users,
        roles,
        permissions,
        posts,
        categories,
        tags,
        auth,
        profile,
        settings,
        static_pages
    }
});

export default store;
