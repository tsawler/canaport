<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Default Queue Driver
    |--------------------------------------------------------------------------
    |
    | The Laravel queue API supports a variety of back-ends via an unified
    | API, giving you convenient access to each back-end using the same
    | syntax for each one. Here you may set the default queue driver.
    |
    | Supported: "sync", "beanstalkd", "sqs", "iron"
    |
    */

    'default' => 'sync',

    'connections' => array(

        'sync'       => array(
            'driver' => 'sync',
        ),

        'beanstalkd' => array(
            'driver' => 'beanstalkd',
            'host'   => 'localhost',
            'queue'  => 'nbtap',
            'ttr'    => 60,
        ),

        'sqs'        => array(
            'driver' => 'sqs',
            'key'    => 'your-public-key',
            'secret' => 'your-secret-key',
            'queue'  => 'your-queue-url',
            'region' => 'us-east-1',
        ),

        'iron'       => array(
            'driver'  => 'iron',
            'host'    => 'mq-aws-us-east-1.iron.io',
            'token'   => 'FOS-izgDvYPvFxE_1O6xx9EgTCs',
            'project' => '55159f16cc90770006000056',
            'queue'   => 'app',
            'encrypt' => true,
        ),

        'redis'      => array(
            'driver' => 'redis',
            'queue'  => 'default',
        ),

    ),
);
