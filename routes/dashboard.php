<?php

$this->group(['prefix' => '/dashboard'], function () {
    $this->get('/index', [
        'uses' => 'Admin\DashboardController@index',
        'as' => 'dashboard.index',
        'shield' => 'dashboard.index'
    ]);
});