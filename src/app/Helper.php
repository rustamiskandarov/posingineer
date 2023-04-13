<?php

class Helper
{
        static function redirect(string $to, $code){
            header('Location: /'.$to, $code);
            exit();
        }
}