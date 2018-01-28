<?php
declare(strict_types=1);

use App\Models\Catalog;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Catalog::class, function (ModelConfiguration $model) {
    $model->enableAccessCheck();

    $model->setTitle('Каталоги');

    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()
            ->setOrder([[1, 'desc']])
            ->with( ['books', 'user'])
            ->setColumns([
                AdminColumn::text('id')->setLabel('ID'),
                AdminColumn::text('name')->setLabel('Название'),
                AdminColumn::checkbox('is_public')->setLabel('Публичный'),
                AdminColumn::text('user.email')->setLabel('Владелец'),
                AdminColumn::lists('books.name')->setLabel('Книги')
            ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function () {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Имя')
                ->required('Поле "Название" обязетельно для заполнения'),
            AdminFormElement::checkbox('is_public', 'Публичный'),
            AdminFormElement::multiselect('books', 'Книги')
                ->setModelForOptions(new Book())->setDisplay('name')
        );
        return $form;
    });
})->addMenuPage(Catalog::class, 5)->setIcon('fa fa-list');
