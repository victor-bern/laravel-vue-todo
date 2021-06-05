<template>
  <main>
    <div class="nav">
      <div v-if="!isLogged" style="margin-right: 32px">
        <md-menu md-direction="top-start">
          <inertia-link href="signin">
            <md-button md-menu-trigger>Sign In</md-button>
          </inertia-link>
        </md-menu>

        <md-menu md-direction="top-end">
          <inertia-link href="login">
            <md-button class="pow">Login</md-button>
          </inertia-link>
        </md-menu>
      </div>
        <div style="margin-right: 32px" v-else>
            <md-menu md-direction="top-start">
                <inertia-link href="signin">
                    <md-button v-on:click.prevent="logout" md-menu-trigger>Logout</md-button>
                </inertia-link>
            </md-menu>
        </div>
    </div>
    <article>
      <slot />
    </article>
  </main>
</template>

<script>
import Vue from "vue";
import VueMaterial from "vue-material";
import "vue-material/dist/vue-material.min.css";
import "vue-material/dist/theme/default.css";

Vue.use(VueMaterial);
export default {
    data(){
        return{
            isLogged: false
        }
    },
    methods: {
        logout: function () {
            window.localStorage.removeItem("user_token");
            window.localStorage.removeItem("user_id");
            this.isLogged = false;
            this.$inertia.get('/login');
        }
    },
    mounted() {
        if(window.localStorage.getItem("user_token")){
            this.isLogged = true;
        }
    }
};
</script>

<style>
body {
  height: 100%;
}
.nav {
  display: flex;
  height: 50px;
  justify-content: flex-end;
  align-items: center;
  max-width: 100%;
  background: #4e49f0;
  color: white;
}


</style>
