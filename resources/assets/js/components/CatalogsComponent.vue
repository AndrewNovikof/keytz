<template>
    <div>
        <ul uk-accordion="multiple: true" class="uk-accordion" v-if="catalogs.length > 0">
            <li class="el-item" v-for="catalog in catalogs">
                <h3 class="el-title uk-accordion-title">
                    {{ catalog.name }}
                </h3>

                <div class="uk-accordion-content" aria-hidden="true" hidden="" >
                    <div v-if="catalog.books.data.length > 0">
                        <div class="uk-margin el-content" v-for="book in catalog.books.data">
                            <ul class="uk-list">
                                <li class="el-item">
                                    {{ book.name }}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button class="uk-button" @click="showCatalog(catalog)"> Open catalog</button>
                </div>
            </li>

            <div class="uk-card uk-card-default  uk-card-body uk-card-small" style="z-index: 980;"
                 uk-sticky="offset: 0; bottom: #top" v-if="pagination.total_pages > 1">
                <vk-pagination class="uk-margin uk-flex-center"
                               :total="pagination.total"
                               :limit="pagination.per_page"
                               :page="pagination.current_page"
                               :pagerange="pagination.limit"
                               @change="setPage(arguments[0].page)">
                </vk-pagination>
            </div>
        </ul>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                catalogs: {
                    id: '',
                    name: '',
                    owner: '',
                    books: {
                        id: '',
                        name: '',
                        author: ''
                    }
                },
                pagination: {
                    count: '',
                    current_page: '',
                    per_page: '',
                    total: '',
                    total_pages: ''
                }
            };
        },
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getCatalogs('includes=books');
            },

            /**
             * Get all of the OAuth applications for the user.
             */
            getCatalogs(params) {
                axios.get('/api/catalogs?' + params)
                    .then(response => {
                        this.catalogs = response.data.data;
                        this.pagination = response.data.meta.pagination;
                    });
            },

            showCatalog(catalog) {
                this.$router.push({
                    name: 'edit_catalog',
                    params: {
                        catalog_id: catalog.id
                    }
                })
            },

            setPage(page_id) {
                this.getCatalogs('includes=books&page=' + page_id)
            }
        }
    }
</script>
