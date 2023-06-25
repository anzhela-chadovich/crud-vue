<script setup>
import { ref, onMounted } from 'vue'
import router from "@/router/index.js";
import http from "@/services/Http.js";

let products = ref([])
let searchProduct = ref([])

onMounted(async () => {
    getProducts()
})

const addProduct = () => {router.push('/productCreate')}

const editProduct =(id) => {router.push('/productEdit/'+id)}

const getProducts = async () => {
    http.get_all_products().then(response => {
        products.value = response.data.products
        console.log('products', products.value)
    })
}

const search = async () => {
    http.find(searchProduct.value).then(response => {
        products.value = response.data.products
        console.log('products', products.value)
    })
}

const deleteProduct = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        if (result.value) {
            http.delete_one_product(id)
                .then(()=>{
                    getProducts()
                })
                .catch(()=>{})
        }
    })
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
            <div>
                <div class="relative">
                    <input class="search-input"  type="text" name="search" placeholder="Search product..."
                    v-model="searchProduct" @keyup="search()">
                </div>
            </div>
            <div class="table-product-head">
                <p>Image</p>
                <p>Name</p>
                <p>Category</p>
                <p>Inventory</p>
                <p>Actions</p>
            </div>

            <div class="table-product-body" v-for="product in products" :key="product.id" >
                <img class="products_image" :src="'/storage/'+product.image" style="height: 40px;" v-if="product.image"/>
                <p> {{product.name}}</p>
                <p>{{product.category}}</p>
                <p>{{product.quantity}}</p>
                <div>
                    <button class="btn btn-success" @click="editProduct(product.id)">
                        <i class="fas fa-pencil-alt" ></i>
                    </button>
                    <button class="btn btn-danger" @click="deleteProduct(product.id)">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
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
