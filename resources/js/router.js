import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import HomePage from './components/pages/HomePage.vue';
import AboutPage from './components/pages/AboutPage.vue';
import ContactsPage from './components/pages/ContactsPage.vue';
import PostDetailPage from './components/pages/PostDetailPage.vue';
import NotFoundPage from './components/pages/NotFoundPage.vue';

const routes = new VueRouter({
    mode: 'history',
    linkExactActiveClass:'active',
    routes:[
        {path:'/',component:HomePage,name:'home'},
        {path:'/about',component:AboutPage,name:'about'},
        {path:'/contacts',component:ContactsPage,name:'contact'},
        {path:'/posts/:slug',component:PostDetailPage,name:'post-detail'},
        {path:'*',component:NotFoundPage,name:'not_found'},
    ]
})

export default routes; 