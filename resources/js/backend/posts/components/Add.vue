<template>
    <div class="container p-4">
        <bread-crumb />
        <access-denied v-if="!permission.wr" />
        <Form
            v-else
            :class="!showEditor ? 'd-block' : 'd-none'"
            formTitle="Post Ekle"
            @onAction="setPost"
            :post="post"
        />
        <Editor
            @saveAction="create"
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
                tags: []
            },
            content: "<p>Bir şeyler</p>"
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
        async create(content) {
            const formData = new FormData();
            formData.append("title", this.post.title);
            formData.append("category_id", this.post.category_id);
            formData.append("tags", JSON.stringify(this.post.tags));
            formData.append("img", this.post.img);
            formData.append("content", JSON.stringify(content));

            let result = await this.$store.dispatch("createPost", formData);
                if (result) this.$router.push({name:"list-posts"});
        }
    }
};
</script>
