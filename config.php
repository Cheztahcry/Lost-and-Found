<?php return [
    'host' => 'localhost',
    'db'   => 'dblostandfound',
    'user' => 'root',
    'password' => '',
    'dbname' => 'dblostandfound',
    'jwt_secret' => 'your_secret_key_here'
];
define('JWT_SECRET_KEY', 'your_secret_key_here');
define('JWT_TTL', '3600');
define('JWT_ISS', 'my-php-api');
define('JWT_AUD', 'my-php-api-users');

?>