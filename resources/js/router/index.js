import {createRouter, createWebHistory} from "vue-router";

import productIndex from '../components/products/index.vue'
import productEdit from '../components/products/edit.vue'
import productCreate from '../components/products/create.vue'

const routes = [
    {
        path:'/',
        component: productIndex
    },
    {
        path:'/productEdit',
        component: productEdit
    },
    {
        path: '/productCreate',
        component: productCreate
    }
]

const router = createRouter({
    history:createWebHistory(),
    routes
})
export default router
