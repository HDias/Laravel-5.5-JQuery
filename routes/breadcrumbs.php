<?php

// Home
Breadcrumbs::register('dashboard.index', function ($breadcrumbs) {
    $breadcrumbs->push('Painel', route('dashboard.index'));
});

// ACL
// require acl_path('routes/breadcrumbs.blade.php');

// require select_path('routes/breadcrumbs.blade.php');

// require audit_path('routes/breadcrumbs.blade.php');

// require certificate_path('routes/breadcrumbs.blade.php');

// User
// Breadcrumbs::register('user.index', function ($breadcrumbs) {
//     $breadcrumbs->parent('home');
//     $breadcrumbs->push('Lista de Usuários', route('user.index'));
// });
// Breadcrumbs::register('user.create', function ($breadcrumbs) {
//     $breadcrumbs->parent('user.index');
//     $breadcrumbs->push('Novo Usuário', route('user.create'));
// });
// Breadcrumbs::register('user.edit', function ($breadcrumbs, $id) {
//     $breadcrumbs->parent('user.index');
//     $breadcrumbs->push('Editar Usuário', route('user.edit', $id));
// });
// Breadcrumbs::register('user.edit_logged', function ($breadcrumbs) {
//     $breadcrumbs->parent('user.index');
//     $breadcrumbs->push('Editar Senha', route('user.edit_logged'));
// });