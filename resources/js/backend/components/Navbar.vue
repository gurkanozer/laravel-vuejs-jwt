<template>
            <nav id="navbar" class="navbar navbar-expand-lg navbar-light border rounded bg-white shadow-sm">
                <div class="container-fluid">
                        <ul v-if="getAuth.isAuthenticated" class="nav ml-auto">
                            <a href="/" class="nav-link"><i class="fa fa-home"></i> Siteye Git</a>
                             <li class="nav-link">
                                 <router-link :to="{name:'profile'}" tag="a" ><i class="fa fa-user-circle-o"></i> Profil</router-link>
                             </li>
                             <li class="nav-item">
                                <button class="btn btn-outline-primary" @click="userLogout"><i class="fa fa-sign-out"></i> Çıkış</button>
                            </li>
                        </ul>
                </div>
            </nav>
</template>
<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return{

        }
    },
    computed:{
        ...mapGetters(["getAuth"])
    },
    methods:{
        async userLogout(){
            await this.$store.dispatch("logout")
        }
    }
}
</script>