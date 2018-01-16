<?php

// Check if admin
if(is_admin()){
	// Add Scripts
	function ml_add_admin_scripts(){
		wp_enqueue_style( 'jquery_style',  'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/themes/smoothness/jquery-ui.css');
		wp_enqueue_style( 'ml_admin_style', plugins_url().'/movie-listings/css/styles-admin.css');
		wp_enqueue_script('ml-script', plugins_url().'/movie-listings/js/main.js', array('jquery', 'jquery-ui-sortable') );
		wp_localize_script('ml-script', 'ML_MOVIE_LISTING', array(
			'token' => wp_create_nonce('ml-token')
		));
	}

	add_action('admin_init', 'ml_add_admin_scripts');
}

// Add scripts
function ml_add_scripts(){
	wp_enqueue_style('ml-main-style', plugins_url() . '/movie-listings/css/style.css');
	wp_enqueue_script('ml-main-script', plugins_url() . '/movie-listings/js/main.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'ml_add_scripts');