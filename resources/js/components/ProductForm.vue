<template>
    <div>
        <h1>{{ productId ? 'Edit' : 'Add' }} Product</h1>
        <form @submit.prevent="submitForm">
            <div>
                <label for="name">Name</label>
                <input v-model="form.name" id="name" type="text" required />
            </div>
            <div>
                <label for="description">Description</label>
                <textarea v-model="form.description" id="description"></textarea>
            </div>
            <div>
                <label for="price">Price</label>
                <input v-model="form.price" id="price" type="number" required />
            </div>
            <button type="submit">{{ productId ? 'Update' : 'Create' }} Product</button>
        </form>
    </div>
</template>

<script>
import axios from '../axios';
import { mapGetters } from 'vuex';

export default {
    data() {
        return {
            form: {
                name: '',
                description: '',
                price: '',
            },
            productId: null,
        };
    },
    created() {
        if (this.$route.params.id) {
            this.productId = this.$route.params.id;
            this.fetchProduct();
        }
    },
    methods: {
        fetchProduct() {
            axios.get(`/products/${this.productId}`)
                .then(response => {
                    this.form = response.data;
                })
                .catch(error => {
                    console.error('Error fetching product:', error);
                });
        },
        submitForm() {
            if (this.productId) {
                axios.put(`/products/${this.productId}`, this.form)
                    .then(response => {
                        alert('Product updated');
                        this.$router.push('/');
                    })
                    .catch(error => {
                        console.error('Error updating product:', error);
                    });
            } else {
                axios.post('/products', this.form)
                    .then(response => {
                        alert('Product created');
                        this.$router.push('/');
                    })
                    .catch(error => {
                        console.error('Error creating product:', error);
                    });
            }
        }
    }
};
</script>
