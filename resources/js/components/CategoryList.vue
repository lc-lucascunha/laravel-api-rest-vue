<template>
    <div>
        <div class="row">
            <div class="col-sm-6">
                <h1>{{ labels[lang].categories }}</h1>
            </div>
            <div class="col-sm-6 text-end">
                <button type="button" class="btn btn-success" @click="createCategory">{{ labels[lang].addCategory }}</button>
            </div>
        </div>

        <div class="row pt-0">
            <div class="col-sm-12">
                <div class="input-group">
                    <input type="text" class="form-control" :placeholder="labels[lang].textSearch" v-model="searchText">
                    <div class="input-group-text cursor-pointer" :title="labels[lang].clearSearch" v-if="searchText" @click="searchText = ''">x</div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>{{ labels[lang].id }}</th>
                <th>{{ labels[lang].name }}</th>
                <th class="text-center">{{ labels[lang].productsCount }}</th>
                <th class="text-center">{{ labels[lang].created }}</th>
                <th class="text-center">{{ labels[lang].updated }}</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="category in categories" :key="category.id">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td class="text-center">
                    <label class="count rounded-circle"
                           :title="labels[lang].textSearchProducts"
                           v-if="category.products_count > 0"
                           @click="emitCategories('search', category.name)">
                        {{category.products_count}}
                    </label>
                    <label class="count-null rounded-circle" v-else>0</label>
                </td>
                <td class="text-center">{{ category.created_at }}</td>
                <td class="text-center">{{ category.updated_at }}</td>
                <td class="text-end">
                    <button type="button" class="btn btn-primary btn-sm me-2" @click="editCategory(category)">{{ labels[lang].edit }}</button>
                    <button type="button" class="btn btn-danger btn-sm" @click="deleteCategory(category)">{{ labels[lang].delete }}</button>
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
                                <label for="name">{{ labels[lang].name }}</label>
                                <input type="text" class="form-control" id="name" v-model="category.name" required>
                                <div class="invalid-feedback">Please enter a category name.</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ labels[lang].cancel }}</button>
                            <button type="submit" class="btn btn-primary">{{ formAction }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import bus from '../eventBus';
import _ from 'lodash';

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
            formAction: '',
            formTitle: '',
            searchText: '',
            lang: 'en',
            labels: {
                en: {
                    categories: 'Categories',
                    addCategory: 'Add Category',
                    editCategory: 'Edit Category',

                    id: 'ID',
                    name: 'Name',
                    productsCount: 'Products Count',
                    created: 'Created',
                    updated: 'Updated',

                    edit: 'Edit',
                    delete: 'Delete',
                    create: 'Create',
                    update: 'Update',
                    cancel: 'Cancel',

                    clearSearch: 'Clear search',

                    textSearch: 'Search by Name...',
                    textConfirDelete: 'Are you sure you want to delete this category?',
                    textSearchProducts: 'Search products by this category',
                },
                pt: {
                    categories: 'Categorias',
                    addCategory: 'Adicionar Categoria',
                    editCategory: 'Editar Categoria',

                    id: 'ID',
                    name: 'Nome',
                    productsCount: 'Quantidade de Produtos',
                    created: 'Criado em',
                    updated: 'Atualizado em',

                    edit: 'Editar',
                    delete: 'Excluir',
                    create: 'Cadastrar',
                    update: 'Atualizar',
                    cancel: 'Cancelar',

                    clearSearch: 'Limpar busca',

                    textSearch: 'Buscar por Nome...',
                    textConfirDelete: 'Tem certeza de que deseja excluir esta categoria?',
                    textSearchProducts: 'Buscar produtos por esta categoria',
                },
            },
        };
    },
    created() {
        this.fetchCategories();

        bus.$on('product-created', () => {
            this.fetchCategories();
        });

        bus.$on('product-updated', () => {
            this.fetchCategories();
        });

        bus.$on('product-deleted', () => {
            this.fetchCategories();
        });

        bus.$on('languagem-select', (lang) => {
            this.fetchLang(lang);
        });
    },
    watch: {
        searchText: _.debounce(function() {
            this.fetchCategories();
        }, 500)
    },
    methods: {
        emitCategories(event, data = null){
            bus.$emit('category-'+event, data);
        },
        fetchLang(lang) {
            this.lang = lang;
        },
        fetchCategories() {
            let url = '/api/categories';

            if (this.searchText) {
                url += '?q=' + encodeURIComponent(this.searchText.trim());
            }

            axios.get(url)
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        createCategory() {
            this.formAction = this.labels[this.lang].create;
            this.formTitle = this.labels[this.lang].addCategory;
            this.category.id = null;
            this.category.name = '';
            this.category.created_at = '';
            this.category.updated_at = '';
            $('#categoryModal').modal('show');
        },
        editCategory(category) {
            this.formAction = this.labels[this.lang].update;
            this.formTitle = this.labels[this.lang].editCategory;
            this.category.id = category.id;
            this.category.name = category.name;
            this.category.created_at = category.created_at;
            this.category.updated_at = category.updated_at;
            $('#categoryModal').modal('show');
        },
        submitCategory() {
            if (this.formAction === this.labels[this.lang].create) {
                axios.post('/api/categories', this.category)
                    .then(response => {
                        $('#categoryModal').modal('hide');
                        this.searchText = '';
                        this.fetchCategories();
                        this.emitCategories('created');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            } else if (this.formAction === this.labels[this.lang].update) {
                axios.put('/api/categories/' + this.category.id, this.category)
                    .then(response => {
                        $('#categoryModal').modal('hide');
                        this.fetchCategories();
                        this.emitCategories('updated');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        deleteCategory(category) {
            if (confirm(this.labels[this.lang].textConfirDelete)) {
                axios.delete('/api/categories/' + category.id)
                    .then(response => {
                        this.fetchCategories();
                        this.emitCategories('deleted');
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
    },
};
</script>
