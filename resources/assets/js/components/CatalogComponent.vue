<template>
    <div>
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
                    <div class="uk-width-1-1@m uk-first-column">
                        <h1 class="uk-margin-remove-top uk-text-left uk-heading-primary">
                            {{ catalog.name }}
                        </h1>
                        <p class="uk-article-meta">
                            Created by <b>{{ catalog.owner.name }}</b></p>
                    </div>
                </div>
                <div class="uk-grid-margin uk-margin-large" v-if="catalog.id > 0">
                    <books-component :catalog_id="catalog.id"></books-component>
                </div>
            </div>
    </div>
</template>

<script>
    import BooksComponent from './BooksComponent';
    export default {
        data() {
            return {
                catalog: {
                    id: '',
                    name: '',
                    owner: {
                        name: ''
                    }
                }
            };
        },
        mounted() {
            this.prepareComponent();
        },

        components: {
            BooksComponent
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                if (this.$route.params.catalog_id) {
                    this.getCatalog();
                }
            },

            /**
             * Get all of the OAuth applications for the user.
             */
            getCatalog() {
                axios.get('/api/catalogs/' + this.$route.params.catalog_id)
                    .then(response => {
                        this.catalog = response.data;
                    });
            }
        }
    }
</script>
