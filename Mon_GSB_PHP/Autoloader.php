<?php
namespace App;

class Autoloader{
    static function register(){
         spl_autoload_register([
            __CLASS__,
            'autoload'
        ]);

    }
    static function autoload($class){
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);
        // echo $class;

        // je remplace les \ par des /
        $class = str_replace('\\', '/', $class);

        $fichier = __DIR__ . '/' . $class .'.php';
        //on vérifie si le fichier existe 
        if (file_exists($fichier)){
            require_once $fichier;
        }
         


    }
} 