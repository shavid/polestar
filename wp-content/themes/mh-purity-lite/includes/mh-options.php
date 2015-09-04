<?php

function mh_customize_register($wp_customize) {

	/***** Add Custom Control Functions *****/

	class MH_Customize_Header_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<label>
				<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
			</label> <?php
        }
    }

	class MH_Customize_Text_Control extends WP_Customize_Control {
        public function render_content() { ?>
			<span class="textfield"><?php echo esc_html($this->label); ?></span> <?php
        }
    }

    class MH_Customize_Button_Control extends WP_Customize_Control {
        public function render_content() {  ?>
			<p>
				<a href="http://www.mhthemes.com/themes/mh/purity/" target="_blank" class="button button-secondary"><?php echo esc_html($this->label); ?></a>
			</p> <?php
        }
    }

	/***** Add Sections *****/

	$wp_customize->add_section('mh_purity', array('title' => __('Purity Options', 'mh-purity-lite'), 'priority' => 1));
	$wp_customize->add_section('mh_upgrade', array('title' => __('Upgrade to Premium', 'mh-purity-lite'), 'priority' => 999));

    /***** Add Settings *****/

    $wp_customize->add_setting('mh_options[excerpt_length]', array('default' => '110', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_integer'));
    $wp_customize->add_setting('mh_options[excerpt_more]', array('default' => '[...]', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_text'));
    $wp_customize->add_setting('mh_options[sb_position]', array('default' => 'right', 'type' => 'option', 'sanitize_callback' => 'mh_sanitize_select'));
	$wp_customize->add_setting('mh_options[premium_version_label]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
	$wp_customize->add_setting('mh_options[premium_version_text]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));
	$wp_customize->add_setting('mh_options[premium_version_button]', array('default' => '', 'type' => 'option', 'sanitize_callback' => 'esc_attr'));

    /***** Add Controls *****/

    $wp_customize->add_control('excerpt_length', array('label' => __('Excerpt Length in Characters', 'mh-purity-lite'), 'section' => 'mh_purity', 'settings' => 'mh_options[excerpt_length]', 'priority' => 1, 'type' => 'text'));
    $wp_customize->add_control('excerpt_more', array('label' => __('Custom Excerpt More Text', 'mh-purity-lite'), 'section' => 'mh_purity', 'settings' => 'mh_options[excerpt_more]', 'priority' => 2, 'type' => 'text'));
    $wp_customize->add_control('sb_position', array('label' => __('Position of default Sidebar', 'mh-purity-lite'), 'section' => 'mh_purity', 'settings' => 'mh_options[sb_position]', 'priority' => 3, 'type' => 'select', 'choices' => array('left' => __('Left', 'mh-purity-lite'), 'right' => __('Right', 'mh-purity-lite'))));
	$wp_customize->add_control(new MH_Customize_Header_Control($wp_customize, 'premium_version_label', array('label' => __('Need more features and options?', 'mh-purity-lite'), 'section' => 'mh_upgrade', 'settings' => 'mh_options[premium_version_label]', 'priority' => 1)));
	$wp_customize->add_control(new MH_Customize_Text_Control($wp_customize, 'premium_version_text', array('label' => __('Check out the Premium Version of this theme which comes with additional features and advanced customization options for your website.', 'mh-purity-lite'), 'section' => 'mh_upgrade', 'settings' => 'mh_options[premium_version_text]', 'priority' => 2)));
	$wp_customize->add_control(new MH_Customize_Button_Control($wp_customize, 'premium_version_button', array('label' => __('Learn more about the Premium Version', 'mh-purity-lite'), 'section' => 'mh_upgrade', 'settings' => 'mh_options[premium_version_button]', 'priority' => 3)));
}
add_action('customize_register', 'mh_customize_register');

/***** Data Sanitization *****/

function mh_sanitize_text($input) {
    return wp_kses_post(force_balance_tags($input));
}
function mh_sanitize_integer($input) {
    return strip_tags($input);
}
function mh_sanitize_checkbox($input) {
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}
function mh_sanitize_select($input) {
    $valid = array(
        'left' => __('Left', 'mh-purity-lite'),
        'right' => __('Right', 'mh-purity-lite'),
    );
    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}

/***** Return Theme Options / Set Default Options *****/

if (!function_exists('mh_purity_lite_theme_options')) {
	function mh_purity_lite_theme_options() {
		$theme_options = wp_parse_args(
			get_option('mh_options', array()),
			mh_purity_lite_default_options()
		);
		return $theme_options;
	}
}

if (!function_exists('mh_purity_lite_default_options')) {
	function mh_purity_lite_default_options() {
		$default_options = array(
			'excerpt_length' => '110',
			'excerpt_more' => '[...]',
			'sb_position' => 'right',
			'premium_version_label' => '',
			'premium_version_text' => '',
			'premium_version_button' => ''
		);
		return $default_options;
	}
}

?>