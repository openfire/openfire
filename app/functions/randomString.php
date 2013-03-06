<? function randomString($length = 10) {
    $chars = "0123456789abcdefghijklmnopqrstuvwxyz";
    $string = "";
    for ($p = 0; $p < $length; $p++) {
        $string .= $chars[mt_rand(0, strlen($chars))];
    }
 
    return $string;
}