<script setup>
import { ref, onMounted } from 'vue'
import {useRouter} from "vue-router";
import router from "@/router/index.js";

// declare a ref to hold the element reference
// the name must match template ref value
//const input = ref(null)

let products = ref([])

onMounted(async () => {
    getProducts()
})

const addProduct = () => {router.push('/productCreate')}

const getProducts = async () => {
    let response = await axios.get("/api/get_products")
    products.value = response.data.products
    console.log('products', products.value)
}

const ourImage = (img) =>{
    return "/upload/"+img
}
</script>

<template>
    <div class="container">
        <div class="titlebar">
            <h1>Products</h1>
            <button class="add-btn" @click="addProduct">Add Product</button>
                </div>
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <p class="table-filter-link link-active">All</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-search">
                <div>
                    <button class="search-select">
                        Search Product
                    </button>
                    <span class="search-select-arrow">
                            <i class="fas fa-caret-down"></i>
                        </span>
                </div>
                <div class="relative">
                    <input class="search-input" type="text" name="search" placeholder="Search product..." >
                </div>
            </div>
            <div class="table-product-head">
                <p>Image</p>
                <p>Name</p>
                <p>Category</p>
                <p>Inventory</p>
                <p>Actions</p>
            </div>

            <div class="table-product-body" v-for="product in products" :key="product.id" v-if="products.length > 0">
                <img class="products_image" :src="ourImage(product.image)" style="height: 40px;" v-if="product.image"/>
                <p> {{product.name}}</p>
                <p>{{product.category}}</p>
                <p>{{product.quantity}}</p>
                <div>
                    <button class="btn btn-success" >
                        <i class="fas fa-pencil-alt" ></i>
                    </button>
                    <button class="btn btn-danger" >
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="table-product-body" v-else>
                <p>Product not Found</p>
            </div>
            <div class="table-paginate">
                <div class="pagination">
                    <a href="#" disabled>&laquo;</a>
                    <a class="active-page">1</a>
                    <a>2</a>
                    <a>3</a>
                    <a href="#">&raquo;</a>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
