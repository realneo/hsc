<?php
//check km it exists before kufanya mambo
if(!function_exists('weka_minus'))
{
    function weka_minus($value)
    {
        return ucwords(strtolower(str_replace(' ','_',$value)));
    }
}
