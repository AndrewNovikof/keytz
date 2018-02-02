<template>
    <div>
        <div class="uk-container">
            <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
                <div class="uk-width-1-1@m uk-first-column">
                    <h1 class="uk-margin-remove-top uk-text-left uk-heading-primary">
                        {{ catalog.name }}
                    </h1>
                    <div class="uk-margin" v-if="(can_create === true) || (can_update === true)">
                        <input v-model="catalog.name" class="uk-input" type="text" placeholder="Name">
                    </div>
                    <p class="uk-article-meta" v-if="catalog.id > 0">
                        Created by <b>{{ catalog.owner.name }}</b></p>
                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid"
                         v-if="(can_create === true) || (can_update === true)">
                        <label><input class="uk-checkbox" type="checkbox" v-model="catalog.is_public"> Public
                            access</label>
                    </div>
                    <div class="uk-margin uk-container uk-container-small">
                        <button v-if="can_create === true" @click="createCatalog()" class="uk-button uk-button-default">
                            Create
                        </button>
                        <button v-if="can_update === true" @click="updateCatalog()" class="uk-button uk-button-default">
                            Update
                        </button>
                        <button v-if="can_delete === true" @click="deleteCatalog()" class="uk-button uk-button-default">
                            Delete
                        </button>
                    </div>
                    <div class="uk-margin uk-container uk-container-small" v-if="can_update === true">
                        <label for="books">Select books</label>
                        <multiselect v-model="catalog.books.data" id="books"
                                     label="name"
                                     track-by="id"
                                     placeholder="Type to search"
                                     open-direction="bottom"
                                     :options="books"
                                     :multiple="true"
                                     :searchable="true"
                                     :loading="isLoading"
                                     :internal-search="false"
                                     :clear-on-select="false"
                                     :close-on-select="false"
                                     :limit="20"
                                     :value="Object"
                                     :limit-text="limitText"
                                     :max-height="600"
                                     :show-no-results="false"
                                     :hide-selected="true"
                                     @search-change="findBooks"
                                     @select="selectBook"
                                     @remove="removeBook">
                        </multiselect>
                    </div>
                </div>
            </div>
            <div class="uk-grid-margin uk-margin-large" v-if="catalog.books.data.length > 0">
                <div class="el-item uk-panel uk-margin-large" v-for="book in catalog.books.data">
                    <h3 class="el-title uk-margin uk-margin-remove-adjacent uk-margin-remove-bottom">
                        {{ book.name }}
                    </h3>

                    <div class="el-meta uk-margin uk-text-muted">
                        {{ book.author.name }}
                    </div>
                    <div class="el-content uk-margin">
                        {{ book.text }}
                    </div>
                    <p class="uk-text-center uk-margin-medium" @click="showBook(book.id)">
                        <a class="uk-button uk-button-text">Continue reading</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';

    export default {
        data() {
            return {
                catalog: {
                    id: '',
                    name: '',
                    is_public: false,
                    owner: {
                        name: ''
                    },
                    books: {
                        data: {
                            id: '',
                            name: '',
                            text: '',
                            author: {
                                name: ''
                            },
                            created: ''
                        },
                    }
                },
                can_create: false,
                can_update: false,
                can_delete: false,
                books: [
                    {
                        id: '',
                        name: '',
                        text: '',
                        author: {
                            name: ''
                        },
                        created: ''
                    }
                ],
                isLoading: false
            };
        },
        mounted() {
            this.prepareComponent();
        },

        components: {
            Multiselect
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                if (this.$route.params.catalog_id) {
                    this.getCatalog();
                } else {
                    this.getAccessToCreate()
                }
            },

            getCatalog() {
                axios.get('/api/catalogs/' + this.$route.params.catalog_id, {
                    params: {
                        includes: 'books'
                    }
                })
                    .then(response => {
                        this.catalog = response.data;
                        this.getAccessToUpdate();
                        this.getAccessToDelete();
                    })
                    .catch(error => {
                        this.passError(error)
                    });
            },

            getAccessToCreate() {
                axios.get('/api/users/can', {
                    params: {
                        action: 'create catalogs'
                    }
                }).then(response => {
                    this.can_create = response.data.data;
                }).catch(error => {
                    this.passError(error)
                });
            },

            getAccessToUpdate() {
                axios.get('/api/catalogs/' + this.catalog.id + '/can', {
                    params: {
                        action: 'update'
                    }
                }).then(response => {
                    this.can_update = response.data.data;
                }).catch(error => {
                    this.passError(error)
                });
            },

            getAccessToDelete() {
                axios.get('/api/catalogs/' + this.catalog.id + '/can', {
                    params: {
                        action: 'delete'
                    }
                }).then(response => {
                    this.can_delete = response.data.data;
                }).catch(error => {
                    this.passError(error)
                });
            },

            updateCatalog() {
                axios.put('/api/catalogs/' + this.catalog.id, this.catalog)
                    .then(response => {
                        this.$notify({
                            title: 'Good!',
                            text: 'Catalog was updated',
                            type: 'success'
                        });
                    })
                    .catch(error => {
                        this.passError(error)
                    });
            },

            createCatalog() {
                axios.post('/api/catalogs/', this.catalog)
                    .then(response => {
                        this.$notify({
                            title: 'Good!',
                            text: 'Catalog was created',
                            type: 'success'
                        });
                        console.log(response);
                        this.$router.push({
                            name: 'edit_catalog',
                            params: {
                                catalog_id: response.data.id
                            }
                        });
                        this.can_create = false;
                        this.prepareComponent();
                    })
                    .catch(error => {
                        this.passError(error)
                    });
            },

            deleteCatalog() {
                axios.delete('/api/catalogs/' + this.catalog.id)
                    .then(response => {
                        this.$notify({
                            title: 'Good!',
                            text: 'Catalog was deleted',
                            type: 'success'
                        });
                        this.$router.push({
                            name: 'catalogs'
                        })
                    })
                    .catch(error => {
                        this.passError(error)
                    });
            },

            passError(error) {
                console.log(error);
                if (typeof error.response.data === 'object') {
                    if (error.response.status === 403) {
                        this.$notify({
                            title: 'Error!',
                            text: error.response.data.message,
                            type: 'error'
                        });
                    } else if (error.response.status === 422) {
                        for (let field in error.response.data.errors) {
                            this.$notify({
                                title: error.response.data.message,
                                text: error.response.data.errors[field][0],
                                type: 'error'
                            });
                        }
                    }

                } else {
                    this.$notify({
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        type: 'error'
                    });
                }
            },

            limitText() {
                return `and ${count} more`
            },

            clearAll() {
                this.catalog.books = []
            },

            findBooks(query) {
                if (typeof query !== 'undefined') {
                    if (query.length > 3) {
                        this.isLoading = true;
                        axios.get('/api/books?', {
                            params: {
                                'search': query
                            }
                        }).then(response => {
                            this.books = response.data.data;
                            this.isLoading = false
                        }).catch(error => {
                            this.passError(error)
                        });
                    }
                }
            },

            selectBook(book) {
                axios.post('/api/catalogs/' + this.catalog.id + '/attach_book/' + book.id)
                    .then(response => {
                        this.$notify({
                            title: 'Good!',
                            text: 'Book was added to catalog',
                            type: 'success'
                        });
                    })
                    .catch(error => {
                        this.passError(error)
                    });
            },

            removeBook(book) {
                axios.post('/api/catalogs/' + this.catalog.id + '/detach_book/' + book.id)
                    .then(response => {
                        this.$notify({
                            title: 'Good!',
                            text: 'Book was deleted from catalog',
                            type: 'success'
                        });
                    })
                    .catch(error => {
                        this.passError(error)
                    });
            },

            showBook(id) {
                this.$router.push({
                    name: 'edit_book',
                    params: {
                        book_id: id
                    }
                })
            },
        }
    }
</script>
