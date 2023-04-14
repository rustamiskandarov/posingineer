<?php

namespace App;

class Helper
{
        static function redirect(string $to, $code = 200){
            header('Location: /'.$to, $code);
            exit();
        }
        static function dd($data){
            var_dump($data);
            die();
        }
}