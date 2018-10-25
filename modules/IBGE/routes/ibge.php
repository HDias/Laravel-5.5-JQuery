<?php

Route::group(['prefix' => 'ibge'], function () {
    $this->get('/cidades', [
        'uses' => 'IBGEController@city',
        'as' => 'ibge.city',
    ]);

    $this->get('/cidades/{code}', [
        'uses' => 'IBGEController@cityByCode',
        'as' => 'ibge.city',
    ])->where(['code' => '\d+']);
});
