<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| BREADCRUMB CONFIG
| -------------------------------------------------------------------
| This file will contain the settings needed to load the breadbrumb.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['divider']			The string used to divide the crumbs
|	['tag_open'] 		The opening tag placed on the left side of the breadcrumb.
|   ['tag_close'] 		The closing tag placed on the right side of the breadcrumb.
|	['item_open']		The opening tag placed on the left side of each item.
|	['item_close']		The closing tag placed on the right side of each item.
|	['last_item_open']	The opening tag placed on the left side of the last item.
|	['last_item_close']	The closign tag placed on the right side of the last item.
|
*/

$config['tag_open'] = '<ul class="page-breadcrumb">';
$config['tag_close'] = '</ul>';

$config['item_open'] = '<li>';
$config['item_close'] = ' <i class="fa fa-angle-double-right"></i></li>';

$config['last_item_open'] = '<li><span>';
$config['last_item_close'] = '</span></li>';

/* End of file breadcrumb.php */
/* Location: ./application/config/breadcrumb.php */
