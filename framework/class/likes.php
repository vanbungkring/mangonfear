<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Likes Functions
 * Changed by CMSMasters
 * 
 */


class Cmsms_Likes {
	function Cmsms_Likes() { 
		$like_labels = array( 
			'name' => 			__('Likes', 'cmsms_content_composer'), 
			'singular_name' => 	__('Like', 'cmsms_content_composer') 
		);
		
		
		$like_args = array( 
			'labels' => 				$like_labels, 
			'public' => 				false, 
			'capability_type' => 		'post', 
			'hierarchical' => 			false, 
			'exclude_from_search' => 	true, 
			'publicly_queryable' => 	false, 
			'show_ui' => 				false, 
			'show_in_nav_menus' => 		false 
		);
		
		
		register_post_type('cmsms_like', $like_args);
	}
}


function cmsms_likes_init() {
	global $lk;
	
	
	$lk = new Cmsms_Likes();
}


add_action('init', 'cmsms_likes_init');



function cmsmsLike($show = true) {
	$post_ID = get_the_ID();
	
	
	$ip = $_SERVER['REMOTE_ADDR'];
	
	
	$likes = (get_post_meta($post_ID, 'cmsms_likes', true) != '') ? get_post_meta($post_ID, 'cmsms_likes', true) : '0';
	
	
	$ipCheck = get_posts(array( 
		'post_type' => 		'cmsms_like', 
		'post_status' => 	'draft', 
		'post_parent' => 	$post_ID, 
		'post_title' => 	$ip 
	));
	
	
	if (isset($_COOKIE['like-' . $post_ID]) || count($ipCheck) != 0) {
		$counter = '<a href="#" onclick="return false;" id="cmsmsLike-' . $post_ID . '" class="cmsmsLike active cmsms-icon-heart-7"><span>' . $likes . '</span></a>';
	} else {
		$counter = '<a href="#" onclick="cmsmsLike(' . $post_ID . '); return false;" id="cmsmsLike-' . $post_ID . '" class="cmsmsLike cmsms-icon-heart-7"><span>' . $likes . '</span></a>';
	}
	
	
	if ($show != true) {
		return $counter;
	} else {
		echo $counter;
	}
}

