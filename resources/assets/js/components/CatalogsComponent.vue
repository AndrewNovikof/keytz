<template>
    <div>
        <p v-if="catalogs.length === 0">
            Вы еще не создали ни одного приложения.
        </p>
        <div class="uk-section-default uk-section uk-section-large">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
                    <div class="uk-width-1-1@m uk-first-column">
                        <h1 class="uk-margin-remove-top uk-text-left uk-heading-primary">
                            Inspired, innovative. </h1>
                        <div class="uk-width-xxlarge uk-text-left uk-text-lead">
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt
                            ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                            dolores et ea rebum
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                catalogs: {
                    id: '',
                    name: '',
                    owner: ''
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
                axios.get('/api/catalogs')
                    .then(response => {
                        this.catalogs = response.data;
                    });
            }
        }
    }
</script>
