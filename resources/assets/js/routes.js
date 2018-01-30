import {
    IndexComponent,
    BooksComponent,
    BookComponent,
    CatalogsComponent
} from './components'

export default [
    {
        path: '/',
        component: IndexComponent,
        meta: {
            title: 'Dashboard'
        }
    },
    {
        path: '/books',
        component: BooksComponent,
        name: 'books',
        meta: {
            title: 'Books'
        }
    },
    {
        path: '/books/create', component: BookComponent,
        name: 'create_book',
        meta: {
            title: 'Create Book'
        }
    },
    {
        path: '/books/:book_id/edit',
        component: BookComponent,
        name: 'edit_book',
        meta: {
            title: 'Edit Book'
        }
    },
    {
        path: '/catalogs',
        component: CatalogsComponent,
        name: 'catalogs',
        meta: {
            title: 'Catalogs'
        }
    },
];