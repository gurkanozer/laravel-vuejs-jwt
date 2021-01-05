<template>
  <nav id="sidebar">
    <div class="sidebar-header text-center">
      <h3>{{ settings.blog_name }}</h3>
      <strong
        ><img
          :src="'/uploads/thumbnail/' + settings.blog_logo"
          width="30px"
          height="30px"
      /></strong>
    </div>
    <ul class="list-unstyled components">
      <!-- <li
                v-for="(per, index) in getAuth.permissions"
                :key="index"
                v-if="per.re"
            >
                <router-link tag="a" :to="{ name: 'dashboard' }"
                    ><span>{{ per.resource_name }}</span></router-link
                >
            </li> -->
      <li>
        <router-link tag="a" :to="{ name: 'dashboard' }"
          ><i class="fa fa-tachometer"></i> <span>Dashboard</span></router-link
        >
      </li>
      <li>
        <router-link tag="a" :to="{ name: 'settings' }"
          ><i class="fa fa-gears"></i> <span>Settings</span></router-link
        >
      </li>
      <li>
        <router-link tag="a" :to="{ name: 'list-roles' }"
          ><i class="fa fa-user-plus"></i> <span>User Roles</span></router-link
        >
      </li>
      <li>
        <router-link tag="a" :to="{ name: 'list-users' }"
          ><i class="fa fa-user"></i> <span>Users</span></router-link
        >
      </li>
      <li>
        <router-link tag="a" :to="{ name: 'list-posts' }"
          ><i class="fa fa-rss-square"></i> <span>Posts</span></router-link
        >
      </li>
      <li>
        <router-link tag="a" :to="{ name: 'list-categories' }"
          ><i class="fa fa-th"></i> <span>Categories</span></router-link
        >
      </li>
      <li>
        <router-link tag="a" :to="{ name: 'list-tags' }"
          ><i class="fa fa-tag"></i> <span>Tags</span></router-link
        >
      </li>
    </ul>
  </nav>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  props: ["settings"],
  computed: {
    ...mapGetters(["getAuth"]),
  },
  async created() {
    if (this.getAuth.length <= 0) await this.$store.dispatch("initAuth");
  },
};
</script>
