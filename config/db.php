<?php

$db_host     = env('MYSQL_HOST', 'db');
$db_port     = env('MYSQL_PORT', '3306');
$db_name     = env('MYSQL_DATABASE', 'local');
$db_user     = env('MYSQL_USER', 'local');
$db_password = env('MYSQL_PASSWORD', 'local');
$db_charset  = env('MYSQL_DB_CHARSET', 'utf8');

return [
    'class'               => \yii\db\Connection::class,
    'dsn'                 => "mysql:host=$db_host;port=$db_port;dbname=$db_name",
    'username'            => $db_user,
    'password'            => $db_password,
    'charset'             => $db_charset,
    'enableSchemaCache'   => isProduction(),
    'schemaCacheDuration' => 3600,
    'schemaCache'         => 'cache',
];
