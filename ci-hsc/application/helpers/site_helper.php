<?php
//check km it exists before kufanya mambo
if(!function_exists('weka_minus'))
{
    function weka_minus($value)
    {
        return ucwords(strtolower(str_replace(' ','_',$value)));
    }
}

function app_title(){
    return "HSC Management Software";
}

function app_version(){
    return "1.2.1";
}

function custom_date_format($date){

    $format_date = strtotime( $date );
    $date = date( 'D - jS M o', $format_date );

    return $date;
}


/*
 * Makes text bold, usefull
 */
function make_me_bold($value){
    return "<b>".$value."</b>";
}


/*
 * Makes Caps in every word
 */
function make_caps($value){
    return ucwords(strtolower($value));
}

/*
 * IMPLEMENT LATER
 * encrypt pass , Pass Sha1
 */

function hsc_encrypt($password_sha1_string){
    $password = sha1($password_sha1_string);
    //Since we want the object $this-> we need to get the instance (like NEW)
    $pass = get_instance();
    $token1 = sha1('#$%()&&`2014*');
    $token2 = sha1(md5('hsc')*2)/5;
    return $password = $pass->encrypt->encode($token1.$password.$token2);
}

function hsc_decode($password_sha1_string){
    $password = $password_sha1_string;
    //Since we want the object $this-> we need to get the instance (like NEW)
    $pass = get_instance();

    return $password = $pass->encrypt->decode($password);
}

function tokenize_sha1($password){
    $password = sha1($password);
    $token1 = sha1('#$%()&&`2014*');
    $token2 = sha1(md5('hsc')*2)/5;
    return $password = $token1.$password.$token2;
}

function return_false(){
    return false;
}

function check_if_online(){
    //For now checking if online always
    return return_false();

    $num = 10;
    $error = false;
    $port = 443; // or 80

    if (!$sock = @fsockopen('www.google.com', $port, $num, $error, 2))
        return false;
    else{
        fclose($sock);
        return true;
    }

}

function strip_number($num){
    return floatval(str_replace( ',', '',$num ));
}