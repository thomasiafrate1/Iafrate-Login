<?php

namespace credential;

class mdp
{
    public static function GetCredentials($fileName){

        $path = $_SERVER['DOCUMENT_ROOT'] . '/../mdp/' . $fileName;

        return json_decode(file_get_contents($path));

    }
}