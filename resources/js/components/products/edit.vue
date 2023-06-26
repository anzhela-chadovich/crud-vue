<script setup>
import {onMounted,ref} from "vue";
import router from "@/router/index.js";
import http from "@/services/Http.js";

let form = ref({
    id:'',
    name:'',
    description:'',
    image:'',
    category:'',
    quantity:'',
    price:''
})

onMounted(async () => {
    getProduct()
})

const props = defineProps({
    id:{
        type:String,
        default:''
    }
})
const getProduct = async () => {
    http.get_editable_product(props.id).then(response => {
        form.value=response.data
    })}

const getImage = () => {
    let image = "/storage/image.png"
    if(form.value.image){
        if(form.value.image.indexOf('base64') != -1){
            image = form.value.image
        }else{
            image='/storage/'+form.value.image
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

const saveChanges = () =>{
    const formData = new FormData()
    formData.append('name',form.value.name)
    formData.append('description',form.value.description)
    formData.append('category',form.value.category)
    formData.append('quantity',form.value.quantity)
    formData.append('price',form.value.price)
    formData.append('image',form.value.image)

        http.save_editable_product(form.value.id,formData)
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
        <h1>Edit Product</h1>
        <button v-on:click="saveChanges()">Save</button>
    </div>
    <div class="card">
        <div>
            <label>Name</label>
            <input type="text" class="input" v-model="form.name">
            <label>Description (optional)</label>
            <textarea cols="10" rows="5" class="textarea" v-model="form.description" ></textarea>
            <label for="myfile">Add Image</label>
            <img :src="getImage()" alt="" class="img-product" />
            <input type="file" id="myfile" @change="updateImage" >
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
        <button v-on:click="saveChanges()">Save</button>
    </div>
</div>
</template>

<style scoped>

</style>
