import Vue from "vue";
import Router from "vue-router";
import store from "../store"
import NotFound from "../commons/components/NotFound"
/**********BACKEND ********/
import authPaths from "../backend/auth/router";
import dashboardPaths from "../backend/dashboard/router";
import userPaths from "../backend/users/router";
import postPaths from "../backend/posts/router";
import rolePaths from "../backend/roles/router";
import permissionPaths from "../backend/permissions/router";
import categoryPaths from "../backend/categories/router";
import tagPaths from "../backend/tags/router";
import profilePaths from "../backend/profile/router";
import settingsPaths from "../backend/settings/router";
import staticPagesPaths from "../backend/static_pages/router";
Vue.use(Router);

var routes = [];
routes = routes.concat(
    dashboardPaths,
    userPaths,
    postPaths,
    rolePaths,
    categoryPaths,
    tagPaths,
    authPaths,
    permissionPaths,
    profilePaths,
    settingsPaths,
    staticPagesPaths,
    {
        path:'/:pathMatch(.*)*',
        component: NotFound,
        name:"notFound"
    },
);
const router = new Router({
    routes,
    mode: "history",
    linkActiveClass: 'active',
    linkExactActiveClass: "active",
});

router.beforeEach( async (to, from, next)=>{
    // requiresAuth olan route'lara uygula
    if(to.matched.some(route => route.meta.requiresAuth)){
        let auth = store.state.auth.auth
        //token var ama isaAuth false ise sayfa yenilenmiş ve state silinmiştir
        //tekrar initAuth ile user data'sını çek
        if(auth.access_token && !auth.isAuthenticated){
           await store.dispatch("initAuth")
            auth = store.state.auth.auth
        }
        //Geçerli bir kullanıcı değilse login'e yönlendir.
        if(!auth.isAuthenticated){
            next({name:"login"})
        }
        let rules = JSON.parse(auth.user.role.permissions); 
        let resource = to.path.split("/")
        let permission = rules.find(rule =>
            resource[2] === rule.resource_name
        )
        if(!permission.re) next({name:"dashboard"}) 
    }
    //login page
    if(to.name === "login"){
        let auth = store.state.auth.auth
        if(auth.isAuthenticated){
            next({name:"dashboard"})
        }
        else if(auth.access_token){
            await store.dispatch("initAuth")
            auth = store.state.auth.auth
            if(auth.isAuthenticated){
                next({name:"dashboard"})
            }
        }
    }
    next()
}) 

export default router