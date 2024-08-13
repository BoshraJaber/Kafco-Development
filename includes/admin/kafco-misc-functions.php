<?php

/**
 *  Function for display translated string
*/
function kafco_plugin_str_display($string){
    if ( function_exists( 'pll__' ) ) {
        return pll__($string);
    }
    return $string; 
}