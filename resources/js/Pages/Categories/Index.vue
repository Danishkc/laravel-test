<template>
    <NavLink />
    <div class="content">
        <div class=" card">
            <div class="container">
                <div v-if="success" class="alert alert-success mt-3">
                    <button type="button" class="close" @click="clearSuccess" aria-hidden="true">&times;</button>
                    {{ success }}
                </div>
                <h1 class="text-2xl text-center mt-3 mb-3">Categories</h1>
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <label for="name">Category Name</label>
                        <input v-model="form.category_name" id="name" type="text" class="form-control rounded">
                        <span class="text-danger text-xs" v-if="form.errors.category_name">{{
                        form.errors.category_name }}</span>
                    </div>
                    <div class="text-center mt-3 mb-3">
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>

                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Category Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="category in categories" :key="category.id">
                            <td>{{ category.category_name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps(['categories', 'success','errors']);

const form = useForm({
    category_name: '',
});


function submit() {
    form.post('/categories', {
        onSuccess: () => {
            console.log('Form submitted successfully!');
            form.reset();
        },
        onError: (errors) => {
            console.error('Form submission failed:', errors);
        }
    });
}
</script>

<style scoped>
.content {
    margin-left: 300px;
    padding-top: 50px;
    margin-right: 40px;
}
</style>