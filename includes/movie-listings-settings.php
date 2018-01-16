<?php
	function ml_movie_listings_settings()
	{
		add_settings_section(
			'ml_setting_section',
			'Movie Listings Settings',
			'ml_setting_section_callback',
			'reading'
		);

		// Add fields
		add_settings_field(
			'ml_setting_show_editor',
			'Show Editor',
			'ml_setting_show_editor_callback',
			'reading',
			'ml_setting_section'
		);
		register_setting('reading', 'ml_setting_show_editor');

		add_settings_field(
			'ml_setting_show_media_buttons',
			'Show Media Buttons',
			'ml_setting_show_media_buttons_callback',
			'reading',
			'ml_setting_section'
		);
		register_setting('reading', 'ml_setting_show_media_buttons');
	}

	add_action('admin_init', 'ml_movie_listings_settings');

	function ml_setting_section_callback()
	{
		echo "<p>Settings for the Movie Listings Plugin</p>";
	}

	function ml_setting_show_editor_callback()
	{
		echo "<input 
				name='ml_setting_show_editor'
				id='ml_setting_show_editor' 
				type='checkbox'
				value='1'
				class='code'
				". checked(1, get_option('ml_setting_show_editor'), false)."
				>Show editor";
	}

	function ml_setting_show_media_buttons_callback()
	{
		echo "<input 
				name='ml_setting_show_media_buttons'
				id='ml_setting_show_media_buttons' 
				type='checkbox'
				value='1'
				class='code'
				". checked(1, get_option('ml_setting_show_media_buttons'), false)."
				>Show media buttons";
	}