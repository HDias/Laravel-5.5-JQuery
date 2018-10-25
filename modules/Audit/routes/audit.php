<?php
Route::group(['prefix' => 'audit', 'middleware' => ['auth:web', 'needsPermission']], function () {
    $this->group(['prefix' => '/log'], function () {
        $this->get('/index', [
            'uses' => 'LogController@index',
            'as' => 'audit.log.index',
            'shield' => 'log.index'
        ]);
    });
});
