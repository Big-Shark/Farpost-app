<?php

    return [
        'user/registration' => [\App\Controller\UserController::class, 'actionRegistration'],
        'user/login' => [\App\Controller\UserController::class, 'actionLogin'],
        'user/confirm' => [\App\Controller\UserController::class, 'actionConfirm'],
        'user/logout' => [\App\Controller\UserController::class, 'actionLogout'],
        'user/image' => [\App\Controller\UserController::class, 'actionIndex'],
        'user/addAjaxImage' => [\App\Controller\ImageController::class, 'actionAddAjaxImage'],
        'user/show/([0-9]+)' => [\App\Controller\ImageController::class, 'actionShow'],
        '' => [\App\Controller\ImageController::class, 'actionIndex'],
    ];