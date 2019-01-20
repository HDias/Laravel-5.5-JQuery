<?php

// Permissions
Breadcrumbs::register('acl.permission.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Lista de Permissões', route('acl.permission.index'));
});
Breadcrumbs::register('acl.permission.create', function ($breadcrumbs) {
    $breadcrumbs->parent('acl.permission.index');
    $breadcrumbs->push('Nova Permissão', route('acl.permission.create'));
});
Breadcrumbs::register('acl.permission.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('acl.permission.index');
    $breadcrumbs->push('Editar Permissão', route('acl.permission.edit', $id));
});

// Roles
Breadcrumbs::register('acl.role.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Lista de Perfis', route('acl.role.index'));
});
Breadcrumbs::register('acl.role.create', function ($breadcrumbs) {
    $breadcrumbs->parent('acl.role.index');
    $breadcrumbs->push('Novo Perfil', route('acl.role.create'));
});
Breadcrumbs::register('acl.role.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('acl.role.index');
    $breadcrumbs->push('Editar Perfil', route('acl.role.edit', $id));
});

// User
Breadcrumbs::register('user.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push('Lista de Usuários', route('user.index'));
});
Breadcrumbs::register('user.create', function ($breadcrumbs) {
    $breadcrumbs->parent('user.index');
    $breadcrumbs->push('Novo Usuário', route('user.create'));
});
Breadcrumbs::register('user.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('user.index');
    $breadcrumbs->push('Editar Usuário', route('user.edit', $id));
});