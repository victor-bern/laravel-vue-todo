import { App, plugin } from "@inertiajs/inertia-vue";
import VueRouter from "vue-router";
import Vue from "vue";

Vue.use(plugin);
const router = new VueRouter({
    mode: 'history'
});

const el = document.getElementById("app");

new Vue({
    router,
    render: (h) =>
        h(App, {
            props: {
                initialPage: JSON.parse(el.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(el);
