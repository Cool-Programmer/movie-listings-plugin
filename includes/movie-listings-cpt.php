<?php
	// Create custom post type
	function ml_register_movie_listing()
	{
		$singular_name = apply_filters('ml_label_single', 'Movie Listing');
		$plural_name = apply_filters('ml_label_plural', 'Movie Listings');

		$labels = [
			'name' 					=> $plural_name,
			'singular_name' 		=> $singular_name,
			'add_new'				=> 'Add New',
			'add_new_item'			=> 'Add New ' . $singular_name,
			'edit' 					=> 'Edit',
			'edit_item'				=> 'Edit ' . $singular_name,
			'new_item' 				=> 'New ' . $singular_name,
			'view' 					=> 'View',
			'view_item'				=> 'View ' . $singular_name,
			'search_items' 			=> 'Search ' . $plural_name,
			'not_found' 			=> 'No ' . $plural_name . ' Found',
			'not_found_in_trash' 	=> 'No ' . $plural_name . ' Found',
			'menu_name'				=> $plural_name
		];

		$args = apply_filters('tdl_args', [
			'labels' 			=> $labels,
			'hierarchical'		=> true,
			'description' 		=> 'Movie listings by genre',
			'taxonomies' 		=> ['geners'],
			'public'			=> true,
			'show_ui'			=> true,
			'show_in_menu'		=> true,
			'menu_position' 	=> 5,
			'menu_icon'			=> 'dashicons-edit',
			'show_in_nav_menus' => true,
			'publicly_queryable'=> true,
			'exclude_from_search'=>false,
			'has_archive'		=> true,
			'query_var'			=> true,
			'can_export'		=> true,
			'rewrite'			=> true,
			'capability_type'	=> 'post',
			'supports'			=> [
				'title',
				'thumbnail'
			]
		]);

		// Register the post type
		register_post_type('movie_listing', $args);
	}
	add_action('init', 'ml_register_movie_listing');


	// Create genre taxonomy
	function ml_genres_taxonomy()
	{
		register_taxonomy(
			'genres',
			'movie_listing',
			[
				'label' => 'Genres',
				'hierarchical' => true,
				'query_var' => true,
				'rewrite' 	=> [
					'slug' 	=> 'genre',
					'with_front' => false
				]
			]
		);
	}

	add_action('init', 'ml_genres_taxonomy');

	// Load template
	function ml_load_templates($template){
		if(get_query_var('post_type') == 'movie_listing'){
			$new_template = plugin_dir_path(__FILE__). 'templates/single-movie-listing.php';
			if('' != $new_template){
				return $new_template;
			}
		}
		return $template;
	}
	add_filter('template_include', 'ml_load_templates');