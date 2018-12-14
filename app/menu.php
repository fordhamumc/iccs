<?php

namespace App;

/**
 * Remove all classes except the one's listed in the array
 */
function menu_classes($classes) {
	if (!is_array($classes)) return $classes;
	return array_filter($classes, function ($class) {
		return substr($class, 0, 10) !== "menu-item-";
	});
	return is_array($var) ? array_intersect($var, array(
			'current-menu-item',
			'menu-item'
		)
	) : '';
}
add_filter('nav_menu_css_class', 'App\menu_classes');
add_filter('nav_menu_item_id', '__return_empty_string');
add_filter('page_css_class', 'App\menu_classes');

/**
 * Rename remaining classes
 */
add_filter ('wp_nav_menu', function ($nav_menu, $args){
	$prefix = ($args->container_class) ? $args->container_class . '__' : '';
	$replace = array(
		'menu-item'             => $prefix . 'item',
		'current-menu-item'     => $prefix . 'active'
	);
	$text = str_replace(array_keys($replace), $replace, $nav_menu);
	return $text;
}, 10, 2);

//Deletes empty classes and removes the sub menu class
add_filter ('wp_nav_menu',function ($menu) {
	$menu = preg_replace('/ class=""| class="sub-menu"/','',$menu);
	return $menu;
});