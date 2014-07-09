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

// Default Variables
$today_date = date("Y-m-d");
$branch_id = $_SESSION['branch_id'];


/*
 * Makes text bold, usefull
 */
function make_me_bold($value){
    return "<b>".$value."</b>";
}