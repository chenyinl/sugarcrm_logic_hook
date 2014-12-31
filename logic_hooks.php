<?php
// custom/modules/Leads/logic_hooks.php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(
	1, 
	'Leads push feed', 
	'modules/Leads/SugarFeeds/LeadFeed.php',
	'LeadFeed', 
	'pushFeed'
);
/**
 *  add the following to add a short description
 */
$hook_array['before_save'][] = Array(
	1, 
	'add_to_description', 
	'custom/modules/Leads/add_to_description.php', 
	'add_to_description', 
	'add_timestamp'
);
$hook_array['after_ui_frame'] = Array(); 
$hook_array['after_ui_frame'][] = Array(1, 'Leads InsideView frame', 'modules/Connectors/connectors/sources/ext/rest/insideview/InsideViewLogicHook.php','InsideViewLogicHook', 'showFrame'); 



?>
