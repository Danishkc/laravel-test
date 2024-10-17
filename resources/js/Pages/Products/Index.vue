<template>
    <NavLink :main="props.main" />
    <div class="content">
        <div class=" card">
            <div class="container">
                <div v-if="success" class="alert alert-success mt-3">
                    <button type="button" class="close" @click="clearSuccess" aria-hidden="true">&times;</button>
                    {{ success }}
                </div>
                <h1 class="text-2xl text-center">Products</h1>

                <form @submit.prevent="submit">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input v-model="form.product_name" id="product_name" type="text" class="form-control rounded">
                        <span class="text-danger text-xs" v-if="form.errors.product_name">{{
                        form.errors.product_name }}</span>
                    </div>

                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select v-model="form.category_id" id="category_id" class="form-control">
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.category_name }}
                            </option>
                        </select>
                        <span class="text-danger text-xs" v-if="form.errors.category_id">{{
                        form.errors.category_id }}</span>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input v-model="form.price" id="price" type="number" class="form-control rounded">
                        <span class="text-danger text-xs" v-if="form.errors.price">{{
                        form.errors.price }}</span>
                    </div>

                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input v-model="form.stock" id="stock" type="number" class="form-control rounded">
                        <span class="text-danger text-xs" v-if="form.errors.stock">{{
                        form.errors.stock }}</span>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>

                </form>

                <h2 class="text-2xl text-center mt-3 mb-3">Product List</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="product in products" :key="product.id">
                            <td>{{ product.product_name }}</td>
                            <td>{{ product.category.category_name }}</td>
                            <td>{{ product.price }}</td>
                            <td>{{ product.stock }}</td>
                            <td><button class="btn btn-danger" @click="deleteProduct(product.id)">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script setup>
import NavLink from '@/Components/NavLink.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps(['products', 'categories', 'success', 'errors', 'main']);


const form = useForm({
    product_name: '',
    category_id: '',
    price: '',
    stock: ''
});


function submit() {
    form.post('/products', {
        onSuccess: () => {
            console.log('Form submitted successfully!');
            form.reset();
        },
        onError: (errors) => {
            console.error('Form submission failed:', errors);
        }
    });
}

function deleteProduct(id){
    form.delete(`/products/${id}`);
}
</script>

<style scoped>
.content {
    margin-left: 300px;
    padding-top: 50px;
    margin-right: 40px;
}
</style>