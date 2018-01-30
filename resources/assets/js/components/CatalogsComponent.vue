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
                this.getCatalogs();
            },

            /**
             * Get all of the OAuth applications for the user.
             */
            getCatalogs() {
                axios.get('/api/catalogs?includes=books')
                    .then(response => {
                        this.catalogs = response.data.data;
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
        }
    }
</script>
