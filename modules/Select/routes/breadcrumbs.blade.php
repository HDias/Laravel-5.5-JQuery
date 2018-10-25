<?php

Breadcrumbs::register('select.option.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Lista de Opções', route('select.option.index'));
});
Breadcrumbs::register('select.option.create', function ($breadcrumbs) {
    $breadcrumbs->parent('select.option.index');
    $breadcrumbs->push('Nova Opção', route('select.option.create'));
});
Breadcrumbs::register('select.option.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('select.option.index');
    $breadcrumbs->push('Editar Opção', route('select.option.edit', $id));
});