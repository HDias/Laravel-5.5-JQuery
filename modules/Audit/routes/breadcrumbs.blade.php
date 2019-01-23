<?php

Breadcrumbs::register('audit.log.index', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Lista de Log', route('audit.log.index'));
});