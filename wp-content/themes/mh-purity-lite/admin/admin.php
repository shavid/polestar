<?php

/***** Theme Info Page *****/

if (!function_exists('mh_add_theme_info_page')) {
	function mh_add_theme_info_page() {
		add_theme_page(__('Welcome to MH Purity lite', 'mh-purity-lite'), __('Theme Info', 'mh-purity-lite'), 'edit_theme_options', 'purity', 'mh_display_theme_info_page');
	}
}
add_action('admin_menu', 'mh_add_theme_info_page');

if (!function_exists('mh_display_theme_info_page')) {
	function mh_display_theme_info_page() {
		$theme_data = wp_get_theme(); ?>
		<div class="theme-info-wrap">
			<h1><?php printf(__('Welcome to %1s %2s', 'mh-purity-lite'), $theme_data->Name, $theme_data->Version ); ?></h1>
			<div class="theme-description"><?php echo $theme_data->Description; ?></div>
			<hr>
			<div class="theme-links clearfix">
				<p><strong><?php _e('Important Links:', 'mh-purity-lite'); ?></strong>
					<a href="http://www.mhthemes.com/themes/mh/purity-lite/" target="_blank"><?php _e('Theme Info Page', 'mh-purity-lite'); ?></a>
					<a href="http://www.mhthemes.com/support/" target="_blank"><?php _e('Support Center', 'mh-purity-lite'); ?></a>
					<a href="http://wordpress.org/support/view/theme-reviews/mh-purity-lite?filter=5" target="_blank"><?php _e('Rate this theme', 'mh-purity-lite'); ?></a>
				</p>
			</div>
			<hr>
			<div id="getting-started">
				<h3><?php printf(__('Getting Started with %s', 'mh-purity-lite'), $theme_data->Name); ?></h3>
				<div class="row clearfix">
					<div class="col-1-2">
						<div class="section">
							<h4><?php _e('Theme Documentation', 'mh-purity-lite'); ?></h4>
							<p class="about"><?php printf(__('Need any help to setup and configure %s? Please have a look at the instructions on the Theme Info Page or read the Documentations and Tutorials in our Support Center.', 'mh-purity-lite'), $theme_data->Name); ?></p>
							<p>
								<a href="http://www.mhthemes.com/themes/mh/purity-lite/" target="_blank" class="button button-secondary"><?php _e('Visit Documentation', 'mh-purity-lite'); ?></a>
							</p>
						</div>
						<div class="section">
							<h4><?php _e('Theme Options', 'mh-purity-lite'); ?></h4>
							<p class="about"><?php printf(__('%s supports the Theme Customizer for all theme settings. Click "Customize Theme" to open the Customizer now.',  'mh-purity-lite'), $theme_data->Name); ?></p>
							<p>
								<a href="<?php echo admin_url('customize.php'); ?>" class="button button-primary"><?php _e('Customize Theme', 'mh-purity-lite'); ?></a>
							</p>
						</div>
						<div class="section">
							<h4><?php _e('Upgrade to Premium', 'mh-purity-lite'); ?></h4>
							<p class="about"><?php _e('Need more features and options? Check out the Premium Version of this theme which comes with additional features and advanced customization options for your website.', 'mh-purity-lite'); ?></p>
							<p>
								<a href="http://www.mhthemes.com/themes/mh/purity/" target="_blank" class="button button-secondary"><?php _e('Learn more about the Premium Version', 'mh-purity-lite'); ?></a>
							</p>
						</div>
					</div>
					<div class="col-1-2">
						<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="Theme Screenshot" />
					</div>
				</div>
			</div>
			<hr>
			<div id="theme-author">
				<p><?php printf(__('%1s is proudly brought to you by %2s. If you like this WordPress theme, %3s.', 'mh-purity-lite'),
					$theme_data->Name,
					'<a target="_blank" href="http://www.mhthemes.com/" title="MH Themes">MH Themes</a>',
					'<a target="_blank" href="http://wordpress.org/support/view/theme-reviews/mh-purity-lite?filter=5" title="MH Purity lite Review">' . __('rate it', 'mh-purity-lite') . '</a>'); ?>
				</p>
			</div>
		</div> <?php
	}
}

?>