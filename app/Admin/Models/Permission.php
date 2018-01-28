<?php
declare(strict_types=1);

use SleepingOwl\Admin\Model\ModelConfiguration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

AdminSection::registerModel(Permission::class, function (ModelConfiguration $model) {
    $model->enableAccessCheck();

    $model->setTitle('Разрешения');

    $model->onDisplay(function () {
        $display = AdminDisplay::table()
            ->with('roles')
            ->setColumns([
                AdminColumn::text('id')->setLabel('ID'),
                AdminColumn::text('name')->setLabel('Разрешение'),
                AdminColumn::lists('roles.name')->setLabel('Роли'),
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
            AdminFormElement::text('name', 'Разрешение')
                ->required('Поле "Значение" обязетельно для заполнения')
                ->addValidationRule(
                    $id ? "unique:permissions,name,$id" : 'unique:roles',
                    'Поле должно быть уникальным'
                ),
            AdminFormElement::multiselect('roles', 'Права')
                ->setModelForOptions(new Role())->setDisplay('name')
        );
        return $form;
    });
})->addMenuPage(Permission::class, 3)->setIcon('fa fa-universal-access');
