<?php
	function ml_add_listing_info_metabox()
	{
		add_meta_box(
			'ml_listing_info',
			__('Listing Info'),
			'ml_add_fields_callback',
			'movie_listing',
			'normal',
			'default'
		);
	}

	add_action('add_meta_boxes', 'ml_add_listing_info_metabox');

	function ml_add_fields_callback($post)
	{
		wp_nonce_field(basename(__FILE__), 'ml_movie_listings_nonce');
		$ml_stored_meta = get_post_meta($post->ID);
		?>
			<div class="wrap movie-listing-form">
				<div class="form-group">
					<label for="movie-id"><?php esc_html_e('Movie Listing ID', 'ml_domain'); ?></label>
					<input type="text" name="movie-id" id="movie-id" value="<?php if(!empty($ml_stored_meta['movie-id'])) echo esc_attr($ml_stored_meta['movie-id'][0]) ?>">
				</div>

				<div class="form-group">
					<label for="mpaa-rating"><?php esc_html_e('Movie Rating', 'ml_domain'); ?></label>
					<select name="mpaa-rating" id="mpaa-rating">
						<?php
							$option_values = [
								'G', 'PG', 'PG-13', 'R', 'Not Rated'
							];

							foreach ($option_values as $key => $value){
								if ($value == $ml_stored_meta['mpaa-rating'][0]) {
									?>
										<option selected><?php echo $value ?></option>
									<?php
								}else{
									?>
										<option><?php echo $value; ?></option>
									<?php
								}
							}
						?>
					</select>
				</div>

				<?php if(get_settings('ml_setting_show_editor')): ?>
					<div class="form-group">
						<label for="details"><?php esc_html_e('Details', 'ml_domain'); ?></label>
						<?php
							$content = get_post_meta($post->ID, 'details', true);
							$editor = 'details';
							$settings = [
								'textarea_rows' => 5,
								'media_buttons' => get_settings('ml_setting_show_media_buttons')
							];

							wp_editor($content, $editor, $settings);
						?>
					</div>
				<?php else: ?>
					<div class="form-group">
						<label for="details"><?php esc_html_e('Details', 'ml_domain'); ?></label>
						<textarea name="details" class="full" id="details"><?php if(!empty($ml_stored_meta['details'])) echo esc_html($ml_stored_meta['details'][0]) ?></textarea>
					</div>
				<?php endif; ?>

				<div class="form-group">
					<label for="release-date"><?php esc_html_e('Release Date', 'ml_domain'); ?></label>
					<input type="date" name="release-date" id="release-date" value="<?php if(!empty($ml_stored_meta['release-date'])) echo esc_attr($ml_stored_meta['release-date'][0]) ?>">
				</div>

				<div class="form-group">
					<label for="director"><?php esc_html_e('Director', 'ml_domain'); ?></label>
					<input type="text" name="director" id="director" value="<?php if(!empty($ml_stored_meta['director'])) echo esc_attr($ml_stored_meta['director'][0]) ?>">
				</div>

				<div class="form-group">
					<label for="stars"><?php esc_html_e('Stars', 'ml_domain'); ?></label>
					<input type="text" name="stars" id="stars" value="<?php if(!empty($ml_stored_meta['stars'])) echo esc_attr($ml_stored_meta['stars'][0]) ?>">
				</div>

				<div class="form-group">
					<label for="runtime"><?php esc_html_e('Runtime', 'ml_domain'); ?></label>
					<input type="text" name="runtime" id="runtime" value="<?php if(!empty($ml_stored_meta['runtime'])) echo esc_attr($ml_stored_meta['runtime'][0]) ?>"> <span class="mins">Mins</span>
				</div>

				<div class="form-group">
					<label for="trailer"><?php esc_html_e('Youtube ID / Trailer', 'ml_domain'); ?></label>
					<input type="text" name="trailer" id="trailer" value="<?php if(!empty($ml_stored_meta['trailer'])) echo esc_attr($ml_stored_meta['trailer'][0]) ?>">
				</div>
			</div>
		<?php
	}

	function ml_meta_save($post_id)
	{
		$is_autosave = wp_is_post_autosave($post_id);
		$is_revision = wp_is_post_revision($post_id);
		$is_valid_nonce = (isset($_POST['ml_movie_listings_nonce']) && wp_verify_nonce($_POST['ml_movie_listings_nonce'], basename(__FILE__)) ? 'true' : 'false');

		if ($is_autosave || $is_revision || !$is_valid_nonce) {
			return;
		}

		if ($_POST['movie-id']) {
			update_post_meta($post_id, 'movie-id', sanitize_text_field($_POST['movie-id']));
		}

		if ($_POST['mpaa-rating']) {
			update_post_meta($post_id, 'mpaa-rating', sanitize_text_field($_POST['mpaa-rating']));
		}

		if ($_POST['details']) {
			update_post_meta($post_id, 'details', sanitize_text_field($_POST['details']));
		}

		if ($_POST['release-date']) {
			update_post_meta($post_id, 'release-date', sanitize_text_field($_POST['release-date']));
		}

		if ($_POST['director']) {
			update_post_meta($post_id, 'director', sanitize_text_field($_POST['director']));
		}

		if ($_POST['stars']) {
			update_post_meta($post_id, 'stars', sanitize_text_field($_POST['stars']));
		}

		if ($_POST['runtime']) {
			update_post_meta($post_id, 'runtime', sanitize_text_field($_POST['runtime']));
		}

		if ($_POST['runtime']) {
			update_post_meta($post_id, 'runtime', sanitize_text_field($_POST['runtime']));
		}

		if ($_POST['trailer']) {
			update_post_meta($post_id, 'trailer', sanitize_text_field($_POST['trailer']));
		}
	}

	add_action('save_post', 'ml_meta_save');