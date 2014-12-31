<?php
// custom/modules/Leads/add_to_description.php
//prevents directly accessing this file from a web browser
    if(!defined('sugarEntry') ||!sugarEntry)
 die('Not A Valid Entry Point');

/**
 * A class to be called to execute php code
 */
class add_to_description{
        
    function add_timestamp(& $focus, $event, $arguments){
                
        global
        $current_user;
        $focus->description .=
        " Saved on".date('Y-m-d g:i a')." by ".$current_user->user_name.
        "via logic hooks.";
    }
}
?>
