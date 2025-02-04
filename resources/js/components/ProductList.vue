<template>
    <div>
        <h1>Product List</h1>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.name }}</td>
                    <td>{{ product.description }}</td>
                    <td>{{ product.price }}</td>
                    <td>
                        <button @click="editProduct(product.id)">Edit</button>
                        <button @click="deleteProduct(product.id)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from '../axios';

export default {
    data() {
        return {
            products: [],
        };
    },
    created() {
        this.fetchProducts();
    },
    methods: {
        fetchProducts() {
            axios.get('/products')
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                });
        },
        editProduct(id) {
            this.$router.push({ name: 'edit-product', params: { id } });
        },
        deleteProduct(id) {
            axios.delete(`/products/${id}`)
                .then(response => {
                    alert(response.data.message);
                    this.fetchProducts();
                })
                .catch(error => {
                    console.error('Error deleting product:', error);
                });
        }
    }
};
</script>
