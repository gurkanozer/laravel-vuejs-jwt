<template>
    <div class="container p-4">
        <bread-crumb />
        <access-denied v-if="!permission.wr" />
        <Form
            v-else
            :class="!showEditor ? 'd-block' : 'd-none'"
            formTitle="Post Düzenle"
            @onAction="setPost"
            :post="post"
        />
        <Editor
            @saveAction="update"
            @pageAction="prevPage"
            :content="content"
            :class="showEditor ? 'd-block' : 'd-none'"
        />
    </div>
</template>
<script>
import Form from "./Form";
import Editor from "./Editor";
import AccessDenied from "../../components/AccessDenied";
import BreadCrumb from "../../components/BreadCrumb";

export default {
    components: {
        Form,
        BreadCrumb,
        AccessDenied,
        Editor
    },
    data() {
        return {
            showEditor: false,
            post: {
                title: "",
                category_id: "",
                tags: [],
                id: ""
            },
            content: ""
        };
    },
    async created() {
        this.permission = Vue.checkPermission(this.$route.path.split("/"));
    },
    methods: {
        setPost(data) {
            this.post = data.post;
            this.showEditor = data.showEditor;
        },
        prevPage(data) {
            this.showEditor = data;
        },
        async update(content) {
            const formData = new FormData();
            formData.append("id", this.post.id);
            formData.append("title", this.post.title);
            formData.append("category_id", this.post.category_id);
            formData.append("tags", JSON.stringify(this.post.tags));
            formData.append("content", JSON.stringify(content));
            if (this.post.img) formData.append("img", this.post.img);

            let result = await this.$store.dispatch("editPost", formData);
            if (result) this.$router.push({name:"list-posts"});
        },
        async setData(post) {
            this.post = {
                title: post.title,
                category_id: post.category_id,
                tags: post.tag,
                img: post.img,
                id: post.id
            };
            this.content = JSON.parse(post.content);
        }
    },

    async beforeRouteEnter(to, from, next) {
        const res = await Vue.callApi("get", `/api/get_posts/${to.params.id}`);
        if (res.status === 200) {
            next(vm => vm.setData(res.data));
        } else if (res.status === 403) {
            next(false);
        }
    }
};
</script>
