<?php
declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Default Mailer
    |--------------------------------------------------------------------------
    |
    | This option controls the default mailer that is used to send all email
    | messages unless another mailer is explicitly specified when sending
    | the message. All additional mailers can be configured within the
    | "mailers" array. Examples of each type of mailer are provided.
    |
    */

    'rabbitmq_host' => env('RABBITMQ_HOST', 'localhost'),

    'rabbitmq_port' => env('RABBITMQ_PORT', 15672),

    'rabbitmq_user' => env('RABBITMQ_USER', 'admin'),

    'rabbitmq_password' => env('RABBITMQ_PASSWORD', 'admin'),

];
