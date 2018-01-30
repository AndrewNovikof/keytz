<template>
    <div>
        <p v-if="books.length === 0">
            Вы еще не создали ни одного приложения.
        </p>
        <div class="uk-container" v-if="books.length > 0">
            <div class="el-item uk-panel uk-margin-large" v-for="book in books">
                <h3 class="el-title uk-margin uk-margin-remove-adjacent uk-margin-remove-bottom">
                    {{ book.name}}
                </h3>

                <div class="el-meta uk-margin uk-text-muted">
                    {{ book.author.name }}
                </div>
                <div class="el-content uk-margin">
                    {{ book.text }}
                </div>
                <p class="uk-text-center uk-margin-medium" @click="edit(book)">
                    <a class="uk-button uk-button-text">Continue reading</a>
                </p>
            </div>
        </div>
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
                this.getBooks();
            },

            /**
             * Get all of the OAuth applications for the user.
             */
            getBooks() {
                axios.get('/api/books')
                    .then(response => {
                        this.books = response.data.data;
                    });
            },

            edit(book) {
                this.$router.push({
                    name: 'edit_book',
                    params: {
                        book_id: book.id
                    }
                })
            },
        }
    }
</script>
