<?php
declare(strict_types=1);

use App\Models\Book;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Book::class, function (ModelConfiguration $model) {
    $model->enableAccessCheck();

    $model->setTitle('Книги');

    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()
            ->setOrder([[1, 'desc']])
            ->with( ['catalogs', 'user'])
            ->setColumns([
                AdminColumn::text('id')->setLabel('ID'),
                AdminColumn::text('name')->setLabel('Название'),
                AdminColumn::text('text')->setLabel('Текст'),
                AdminColumn::text('user.email')->setLabel('Автор'),
                AdminColumn::lists('catalogs.name')->setLabel('Каталоги')
            ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function () {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Имя')
                ->required('Поле "Название" обязетельно для заполнения'),
            AdminFormElement::text('text', 'Текст')
        );
        return $form;
    });
})->addMenuPage(Book::class, 4)->setIcon('fa fa-book');
