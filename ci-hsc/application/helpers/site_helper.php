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
    return 1.1;
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