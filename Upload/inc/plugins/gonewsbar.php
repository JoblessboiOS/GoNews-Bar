<?php
if(!defined("IN_MYBB"))
{
    die("You Cannot Access This File Directly. Please Make Sure IN_MYBB Is Defined.");
} 
$plugins->add_hook('global_start', 'gonewsbar_global_start'); 
function gonewsbar_info()
{
return array(
        "name"  => "GoNews Bar",
        "description"=> "Create a short news bar that will be displayed at the top",
        "website"        => "http://serverslab.net.net/",
        "author"        => "JoblessboiOS",
        "authorsite"    => "http://serverslab.net/",
        "version"        => "1.0",
        "guid"             => "",
        "compatibility" => "*"
    );
} 
function gonewsbar_activate() {
global $db;

$gonewsbar_group = array(
        'gid'    => 'NULL',
        'name'  => 'gonewsbar',
        'title'      => 'GoNews Bar Settings',
        'description'    => 'Customise the settings for the  News Bar plugin',
        'disporder'    => "400",
        'isdefault'  => "0",
    );
$db->insert_query('settinggroups', $gonewsbar_group);
 $gid = $db->insert_id();     
$gonewsbar_setting_1 = array(
        'sid'            => 'NULL',
        'name'        => 'gonewsbar_enable',
        'title'            => 'Power On?',
        'description'    => 'If you set this option to yes, this plugin will be active on your board.',
        'optionscode'    => 'yesno',
        'value'        => '1',
        'disporder'        => 1,
        'gid'            => intval($gid),
    ); 
    $gonewsbar_setting_2 = array(
        'sid'            => 'NULL',
        'name'        => 'gonewsbar_input',
        'title'            => 'Content',
        'description'    => 'What do you want the news bar to read? HTML is allowed.',
        'optionscode'    => 'textarea',
        'value'        => '1',
        'disporder'        => 2,
        'gid'            => intval($gid),
    ); 
    $db->insert_query('settings', $gonewsbar_setting_1);
    $db->insert_query('settings', $gonewsbar_setting_2);
    rebuild_settings(); 
}
    function gonewsbar_deactivate()
  {
  global $db;
 $db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN ('gonewsbar_enable')");
  $db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name IN ('gonewsbar_input')");
    $db->query("DELETE FROM ".TABLE_PREFIX."settinggroups WHERE name='gonewsbar'");
rebuild_settings();
 } 
 function gonewsbar_global_start(){
global $mybb;

if ($mybb->settings['gonewsbar_enable'] == 1){
 echo $mybb->settings['gonewsbar_input'];
}
}
 ?>