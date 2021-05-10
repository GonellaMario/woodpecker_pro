<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Servizi
    Route::apiResource('servizis', 'ServiziApiController');

    // Daily Activities
    Route::apiResource('daily-activities', 'DailyActivitiesApiController');

    // Team
    Route::apiResource('teams', 'TeamApiController');

    // Event
    Route::apiResource('events', 'EventApiController');
});
