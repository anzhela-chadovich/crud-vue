<script setup>
import {ref} from "vue";

import router from "@/router/index.js";
import http from "@/services/Http.js";

let form = ref({
    name:'',
    description:'',
    image:'',
    category:'',
    quantity:'',
    price:''
})

const getImage = () => {
    let image = "storage/app/public/image.png"
    if(form.value.image){
        if(form.value.image.indexOf('base64') != -1){
            image = form.value.image
        }else{
            image='storage/app/public/'+form.value.image
        }
    }
    return image
}

const updateImage = (e) => {
    let file = e.target.files[0];
    let reader = new FileReader();
    let limit = 1024*1024*2;
    if(file['size'] > limit){
        return false
    }
    reader.onloadend = (file) => {
        form.value.image = reader.result;
    }
    reader.readAsDataURL(file);
}

const saveProduct = () => {
    const formData = new FormData()
    formData.append('name',form.value.name)
    formData.append('description',form.value.description)
    formData.append('category',form.value.category)
    formData.append('quantity',form.value.quantity)
    formData.append('price',form.value.price)
    formData.append('image',form.value.image)

        http.create_product(formData)
        .then(async function (response) {
                form.value.name='',
                form.value.description='',
                form.value.image='',
                form.value.category='',
                form.value.quantity='',
                form.value.price=''

            console.log(response.data);
            router.push('/')
        })
        .catch(async function (error) {
            console.error(error);
        })
}

</script>

<template>
<div class="container">
    <div class="titlebar">
        <h1>Add Product</h1>
        <button v-on:click="saveProduct()">Save</button>
    </div>
    <div class="card">
        <div>
            <label>Name</label>
            <input type="text" class="input" v-model="form.name">
            <label>Description (optional)</label>
            <textarea cols="10" rows="5" class="textarea" v-model="form.description" ></textarea>
            <form action="" method="" enctype="multipart/form-data">
                <label for="image">Add Image</label>
                <img :src="getImage()" alt="" class="img-product" />
                <input type="file" name="image" id="image" @change="updateImage" >
            </form>
        </div>
        <div>
            <label>Category</label>
            <select  name="category" v-model="form.category">
                <option value="Computer" >Computer</option>
                <option value="Smart TV" >Smart TV</option>
                <option value="Smartphone" >Smartphone</option>
            </select>
            <hr>
            <label>Inventory</label>
            <input type="text" class="input" v-model="form.quantity">
            <hr>
            <label>Price</label>
            <input type="text" class="input" v-model="form.price">
        </div>
    </div>
    <div class="titlebar">
        <h1></h1>
        <button v-on:click="saveProduct()">Save</button>
    </div>
</div>
</template>

<style scoped>

</style>
