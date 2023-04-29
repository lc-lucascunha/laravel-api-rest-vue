<template>
    <div>
        <div class="row mb-4">
            <div class="col-md-6">
                <h1>Products</h1>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-success" @click="createProduct">Add Product</button>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th class="text-center">Created</th>
                <th class="text-center">Updated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="product in products" :key="product.id">
                <td>{{ product.id }}</td>
                <td>{{ product.name }}</td>
                <td>{{ product.category.name }}</td>
                <td class="text-center">{{ product.created_at }}</td>
                <td class="text-center">{{ product.updated_at }}</td>
                <td class="text-end">
                    <button type="button" class="btn btn-primary btn-sm me-2" @click="editProduct(product)">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" @click="deleteProduct(product)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="submitProduct">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productModalLabel">{{ formTitle }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" v-model="product.name" required>
                                <div class="invalid-feedback">Please enter a product name.</div>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" v-model="product.category_id" required>
                                    <option></option>
                                    <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                                </select>
                                <div class="invalid-feedback">Please select a category.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">{{ formAction }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            categories: [],
            products: [],
            product: {
                id: null,
                name: '',
                category_id: null,
                created_at: '',
                updated_at: '',
            },
            formAction: 'Create',
            formTitle: 'Add Product',
        };
    },
    created() {
        this.fetchProducts();
        this.fetchCategories();
    },
    methods: {
        fetchProducts() {
            axios.get('/api/products')
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fetchCategories() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        createProduct() {
            this.formAction = 'Create';
            this.formTitle = 'Add Product';
            this.product.id = null;
            this.product.name = '';
            this.product.category_id = null;
            this.product.created_at = '';
            this.product.updated_at = '';
            $('#productModal').modal('show');
        },
        editProduct(product) {
            this.formAction = 'Update';
            this.formTitle = 'Edit Product';
            this.product.id = product.id;
            this.product.name = product.name;
            this.product.category_id = product.category_id;
            this.product.created_at = product.created_at;
            this.product.updated_at = product.updated_at;
            $('#productModal').modal('show');
        },
        submitProduct() {
            if (this.formAction === 'Create') {
                axios.post('/api/products', this.product)
                    .then(response => {
                        $('#productModal').modal('hide');
                        this.fetchProducts();
                        this.fetchCategories();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else if (this.formAction === 'Update') {
                axios.put('/api/products/' + this.product.id, this.product)
                    .then(response => {
                        $('#productModal').modal('hide');
                        this.fetchProducts();
                        this.fetchCategories();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        deleteProduct(product) {
            if (confirm('Are you sure you want to delete this product?')) {
                axios.delete('/api/products/' + product.id)
                    .then(response => {
                        this.fetchProducts();
                        this.fetchCategories();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
    },
};
</script>