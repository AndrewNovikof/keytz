import {
    IndexComponent,
    BooksComponent,
    BookComponent,
    CatalogsComponent,
    CatalogComponent
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
        path: '/books/create',
        component: BookComponent,
        name: 'create_book',
        meta: {
            title: 'Create Book'
        }
    },
    {
        path: '/books/:book_id',
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
    {
        path: '/catalogs/create',
        component: CatalogComponent,
        name: 'create_catalog',
        meta: {
            title: 'Create Catalog'
        }
    },
    {
        path: '/catalogs/:catalog_id',
        component: CatalogComponent,
        name: 'edit_catalog',
        meta: {
            title: 'Edit Catalog'
        }
    }
];