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
    return 1.2;
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
 * encrypt pass , Pass Sha1
 */

function hsc_encrypt($password_sha1_string){
    $password = sha1($password_sha1_string);
    //Since we want the object $this-> we need to get the instance (like NEW)
    $pass = get_instance();
    $token1 = sha1('#$%()&&`2014*');
    $token2 = sha1(md5('hsc')*2)/5;
    return $password = $token1.$password.$pass->encrypt->encode($password).$token2;
}

/*
 * Not used yet
 */
function hsc_decode($password_sha1_string){
    $password = sha1($password_sha1_string);
    //Since we want the object $this-> we need to get the instance (like NEW)
    $pass = get_instance();
    $token1 = sha1('#$%()&&`2014*');
    $token2 = sha1(md5('hsc')*2)/5;
    return $password = $token1.$password.$pass->encrypt->decode($password).$token2;
}