<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'enabled' => env('SOCIAL_GRACES_ENABLED', true),

	'save_path' => storage_path('app/public/'),

	'public_path' => 'storage/',
];
