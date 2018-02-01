<template>
    <div>
        <article class="uk-article ">
            <div class="uk-margin uk-container uk-container-small uk-text-center">
                <h2 class="uk-article-title">
                    {{ book.name }}
                </h2>
                <div class="uk-margin" v-if="(can_create === true) || (can_update === true)">
                    <input v-model="book.name" class="uk-input" type="text" placeholder="Name">
                </div>
                <p class="uk-article-meta" v-if="book.id > 0">
                    Written by <b>{{ book.author.name }}</b> on {{ book.created }}</p>

            </div>
            <div class="uk-container uk-container-small">
                <div property="text">
                    <p>
                        {{ book.text }}
                    </p>
                </div>
                <div class="uk-margin" v-if="(can_create === true) || (can_update === true)">
                    <textarea v-model="book.text" class="uk-input" type="text" style="min-height: 20vh" placeholder="Text"/>
                </div>
            </div>
            <div class="uk-margin uk-container uk-container-small">
                <button v-if="can_create === true" @click="createBook()" class="uk-button uk-button-default">
                    Create
                </button>
                <button v-if="can_update === true" @click="updateBook()" class="uk-button uk-button-default">
                    Update
                </button>
                <button v-if="can_delete === true" @click="deleteBook()" class="uk-button uk-button-default">
                    Delete
                </button>
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
                },
                can_create: false,
                can_update: false,
                can_delete: false
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
                if (this.$route.params.book_id) {
                    this.getBook();
                } else {
                    this.getAccessToCreate();
                }
            },

            /**
             * Get all of the OAuth applications for the user.
             */
            getBook() {
                axios.get('/api/books/'  + this.$route.params.book_id)
                    .then(response => {
                        this.book = response.data;
                        this.getAccessToUpdate();
                        this.getAccessToDelete();
                    });
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

            getAccessToUpdate() {
                axios.get('/api/books/' + this.book.id + '/can', {
                    params: {
                        action: 'update'
                    }
                }).then(response => {
                    this.can_update = response.data.data;
                }).catch(error => {
                    this.passError(error)
                });
            },

            getAccessToDelete() {
                axios.get('/api/books/' + this.book.id + '/can', {
                    params: {
                        action: 'delete'
                    }
                }).then(response => {
                    this.can_delete = response.data.data;
                }).catch(error => {
                    this.passError(error)
                });
            },

            updateBook() {
                axios.put('/api/books/' + this.book.id, this.book)
                    .then(response => {
                        this.$notify({
                            title: 'Good!',
                            text: 'Book was updated',
                            type: 'success'
                        });
                    })
                    .catch(error => {
                        this.passError(error)
                    });
            },

            createBook() {
                axios.post('/api/books/', this.book)
                    .then(response => {
                        this.$notify({
                            title: 'Good!',
                            text: 'Book was created',
                            type: 'success'
                        });
                        this.book = response.data;
                        this.getAccessToUpdate();
                        this.getAccessToDelete();
                        this.can_create = false;
                        this.$router.push({
                            name: 'edit_book',
                            params: {
                                book_id: response.data.id
                            }
                        })
                    })
                    .catch(error => {
                        this.passError(error)
                    });
            },

            deleteBook() {
                axios.delete('/api/books/' + this.book.id)
                    .then(response => {
                        this.$notify({
                            title: 'Good!',
                            text: 'Book was deleted',
                            type: 'success'
                        });
                        this.$router.push({
                            name: 'books'
                        })
                    })
                    .catch(error => {
                        this.passError(error)
                    });
            },
        }
    }
</script>
