<?php

return array(

    'connections' => array(

        'sqlite' => array(
            'driver'   => 'sqlite',
            'database' => __DIR__ . '/../database/production.sqlite',
            'prefix'   => '',
        ),

        'mysql'  => array(
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'canaportdb',
            'username'  => 'homestead',
            'password'  => 'secret',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ),

        'pgsql'  => array(
            'driver'   => 'pgsql',
            'host'     => 'localhost',
            'database' => 'nbtap',
            'username' => 'homestead',
            'password' => 'secret',
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'nbt',
        ),

        'sqlsrv' => array(
            'driver'   => 'sqlsrv',
            'host'     => 'localhost',
            'database' => 'database',
            'username' => 'root',
            'password' => '',
            'prefix'   => '',
        ),

    ),

);
