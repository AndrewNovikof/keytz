<template>
    <div>
        <div class="uk-container" v-if="books.length > 0">
            <div class="uk-card uk-card-default  uk-card-body uk-card-small"
                 uk-sticky="offset: 0" v-if="pagination.total_pages > 1">
                <vk-pagination class="uk-margin uk-flex-center"
                               :total="pagination.total"
                               :limit="pagination.per_page"
                               :page="pagination.current_page"
                               :pagerange="pagination.limit"
                               @change="setPage(arguments[0].page)">
                </vk-pagination>
            </div>


            <div class="el-item uk-panel uk-margin-large" v-for="book in books">
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
        <div class="uk-position-large uk-position-bottom-right uk-position-absolute uk-position-fixed" v-if="this.can_create === true"><a @click="showBook()" uk-marker></a></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                books: {
                    id: '',
                    name: '',
                    text: '',
                    author: ''
                },
                pagination: {
                    count: '',
                    current_page: '',
                    per_page: '',
                    total: '',
                    total_pages: ''
                },
                can_create: false
            };
        },

        props: {
            catalog_id: null
        },

        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                if (this.catalog_id > 0) {
                    this.getCatalogBooks(this.catalog_id)
                } else {
                    this.getBooks(null);
                    this.getAccessToCreate();
                }
            },

            getBooks(params) {
                axios.get('/api/books?' + params)
                    .then(response => {
                        this.books = response.data.data;
                        this.pagination = response.data.meta.pagination;
                    });
            },

            getCatalogBooks(catalog_id) {
                axios.get('/api/catalogs/' + catalog_id + '?includes=books')
                    .then(response => {
                        this.books = response.data.books.data;
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

            createBook(){
                this.$router.push({
                    name: 'create_book'
                })
            },

            setPage(page_id) {
                this.getBooks('page=' + page_id)
            },

            getAccessToCreate() {
                axios.get('/api/users/can', {
                    params: {
                        action: 'create books'
                    }
                }).then(response => {
                    this.can_create = response.data.data;
                }).catch(error => {
                    this.passError(error)
                });
            },
        }
    }
</script>
