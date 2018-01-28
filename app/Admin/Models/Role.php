<?php
declare(strict_types=1);

use Spatie\Permission\Models\Role;
use SleepingOwl\Admin\Model\ModelConfiguration;
use Spatie\Permission\Models\Permission;

AdminSection::registerModel(Role::class, function (ModelConfiguration $model) {
    $model->enableAccessCheck();

    $model->setTitle('Роли');

    $model->onDisplay(function () {
        $display = AdminDisplay::table()
            ->with('permissions')
            ->setColumns([
                AdminColumn::text('id')->setLabel('ID'),
                AdminColumn::text('name')->setLabel('Роль'),
                AdminColumn::lists('permissions.name')->setLabel('Права'),
            ]);
        $display->setApply(function ($query) {
            $query->orderBy('id', 'desc');
        });
        $display->paginate(15);
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function ($id = null) {
        $form = AdminForm::panel()->addBody(
            AdminFormElement::text('name', 'Роль')
                ->required('Поле "Значение" обязетельно для заполнения')
                ->addValidationRule($id ? "unique:roles,name,$id" : 'unique:roles', 'Поле должно быть уникальным'),
            AdminFormElement::multiselect('permissions', 'Права')
                ->setModelForOptions(new Permission())->setDisplay('name')
        );
        return $form;
    });
})->addMenuPage(Role::class, 2)->setIcon('fa fa-user-secret');
