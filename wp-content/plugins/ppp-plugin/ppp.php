<?php
/*
Plugin Name: Pro Performa Plugin
Plugin URI: https://properforma.de
Description: BESCHREIBUNG DES PLUG-INS
Version: 1.0
Author: Coaching Team
Author URI: LINK ZU IHRER HOMEPAGE
License: GPLv2
*/
/* Shortcode – Google Maps Integration */
function fn_googleMaps($atts, $content = null) {
	extract(shortcode_atts(array(
		                       "width" => 640,
		                       "height" => 480,
		                       "src" => ''
	                       ), $atts));
	return '<iframe width="' . $width . '" height="' . $height . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . $src . '&amp;output=embed"></iframe>';
}
add_shortcode("googlemap", "fn_googleMaps");

function ppp_admin_actions() {
	add_options_page("Pro Performa Plugin Options", "Pro Performa Plugin Settings", 1, "Pro Performa Plugin", "ppp_admin");
}
add_action('admin_menu', 'ppp_admin_actions');

function ppp_getproducts($product_cnt=1) {
	return 'works ' . $product_cnt;

	//Connect to the database
	$db = new wpdb(get_option('ppp_dbuser'),get_option('ppp_dbpwd'), get_option('ppp_dbname'), get_option('ppp_dbhost'));

	$retval = '';
	for ($i=0; $i<$product_cnt; $i++) {
		//Get a random product
		$product_count = 0;
		while ($product_count == 0) {
			$product_id = rand(0,30);
			$product_count = $db->get_var("SELECT COUNT(*) FROM products WHERE products_id=$product_id AND products_status=1");
		}

		//Get product image, name and URL
		$product_image = $db->get_var("SELECT products_image FROM products WHERE products_id=$product_id");
		$product_name = $db->get_var("SELECT products_name FROM products_description WHERE products_id=$product_id");
		$store_url = get_option('ppp_store_url');
		$image_folder = get_option('ppp_prod_img_folder');

		//Build the HTML code
		$retval .= '<div class="ppp_product">';
		$retval .= '<a href="'. $store_url . 'product_info.php?products_id=' . $product_id . '"><img src="' . $image_folder . $product_image . '" /></a><br />';
		$retval .= '<a href="'. $store_url . 'product_info.php?products_id=' . $product_id . '">' . $product_name . '</a>';
		$retval .= '</div>';

	}
	return $retval;
}


function ppp_admin() {
	include('ppp_admin.php');
}

?>