import Vue from 'vue';
import Router from 'vue-router';
import ProductList from '../components/ProductList.vue';
import ProductForm from '../components/ProductForm.vue';

Vue.use(Router);

export default new Router({
    routes: [
        {
            path: '/',
            name: 'product-list',
            component: ProductList
        },
        {
            path: '/product/:id',
            name: 'edit-product',
            component: ProductForm
        },
        {
            path: '/add-product',
            name: 'add-product',
            component: ProductForm
        }
    ]
});
