<?php

session_start();

spl_autoload_register(function ($class) {
    $pastas = [
        ".." . DIRECTORY_SEPARATOR . "class",
        ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "usuario",
        ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "mensagem",
        ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "usuario",
        ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "class" . DIRECTORY_SEPARATOR . "mensagem",
    ];

    foreach ($pastas as $pasta) {
        $filename = str_replace("\\", "/", $pasta . DIRECTORY_SEPARATOR . $class . ".php");

        if (file_exists($filename)) {
            require_once $filename;
        }
    };
});
