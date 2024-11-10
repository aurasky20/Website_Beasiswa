<?php
    function generatePendaftaran($length = 10) {
        $upperCase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $digits = '0123456789';
        $main = 'PSG';

        $password = '';
        $password .= $upperCase[random_int(0, strlen($upperCase) - 1)];
        $password .= $digits[random_int(0, strlen($digits) - 1)];

        $allChars =  $upperCase . $digits;
        for ($i = 3; $i < $length; $i++) {
            $password .= $allChars[random_int(0, strlen($allChars) - 1)];
        }

        $password = $main . str_shuffle($password);
        return $password;
    }
?>