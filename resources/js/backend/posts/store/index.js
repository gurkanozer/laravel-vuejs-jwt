const state = {
    posts: []
};

const getters = {
    getPosts: state => {
        return state.posts;
    }
};

const mutations = {
    setPosts(state, payload) {
        state.posts = payload;
    },
    addToPosts(state, payload) {
        state.posts.push(payload);
    },
    updatePosts(state, payload) {
        state.posts = state.posts.map(post => {
            if (post.id === payload.id) return payload;
            else return post;
        });
    },
    removeFromPosts(state, payload) {
        const stateAfterDelete = state.posts.filter(
            post => post.id !== payload
        );
        state.posts = stateAfterDelete;
    }
};

const actions = {
    async getPosts({ commit }) {
        const res = await Vue.callApi("get", "/api/get_posts");
        if (res.status === 200) {
            commit("setPosts", res.data);
        } else {
            commit("setAlert", {
                type: "warning",
                isActive: true,
                message: res.data.message
            });
        }
    },
    async createPost({ commit }, payload) {
        const res = await Vue.callApi("post", "/api/add_post", payload);
        if (res.status === 201) {
            commit("addToPosts", res.data);
            // console.log(res.data)
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
                message: "Girilen bilgiler yanlış veya eksik"
            });
            return false
        } else {console.log("Error: ", res.data, "Status: ", res.status); return false}
    },
    async editPost({commit},payload){
        const res = await Vue.callApi("post","/api/edit_post",payload);
        if(res.status === 200){
            commit("updatePosts",res.data);
            commit("setAlert",{
                type:"success",
                isActive:true,
                message:"İşlem Tamamlandı"
            })
            return true
        }else if(res.status === 422){
            commit("setAlert",{
                type:"warning",
                isActive:true,
                message:"Girilen bilgiler yanlış veya eksik"
            })
            return false
        }
    },

    async deletePost({ commit }, payload) {
        const res = await Vue.callApi("post", "/api/delete_post", payload);
        if (res.status === 200) {
            commit("removeFromPosts", payload.id);
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
