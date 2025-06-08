<?php
spl_autoload_register(function ($namespace) {
    $baseDir = dirname(__DIR__); // volta para a raiz do projeto
    $arquivo = $baseDir . DIRECTORY_SEPARATOR . str_replace(
        ["App\\", "\\"],
        ["", DIRECTORY_SEPARATOR],
        $namespace
    ) . ".php";
    if (file_exists($arquivo)) {
        require_once $arquivo;
    }
});