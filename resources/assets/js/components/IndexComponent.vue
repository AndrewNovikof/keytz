<template>
    <div class="uk-section-secondary uk-section">
        <div class="uk-container uk-container-small">
            <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
                <div class="uk-width-1-1@m uk-first-column">
                    <div class="uk-margin uk-text-center">
                        <img src="/images/defaul-avatar.jpg" sizes="(min-width: 100px) 100px, 100vw" width="100" class="el-image uk-border-circle" alt="">
                    </div>
                </div>
            </div>
            <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid="">
                <div class="uk-width-1-1@m uk-first-column">
                    <h2 class="uk-text-center uk-h5">
                        {{ user.name }}
                    </h2>

                    <div class="uk-margin-medium uk-text-center uk-text-meta">
                        {{ user.email }}
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
                user: {
                    name: '',
                    roles: {

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
                this.getUserInfo();
            },

            /**
             * Get all of the OAuth applications for the user.
             */
            getUserInfo() {
                axios.get('/api/users/me?includes=roles')
                    .then(response => {
                        this.user = response.data;
                    });
            }
        }
    }
</script>
