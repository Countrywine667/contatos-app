<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Src\Router\Router;
use Src\Controllers\ContactController;

$router = new Router();
$controller = new ContactController();

// rotas
$router->add("GET", "/", [$controller, "index"]);
$router->add("GET", "/create", [$controller, "create"]);
$router->add("POST", "/store", [$controller, "store"]);
$router->add("GET", "/edit/{id}", [$controller, "edit"]);
$router->add("POST", "/update/{id}", [$controller, "update"]);
$router->add("GET", "/delete/{id}", [$controller, "delete"]);
$router->add("GET", "/export", [$controller, "export"]);

file_put_contents(
    __DIR__ . "/debug.log",
    date('H:i:s') . " - " . $_SERVER['REQUEST_METHOD'] . " " . $_SERVER['REQUEST_URI'] . "\n",
    FILE_APPEND
);

$router->dispatch();
