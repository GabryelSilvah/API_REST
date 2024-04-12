<?php

spl_autoload_register(function ($classe) {

    $diretorio = ["controller", "model"];
    foreach ($diretorio as $valor) {

        $caminho = "." . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . $valor . DIRECTORY_SEPARATOR . $classe . ".php";
        if (is_file($caminho)) {
            require_once($caminho);
        }
    }
});
