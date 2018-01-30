<template>
    <div>
        <article class="uk-article ">
            <div class="uk-margin uk-container uk-container-small uk-text-center">
                <h2 class="uk-article-title">
                    {{ book.name }}
                </h2>
                <p class="uk-article-meta">
                    Written by <b>{{ book.author.name }}</b> on {{ book.created }}</p>

            </div>
            <div class="uk-container uk-container-small">
                <div property="text">
                    <p>
                        {{ book.text }}
                    </p>
                </div>
            </div>
        </article>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                book: {
                    id: '',
                    name: '',
                    text: '',
                    author: '',
                    created: ''
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
                console.log(this.$route);
                if (this.$route.params.book_id) {
                    this.getBook();
                }
            },

            /**
             * Get all of the OAuth applications for the user.
             */
            getBook() {
                axios.get('/api/books/'  + this.$route.params.book_id)
                    .then(response => {
                        this.book = response.data;
                    });
            }
        }
    }
</script>
