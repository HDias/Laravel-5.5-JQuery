<?php
Route::group(['prefix' => 'select', 'middleware' => ['auth:web', 'needsRole']], function () {
    $this->group(['prefix' => '/option'], function () {
        $this->get('/index', [
            'uses' => 'OptionController@index',
            'as' => 'select.option.index',
            'is' => [config('defender.superuser_role')]
        ]);
        $this->get('/create', [
            'uses' => 'OptionController@create',
            'as' => 'select.option.create',
            'is' => [config('defender.superuser_role')]
        ]);
        $this->post('/store', [
            'uses' => 'OptionController@store',
            'as' => 'select.option.store',
            'is' => [config('defender.superuser_role')]
        ]);
        $this->get('/edit/{id}', [
            'uses' => 'OptionController@edit',
            'as' => 'select.option.edit',
            'is' => [config('defender.superuser_role')]
        ])->where(['id' => '\d+']);
        $this->put('/update/{id}', [
            'uses' => 'OptionController@update',
            'as' => 'select.option.update',
            'is' => [config('defender.superuser_role')]
        ])->where(['id' => '\d+']);
        $this->delete('/destroy/{id}', [
            'uses' => 'OptionController@destroy',
            'as' => 'select.option.destroy',
            'is' => [config('defender.superuser_role')]
        ])->where(['id' => '\d+']);

        //Autocomplete
        Route::get('label-autocomplete', [
            'uses' => 'OptionController@labelAutocomplete',
            'as' => 'select.option.label_autocomplete',
            'is' => [config('defender.superuser_role')]
        ]);
    });
});
