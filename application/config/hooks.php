<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

| -------------------------------------------------------------------------

| Hooks

| -------------------------------------------------------------------------

| This file lets you define "hooks" to extend CI without hacking the core

| files.  Please see the user guide for info:

|

|	http://codeigniter.com/user_guide/general/hooks.html

|

*/



$hook['pre_system'][] = array(
     'class'    => 'site_installed_hook',
     'function' => 'setup',
     'filename' => 'installe.php',
     'filepath' => 'modules/installer/controllers/installer/'
     );  



/* End of file hooks.php */

/* Location: ./application/config/hooks.php */