<template>
    <div>
        <div class="row mb-4">
            <div class="col-md-6">
                <h1>Categories</h1>
            </div>
            <div class="col-md-6 text-end">
                <button type="button" class="btn btn-primary" @click="createCategory">Add Category</button>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Products Count</th>
                <th>Created</th>
                <th>Updated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="category in categories" :key="category.id">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td>{{ category.products_count }}</td>
                <td>{{ category.created_at }}</td>
                <td>{{ category.updated_at }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm me-2" @click="editCategory(category)">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm" @click="deleteCategory(category)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form @submit.prevent="submitCategory">
                        <div class="modal-header">
                            <h5 class="modal-title" id="categoryModalLabel">{{ formTitle }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" v-model="category.name" required>
                                <div class="invalid-feedback">Please enter a category name.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
            category: {
                id: null,
                name: '',
                created_at: '',
                updated_at: '',
            },
            formAction: 'Create',
            formTitle: 'Add Category',
        };
    },
    created() {
        this.fetchCategories();
    },
    methods: {
        fetchCategories() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        createCategory() {
            this.formAction = 'Create';
            this.formTitle = 'Add Category';
            this.category.id = null;
            this.category.name = '';
            this.category.created_at = '';
            this.category.updated_at = '';
            $('#categoryModal').modal('show');
        },
        editCategory(category) {
            this.formAction = 'Update';
            this.formTitle = 'Edit Category';
            this.category.id = category.id;
            this.category.name = category.name;
            this.category.created_at = category.created_at;
            this.category.updated_at = category.updated_at;
            $('#categoryModal').modal('show');
        },
        submitCategory() {
            if (this.formAction === 'Create') {
                axios.post('/api/categories', this.category)
                    .then(response => {
                        $('#categoryModal').modal('hide');
                        this.fetchCategories();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else if (this.formAction === 'Update') {
                axios.put('/api/categories/' + this.category.id, this.category)
                    .then(response => {
                        $('#categoryModal').modal('hide');
                        this.fetchCategories();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        deleteCategory(category) {
            if (confirm('Are you sure you want to delete this category?')) {
                axios.delete('/api/categories/' + category.id)
                    .then(response => {
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
