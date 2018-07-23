<?php

use Keygen\Keygen;
use Illuminate\Support\Facades\Hash;

    if(!function_exists('makeHash')) {
        function makeHash($password) {
            return Hash::make($password);
        }
    }

    if(!function_exists('generateCode')) {
        
        function generateCode($len)
        {
            $GLOBALS['num'] = $len;
            return Keygen::bytes()->generate(
                function($key) {
                    // Generate a random numeric key
                    $random = Keygen::numeric()->generate();
        
                    // Manipulate the random bytes with the numeric key
                    return substr(md5($key . $random . strrev($key)), mt_rand(0,8),$GLOBALS['num']);
                },
                function($key) {
                    // Add a (-) after every fourth character in the key
                    return join('-', str_split($key, 4));
                },
                'strtoupper'
            );
        }

    }

    if(!function_exists('generateID')) {
        function generateID($len) {
            // prefixes the key with a random integer between 1 - 9 (inclusive)
            return Keygen::numeric($len-1)->prefix(mt_rand(1, 9))->generate(true);
        }
    }