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
                    <button class="uk-button uk-button-default" @click="showCatalog(catalog.id)"> Open catalog</button>
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

        <div class="uk-position-large uk-position-bottom-right uk-position-absolute uk-position-fixed" v-if="this.can_create === true"><a @click="createCatalog()" uk-marker></a></div>
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
                },
                can_create: false
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
                this.getAccessToCreate()
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

            showCatalog(id) {
                this.$router.push({
                    name: 'edit_catalog',
                    params: {
                        catalog_id: id
                    }
                })
            },

            createCatalog(){
                this.$router.push({
                    name: 'create_catalog'
                })
            },

            setPage(page_id) {
                this.getCatalogs('includes=books&page=' + page_id)
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
        }
    }
</script>
