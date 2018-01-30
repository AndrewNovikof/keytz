<template>
    <div>
        <article v-if="book.name.length > 0"
                class="uk-article ">
            <div class="uk-margin uk-container uk-container-small uk-text-center">
                <h2 class="uk-article-title">
                    {{ book.name }}
                </h2>
                <p class="uk-article-meta">
                    Written by <a href="https://demo.yootheme.com/themes/wordpress/2016/fuse/?author=1">
                    {{ book.author.name }}</a> on {{ book.created.date }}</p>

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
                this.getBook();
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
