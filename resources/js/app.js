require('./bootstrap');

import Vue from 'vue';

import CategoryList from './components/CategoryList.vue';
import ProductList from './components/ProductList.vue';
import LanguagemSelect from "./components/LanguagemSelect.vue";

const app = new Vue({
    el: '#app',
    components: {
        CategoryList,
        ProductList,
        LanguagemSelect
    }
});
