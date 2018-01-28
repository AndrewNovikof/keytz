<?php
declare(strict_types=1);

use App\Models\User;
use SleepingOwl\Admin\Model\ModelConfiguration;
use Spatie\Permission\Models\Role;

AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->enableAccessCheck();

    $model->setTitle('Пользователи');

    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()
            ->setOrder([[1, 'desc']])
            ->with( ['roles'])
            ->setColumns([
                AdminColumn::text('id')->setLabel('ID'),
                AdminColumn::text('name')->setLabel('Имя'),
                AdminColumn::email('email')->setLabel('E-mail'),
                AdminColumn::lists('roles.name')->setLabel('Роли')
            ]);
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function () {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Имя')
                ->required('Поле "Имя" обязетельно для заполнения'),
            AdminFormElement::text('email', 'Почта')
                ->required('Поле "Почта" обязательно для заполнения')
                ->unique('Поле "Почта" должно быть уникальным')
                ->addValidationRule('email', 'Поле "Почта" должно быть корректным электронным адресом'),
            AdminFormElement::text('password', 'Пароль')
                ->required('Поле "Пароль" обязетельно для заполнения'),
            AdminFormElement::multiselect('roles', 'Роли')
                ->setModelForOptions(new Role())->setDisplay('name')
        );
        return $form;
    });
})->addMenuPage(User::class, 1)->setIcon('fa fa-user');
