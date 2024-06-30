<?php

class credentials{
    public static function GetCredentials($filename){
        $path = $_SERVER['DOCUMENT_ROOT']."/../../mdp/";
        return json_decode(file_get_contents($path.$filename));
    }
}