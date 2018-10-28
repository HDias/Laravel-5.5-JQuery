<?php

// ACL.
$this->group(['prefix' => 'acl', 'middleware' => ['auth:web', 'needsPermission', 'needsRole']], function () {

    // user
    $this->group(['prefix' => '/user'], function () {
        $this->get('/index', [
            'uses' => 'UserController@index',
            'as' => 'user.index',
            'shield' => 'user.index'
        ]);
        $this->get('/create', [
            'uses' => 'UserController@create',
            'as' => 'user.create',
            'shield' => 'user.create'
        ]);
        $this->post('/store', [
            'uses' => 'UserController@store',
            'as' => 'user.store',
            'shield' => 'user.create'
        ]);
        $this->get('/edit/{id}', [
            'uses' => 'UserController@edit',
            'as' => 'user.edit',
            'shield' => 'user.edit'
        ])->where(['id' => '\d+']);

        $this->put('/update/{id}', [
            'uses' => 'UserController@update',
            'as' => 'user.update',
            'shield' => 'user.edit'
        ])->where(['id' => '\d+']);

        $this->delete('/destroy/{id}', [
            'uses' => 'UserController@destroy',
            'as' => 'user.destroy',
            'shield' => 'user.destroy'
        ])->where(['id' => '\d+']);

        $this->get('/edit-logged', [
            'uses' => 'UserController@editLogged',
            'as' => 'user.edit_logged',
        ]);
        $this->put('update-password', [
            'uses' => 'UserController@updatePassword',
            'as' => 'user.update_password',
        ]);

        $this->post('/restore/{id}', [
            'uses' => 'UserController@restore',
            'as' => 'user.restore',
            'is' => config('defender.restore_role'),
        ])->where(['id' => '\d+']);
    });

    // Permissão.
    $this->group(['prefix' => 'permission'], function () {
//        $this->get('index/{idRole?}/{idUser?}', [
        $this->get('/', [
            'uses' => 'PermissionController@index',
            'as' => 'acl.permission.index',
            'is' => config('defender.superuser_role')
        ])->where(['idRole' => '\d+', 'idUser' => '\d+']);

        $this->get('edit/{id}', [
            'uses' => 'PermissionController@edit',
            'as' => 'acl.permission.edit',
            'is' => config('defender.superuser_role')
        ]);

        $this->put('update/{id}', [
            'uses' => 'PermissionController@update',
            'as' => 'acl.permission.update',
            'is' => config('defender.superuser_role')
        ]);
        $this->get('label-autocomplete', [
            'uses' => 'PermissionController@labelAutocomplete',
            'as' => 'acl.permission.label_autocomplete'
        ]);

        $this->get('name-autocomplete', [
            'uses' => 'PermissionController@nameAutocomplete',
            'as' => 'acl.permission.name_autocomplete'
        ]);
    });

    // Função.
    $this->group(['prefix' => 'role'], function () {
//        $this->get('index/{idPermission}/{idUser}', [
        $this->get('/', [
            'uses' => 'RoleController@index',
            'as' => 'acl.role.index',
            'shield' => 'role.index'
        ]);
        $this->get('create', [
            'uses' => 'RoleController@create',
            'as' => 'acl.role.create',
            'shield' => 'role.create'
        ]);
        $this->post('store', [
            'uses' => 'RoleController@store',
            'as' => 'acl.role.store',
            'shield' => 'role.create'
        ]);
        $this->get('edit/{id}', [
            'uses' => 'RoleController@edit',
            'as' => 'acl.role.edit',
            'shield' => 'role.edit'
        ]);
        $this->put('update/{id}', [
            'uses' => 'RoleController@update',
            'as' => 'acl.role.update',
            'shield' => 'role.edit'
        ]);
        $this->delete('destroy/{id}', [
            'uses' => 'RoleController@destroy',
            'as' => 'acl.role.destroy',
            'shield' => 'role.destroy'
        ]);
        $this->get('autocomplete', [
            'uses' => 'RoleController@autocomplete',
            'as' => 'acl.role.autocomplete',
            'shield' => 'role.create'
        ]);
    });

    // Permissão em Usuário.
    $this->get('permission-user/link/{id}', [
        'uses' => 'PermissionUserController@link',
        'as' => 'acl.permission_user.link',
        'shield' => 'permission_user.link'
    ]);
    $this->post('permission-user/store/{id}', [
        'uses' => 'PermissionUserController@store',
        'as' => 'acl.permission_user.store',
        'shield' => 'permission_user.link'
    ]);
});