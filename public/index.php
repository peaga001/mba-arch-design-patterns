<?php

$request = $_SERVER['REQUEST_URI'];

$message = match ($request) {
    '/' => 'Application is running',
    '/ping' => 'Pong!',
    default => 'Page not found!'
};


echo $message;