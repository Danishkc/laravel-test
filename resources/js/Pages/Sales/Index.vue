<template>
    <NavLink />
    <div class="content">
        <div class="card">
            <div class="container">
                <div v-if="success" class="alert alert-success mt-3">
                    <button type="button" class="close" @click="clearSuccess" aria-hidden="true">&times;</button>
                    {{ success }}
                </div>
                <h1 class="text-2xl text-center">Sales</h1>
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <label for="product_id">Product</label>
                        <select v-model="form.product_id" id="product_id" class="form-control" @change="updatePrice">
                            <option v-for="product in products" :key="product.id" :value="product.id">
                                {{ product.product_name }} - ₹ {{ product.price }}
                            </option>
                        </select>
                        <span class="text-danger text-xs" v-if="form.errors.product_id">{{
                        form.errors.product_id }}</span>
                    </div>

                    <div class="form-group">
                        <label for="sale_qty">Quantity</label>
                        <input v-model="form.sale_qty" id="sale_qty" type="number" class="form-control rounded"
                            @input="calculateTotalPrice">
                        <span class="text-danger text-xs" v-if="form.errors.sale_qty">{{
                        form.errors.sale_qty }}</span>
                    </div>

                    <div class="form-group mt-3">
                        <label>Total Price: ₹ {{ total_price }}</label>
                    </div>

                    <div class="text-center mt-3 mb-3">
                        <button type="submit" class="btn btn-success">Complete Sale</button>
                    </div>
                    
                </form>

                <h2 class="text-2xl text-center mb-3 mt-3">Sales List</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="sale in sales" :key="sale.id">
                            <td>{{ sale.product.product_name }}</td>
                            <td>{{ sale.sale_qty }}</td>
                            <td>{{ sale.total_price }}</td>
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

const props = defineProps(['products', 'sales', 'success', 'errors']);

const total_price = ref(0);

const form = useForm({
    product_id : '',
    sale_qty : '',
});

const updatePrice = () => {
  const selectedProduct = props.products.find(p => p.id === form.product_id);
  total_price.value = selectedProduct.price * sale_qty.value;
};

const calculateTotalPrice = () => {
  const selectedProduct = props.products.find(p => p.id === form.product_id);
  if (selectedProduct) {
    total_price.value = selectedProduct.price * sale_qty.value;
  }
};

function submit() {
    form.post('/sales', {
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