import {createRouter, createWebHistory} from "vue-router";

import productIndex from '../components/products/index.vue'
import productEdit from '../components/products/edit.vue'
import productCreate from '../components/products/create.vue'
import notFound from "../components/products/notFound.vue";

const routes = [
    {
        path:'/',
        component: productIndex
    },
    {
        path:'/productEdit/:id',
        component: productEdit,
        props:true
    },
    {
        path: '/productCreate',
        component: productCreate
    },
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
]

const router = createRouter({
    routes,
    history:createWebHistory()
})
export default router
