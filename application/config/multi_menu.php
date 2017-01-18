<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config["menu_id"]               = 'menu_id';
$config["menu_label"]            = 'menu_title';
$config["menu_parent"]           = 'menu_parent';
$config["menu_icon"] 			 = 'menu_icon';
$config["menu_key"]              = 'menu_url';
$config["menu_order"]            = 'order_number';

$config["nav_tag_open"]          = '<ul>';
$config["nav_tag_close"]         = '</ul>';
$config["item_tag_open"]         = '<li>'; 
$config["item_tag_close"]        = '</li>';	
$config["parent_tag_open"]       = '<li>';	
$config["parent_tag_close"]      = '</li>';	
$config["parent_anchor"]     	 = '<a href="%s" class="dropdown-toggle" data-toggle="dropdown">%s</a>';	
$config["children_tag_open"]     = '<ul>';	
$config["children_tag_close"]    = '</ul>';	
$config['icon_position']		 = 'left'; // 'left' or 'right'
$config['menu_icons_list']		 = array();
// these for the future version
$config['icon_img_base_url']	 = ''; 