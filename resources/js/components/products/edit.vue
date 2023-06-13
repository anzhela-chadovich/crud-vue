<script setup>

</script>

<template>
<div class="container">
    <div class="titlebar">
        <h1>Edit Product</h1>
        <button>Save</button>
    </div>
    <div class="card">
        <div>
            <label>Name</label>
            <input type="text" >
            <label>Description (optional)</label>
            <textarea cols="10" rows="5" ></textarea>
            <label>Add Image</label>
            <img src="1.jpg" alt="" class="img-product" />
            <input type="file" >
        </div>
        <div>
            <label>Category</label>
            <select  name="" id="" >
                <option value="" >Email Subscription</option>
            </select>
            <hr>
            <label>Inventory</label>
            <input type="text" class="input" >
            <hr>
            <label>Price</label>
            <input type="text" class="input" >
        </div>
    </div>
    <div class="titlebar">
        <h1></h1>
        <button>Save</button>
    </div>
</div>
</template>

<style scoped>

</style>
