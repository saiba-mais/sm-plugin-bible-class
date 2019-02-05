<?php
/**
 * Plugin Name:     Bible Study
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Adds a button in the wordpress wysiwyg editor to insert a bible study widget in your content.
 * Author:          Nextt
 * Author URI:      nextt.com.br
 * Text Domain:     bible-study
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Bible_Study
 */

add_action( 'after_setup_theme', 'bible_study_widget_setup' );
 
if ( ! function_exists( 'bible_study_widget_setup' ) ) {
    function bible_study_widget_setup() {
 
        add_action( 'init', 'add_lesson_button' );
 
    }
}
 
/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'add_lesson_button' ) ) {
    function add_lesson_button() {
        if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
            return;
        }
 
        if ( get_user_option( 'rich_editing' ) !== 'true' ) {
            return;
        }
 
        add_filter( 'mce_external_plugins', 'bible_study_add_button' );
        add_filter( 'mce_buttons', 'bible_study_register_button' );
    }
}
 
if ( ! function_exists( 'bible_study_add_button' ) ) {
    function bible_study_add_button( $plugin_array ) {
        $plugin_array['mybutton'] = plugins_url() . '/bible-study/bible-study-for-wp.js';
        return $plugin_array;
    }
}
 
if ( ! function_exists( 'bible_study_register_button' ) ) {
    function bible_study_register_button( $button ) {
        array_push( $button, 'mybutton' );
        return $button;
    }
}

add_action( 'admin_enqueue_scripts', 'bible_study_admin_enqueues' );

function bible_study_admin_enqueues() {
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'bible-study-admin-js', plugins_url( '/bible-study-admin.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), false, true );
}

add_shortcode( 'bible-study-widget', 'bible_study_shortcode_add' );
add_action ( 'after_wp_tiny_mce', 'bible_study_shortcode_add' );


function bible_study_shortcode_add( $atts, $content = null ) {
	wp_enqueue_script( 'bible-study-js', plugins_url() . '/bible-study/bible-study-setup.js', [], null, true );

	$settings = get_option( 'bible_study_settings' );

	$atts = shortcode_atts(
		[
			'lesson' => '',
			'primarycolor' => '',
			'secondarycolor' => '',
			'lightalphacontainerbg' => '',
			'lightestcontainerbg' => '',
			'lightcontainerbg' => '',
			'containerbg' => '',
			'darkalphacontainerbg' => '',
			'calloutbg' => '',
			'bordercolor' => '',
			'lightesttextcolor' => '',
			'lighttextcolor' => '',
			'textcolor' => '',
			'darktextcolor' => '',
			'darkesttextcolor' => '',
			'successbg' => '',
			'success' => '',
			'errorbg' => '',
			'error' => '',
			// language settings
			'language' => '',
			// contact settings
			'messenger' => '',
			'whatsapp' => ''
		], $atts, 'bible-study-widget'
	);

	$primarycolor = '';
	$secondarycolor = '';
	$lightalphacontainerbg = '';
	$lightestcontainerbg = '';
	$containerbg = '';
	$darkalphacontainerbg = '';
	$calloutbg = '';
	$lightesttextcolor = '';
	$lighttextcolor = '';
	$textcolor = '';
	$darktextcolor = '';
	$darkesttextcolor = '';
	$successbg = '';
	$success = '';
	$errorbg = '';
	$error = '';
	$language = '';
	$messenger = '';
	$whatsapp = '';

	if( !empty( $settings['lesson'] ) && empty( $atts['lesson'] ) ) :
		$lesson = 'data-lesson="' . $settings['lesson'] . '" '; 
	elseif( !empty( $atts['lesson'] ) ) : 
		$lesson = 'data-lesson="' . $atts['lesson'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['primarycolor'] ) && empty( $atts['primarycolor'] ) ) :
		$primarycolor = 'data-primarycolor="' . $settings['primarycolor'] . '" '; 
	elseif( !empty( $atts['primarycolor'] ) ) : 
		$primarycolor = 'data-primarycolor="' . $atts['primarycolor'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['secondarycolor'] ) && empty( $atts['secondarycolor'] ) ) :
		$secondarycolor = 'data-secondarycolor="' . $settings['secondarycolor'] . '" '; 
	elseif( !empty( $atts['secondarycolor'] ) ) : 
		$secondarycolor = 'data-secondarycolor="' . $atts['secondarycolor'] . '" '; 
	else : ''; 
	endif;  

	if( !empty( $settings['lightalphacontainerbg'] ) && empty( $atts['lightalphacontainerbg'] ) ) :
		$lightalphacontainerbg = 'data-lightalphacontainerbg="' . $settings['lightalphacontainerbg'] . '" ';
	elseif( !empty( $atts['lightalphacontainerbg'] ) ) : 
		$lightalphacontainerbg = 'data-lightalphacontainerbg="' . $atts['lightalphacontainerbg'] . '" ';
	else : ''; 
	endif; 

	if( !empty( $settings['lightestcontainerbg'] ) && empty( $atts['lightestcontainerbg'] ) ) :
		$lightestcontainerbg = 'data-lightestcontainerbg="' . $settings['lightestcontainerbg'] . '" '; 
	elseif( !empty( $atts['lightestcontainerbg'] ) ) : 
		$lightestcontainerbg = 'data-lightestcontainerbg="' . $atts['lightestcontainerbg'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['containerbg'] ) && empty( $atts['containerbg'] ) ) :
		$containerbg = 'data-containerbg="' . $settings['containerbg'] . '" '; 
	elseif( !empty( $atts['containerbg'] ) ) : 
		$containerbg = 'data-containerbg="' . $atts['containerbg'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['darkalphacontainerbg'] ) && empty( $atts['darkalphacontainerbg'] ) ) :
		$darkalphacontainerbg = 'data-darkalphacontainerbg="' . $settings['darkalphacontainerbg'] . '" '; 
	elseif( !empty( $atts['darkalphacontainerbg'] ) ) : 
		$darkalphacontainerbg = 'data-darkalphacontainerbg="' . $atts['darkalphacontainerbg'] . '" '; 
	else : '';
	endif;

	if( !empty( $settings['calloutbg'] ) && empty( $atts['calloutbg'] ) ) :
		$calloutbg = 'data-calloutbg="' . $settings['calloutbg'] . '" '; 
	elseif( !empty( $atts['calloutbg'] ) ) : 
		$calloutbg = 'data-calloutbg="' . $atts['calloutbg'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['lightesttextcolor'] ) && empty( $atts['lightesttextcolor'] ) ) :
		$lightesttextcolor = 'data-lightesttextcolor="' . $settings['lightesttextcolor'] . '" '; 
	elseif( !empty( $atts['lightesttextcolor'] ) ) : 
		$lightesttextcolor = 'data-lightesttextcolor="' . $atts['lightesttextcolor'] . '" '; 
	else : ''; 
	endif;

	if( !empty( $settings['lighttextcolor'] ) && empty( $atts['lighttextcolor'] ) ) :
		$lighttextcolor = 'data-lighttextcolor="' . $settings['lighttextcolor'] . '" '; 
	elseif( !empty( $atts['lighttextcolor'] ) ) : 
		$lighttextcolor = 'data-lighttextcolor="' . $atts['lighttextcolor'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['textcolor'] ) && empty( $atts['textcolor'] ) ) :
		$textcolor = 'data-textcolor="' . $settings['textcolor'] . '" '; 
	elseif( !empty( $atts['textcolor'] ) ) : 
		$textcolor = 'data-textcolor="' . $atts['textcolor'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['darktextcolor'] ) && empty( $atts['darktextcolor'] ) ) :
		$darktextcolor = 'data-darktextcolor="' . $settings['darktextcolor'] . '" '; 
	elseif( !empty( $atts['darktextcolor'] ) ) : 
		$darktextcolor = 'data-darktextcolor="' . $atts['darktextcolor'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['darkesttextcolor'] ) && empty( $atts['darkesttextcolor'] ) ) :
		$darkesttextcolor = 'data-darkesttextcolor="' . $settings['darkesttextcolor'] . '" '; 
	elseif( !empty( $atts['darkesttextcolor'] ) ) : 
		$darkesttextcolor = 'data-darkesttextcolor="' . $atts['darkesttextcolor'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['successbg'] ) && empty( $atts['successbg'] ) ) :
		$successbg = 'data-successbg="' . $settings['successbg'] . '" '; 
	elseif( !empty( $atts['successbg'] ) ) : 
		$successbg = 'data-successbg="' . $atts['successbg'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['success'] ) && empty( $atts['success'] ) ) :
		$success = 'data-success="' . $settings['success'] . '" '; 
	elseif( !empty( $atts['success'] ) ) : 
		$success = 'data-success="' . $atts['success'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['errorbg'] ) && empty( $atts['errorbg'] ) ) :
		$errorbg = 'data-errorbg="' . $settings['errorbg'] . '" '; 
	elseif( !empty( $atts['errorbg'] ) ) : 
		$errorbg = 'data-errorbg="' . $atts['errorbg'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['error'] ) && empty( $atts['error'] ) ) :
		$error = 'data-error="' . $settings['error'] . '" '; 
	elseif( !empty( $atts['error'] ) ) : 
		$error = 'data-error="' . $atts['error'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['language'] ) && empty( $atts['language'] ) ) :
		$language = 'data-language="' . $settings['language'] . '" ';
	elseif( !empty( $atts['language'] ) ) : 
		$language = 'data-language="' . $atts['language'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['messenger'] ) && empty( $atts['messenger'] ) ) :
		$messenger = 'data-messenger="' . $settings['messenger'] . '" '; 
	elseif( !empty( $atts['messenger'] ) ) : 
		$messenger = 'data-messenger="' . $atts['messenger'] . '" '; 
	else : ''; 
	endif; 

	if( !empty( $settings['whatsapp'] ) && empty( $atts['whatsapp'] ) ) :
		$whatsapp = 'data-whatsapp="' . $settings['whatsapp'] . '" '; 
	elseif( !empty( $atts['whatsapp'] ) ) : 
		$whatsapp = 'data-whatsapp="' . $atts['whatsapp'] . '" '; 
	else : ''; 
	endif;  

	?>
	<script type="text/javascript">
		var tinyMCE_object = <?php echo json_encode(
			array(
				'button_name' => esc_html__('Adicionar estudo bíblico', 'bible-study'),
				'button_title' => esc_html__('Customize a lição.', 'bible-study'),
				'primarycolor' => $settings['primarycolor'],
				'secondarycolor' => $settings['secondarycolor'],
				'lightalphacontainerbg' => $settings['lightalphacontainerbg'],
				'lightestcontainerbg' => $settings['lightestcontainerbg'],
				'containerbg' => $settings['containerbg'],
				'darkalphacontainerbg' => $settings['darkalphacontainerbg'],
				'calloutbg' => $settings['calloutbg'],
				'lightesttextcolor' => $settings['lightesttextcolor'],
				'lighttextcolor' => $settings['lighttextcolor'],
				'textcolor' => $settings['textcolor'],
				'darktextcolor' => $settings['darktextcolor'],
				'darkesttextcolor' => $settings['darkesttextcolor'],
				'successbg' => $settings['successbg'],
				'success' => $settings['success'],
				'errorbg' => $settings['errorbg'],
				'error' => $settings['error'],
				'language' => $settings['language'],
				'messenger' => $settings['messenger'],
				'whatsapp' => $settings['whatsapp'],
			)
			);
		?>;
	</script><?php

	return '<a class="saiba-mais-widget" ' . $lesson . $primarycolor . $secondarycolor . $lightalphacontainerbg . $lightestcontainerbg . $containerbg . $darkalphacontainerbg . $calloutbg . $lightesttextcolor . $lighttextcolor . $textcolor . $darktextcolor . $darkesttextcolor . $successbg . $success . $errorbg . $error . $language . $messenger . $whatsapp . '>' . $content . '</a>';
}

function bible_study_options_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'bible-study' ) );
	}

	echo '<div class="wrap">';
	//echo '<h1>' . __( 'Bible Study Options', 'bible-study' ) . '</h1>';

	echo '<form method="post" action="options.php">';
	settings_fields( 'bible_study_settings' );
	do_settings_sections( 'bible_study_settings' );
	submit_button();
	echo '</form>';

	echo '</div>';
}

/**
 * Render lesson field
 */
function bible_study_render_lesson_field() {
	$settings = get_option( 'bible_study_settings' );
	$lesson = isset( $settings['lesson'] ) ? $settings['lesson'] : '';
	echo '<input type="text" name="bible_study_settings[lesson]" id="bible_study_lesson" value="' . esc_attr( $lesson ) . '" class="regular-text" />';
}
/**
 * Render primary color field
 */
function bible_study_render_primarycolor_field() {
	$settings         = get_option( 'bible_study_settings' );
	$primarycolor = isset( $settings['primarycolor'] ) ? $settings['primarycolor'] : '';
	echo '<input type="text" name="bible_study_settings[primarycolor]" id="bible_study_primarycolor" value="' . esc_attr( $primarycolor ) . '" class="color-picker" />';
}
/**
 * Render secondary color field
 */
function bible_study_render_secondarycolor_field() {
	$settings = get_option( 'bible_study_settings' );
	$secondarycolor    = isset( $settings['secondarycolor'] ) ? $settings['secondarycolor'] : '';
	echo '<input type="text" name="bible_study_settings[secondarycolor]" id="bible_study_secondarycolor" value="' . esc_attr( $secondarycolor ) . '" class="color-picker" />';
}
/**
 * Render light alpha container background color field
 */
function bible_study_render_lightalphacontainerbg_field() {
	$settings         = get_option( 'bible_study_settings' );
	$lightalphacontainerbg = isset( $settings['lightalphacontainerbg'] ) ? $settings['lightalphacontainerbg'] : '';
	echo '<input type="text" name="bible_study_settings[lightalphacontainerbg]" id="bible_study_lightalphacontainerbg" value="' . esc_attr( $lightalphacontainerbg ) . '" class="color-picker" />';
}
/**
 * Render lightest container background color field
 */
function bible_study_render_lightestcontainerbg_field() {
	$settings = get_option( 'bible_study_settings' );
	$lightestcontainerbg    = isset( $settings['lightestcontainerbg'] ) ? $settings['lightestcontainerbg'] : '';
	echo '<input type="text" name="bible_study_settings[lightestcontainerbg]" id="bible_study_lightestcontainerbg" value="' . esc_attr( $lightestcontainerbg ) . '" class="color-picker" />';
}
/**
 * Render container background color field
 */
function bible_study_render_containerbg_field() {
	$settings         = get_option( 'bible_study_settings' );
	$containerbg = isset( $settings['containerbg'] ) ? $settings['containerbg'] : '';
	echo '<input type="text" name="bible_study_settings[containerbg]" id="bible_study_containerbg" value="' . esc_attr( $containerbg ) . '" class="color-picker" />';
}
/**
 * Render dark alpha container background color field
 */
function bible_study_render_darkalphacontainerbg_field() {
	$settings = get_option( 'bible_study_settings' );
	$darkalphacontainerbg    = isset( $settings['darkalphacontainerbg'] ) ? $settings['darkalphacontainerbg'] : '';
	echo '<input type="text" name="bible_study_settings[darkalphacontainerbg]" id="bible_study_darkalphacontainerbg" value="' . esc_attr( $darkalphacontainerbg ) . '" class="color-picker" />';
}
/**
 * Render callout background color field
 */
function bible_study_render_calloutbg_field() {
	$settings         = get_option( 'bible_study_settings' );
	$calloutbg = isset( $settings['calloutbg'] ) ? $settings['calloutbg'] : '';
	echo '<input type="text" name="bible_study_settings[calloutbg]" id="bible_study_calloutbg" value="' . esc_attr( $calloutbg ) . '" class="color-picker" />';
}
/**
 * Render lightest text color field
 */
function bible_study_render_lightesttextcolor_field() {
	$settings = get_option( 'bible_study_settings' );
	$lightesttextcolor    = isset( $settings['lightesttextcolor'] ) ? $settings['lightesttextcolor'] : '';
	echo '<input type="text" name="bible_study_settings[lightesttextcolor]" id="bible_study_lightesttextcolor" value="' . esc_attr( $lightesttextcolor ) . '" class="color-picker" />';
}
/**
 * Render light text color field
 */
function bible_study_render_lighttextcolor_field() {
	$settings         = get_option( 'bible_study_settings' );
	$lighttextcolor = isset( $settings['lighttextcolor'] ) ? $settings['lighttextcolor'] : '';
	echo '<input type="text" name="bible_study_settings[lighttextcolor]" id="bible_study_lighttextcolor" value="' . esc_attr( $lighttextcolor ) . '" class="color-picker" />';
}
/**
 * Render text color field
 */
function bible_study_render_textcolor_field() {
	$settings = get_option( 'bible_study_settings' );
	$textcolor    = isset( $settings['textcolor'] ) ? $settings['textcolor'] : '';
	echo '<input type="text" name="bible_study_settings[textcolor]" id="bible_study_textcolor" value="' . esc_attr( $textcolor ) . '" class="color-picker" />';
}
/**
 * Render dark text color field
 */
function bible_study_render_darktextcolor_field() {
	$settings         = get_option( 'bible_study_settings' );
	$darktextcolor = isset( $settings['darktextcolor'] ) ? $settings['darktextcolor'] : '';
	echo '<input type="text" name="bible_study_settings[darktextcolor]" id="bible_study_darktextcolor" value="' . esc_attr( $darktextcolor ) . '" class="color-picker" />';
}
/**
 * Render darkest text color field
 */
function bible_study_render_darkesttextcolor_field() {
	$settings = get_option( 'bible_study_settings' );
	$darkesttextcolor    = isset( $settings['darkesttextcolor'] ) ? $settings['darkesttextcolor'] : '';
	echo '<input type="text" name="bible_study_settings[darkesttextcolor]" id="bible_study_darkesttextcolor" value="' . esc_attr( $darkesttextcolor ) . '" class="color-picker" />';
}
/**
 * Render success background color field
 */
function bible_study_render_successbg_field() {
	$settings         = get_option( 'bible_study_settings' );
	$successbg = isset( $settings['successbg'] ) ? $settings['successbg'] : '';
	echo '<input type="text" name="bible_study_settings[successbg]" id="bible_study_successbg" value="' . esc_attr( $successbg ) . '" class="color-picker" />';
}
/**
 * Render success color field
 */
function bible_study_render_success_field() {
	$settings = get_option( 'bible_study_settings' );
	$success    = isset( $settings['success'] ) ? $settings['success'] : '';
	echo '<input type="text" name="bible_study_settings[success]" id="bible_study_success" value="' . esc_attr( $success ) . '" class="color-picker" />';
}
/**
 * Render error background color field
 */
function bible_study_render_errorbg_field() {
	$settings         = get_option( 'bible_study_settings' );
	$errorbg = isset( $settings['errorbg'] ) ? $settings['errorbg'] : '';
	echo '<input type="text" name="bible_study_settings[errorbg]" id="bible_study_errorbg" value="' . esc_attr( $errorbg ) . '" class="color-picker" />';
}
/**
 * Render error color field
 */
function bible_study_render_error_field() {
	$settings         = get_option( 'bible_study_settings' );
	$error = isset( $settings['error'] ) ? $settings['error'] : '';
	echo '<input type="text" name="bible_study_settings[error]" id="bible_study_error" value="' . esc_attr( $error ) . '" class="color-picker" />';
}
/**
 * Render languaga field
 */
function bible_study_render_language_field() {
	$settings = get_option( 'bible_study_settings' );
	$language = isset( $settings['language'] ) ? $settings['language'] : '';
	echo '<input type="text" name="bible_study_settings[language]" id="bible_study_language" value="' . esc_attr( $language ) . '" class="regular-text" />';
}
/**
 * Render messenger field
 */
function bible_study_render_messenger_field() {
	$settings = get_option( 'bible_study_settings' );
	$messenger = isset( $settings['messenger'] ) ? $settings['messenger'] : '';
	echo '<input type="text" name="bible_study_settings[messenger]" id="bible_study_messenger" value="' . esc_attr( $messenger ) . '" class="regular-text" />';
}
/**
 * Render whatsapp field
 */
function bible_study_render_whatsapp_field() {
	$settings = get_option( 'bible_study_settings' );
	$whatsapp = isset( $settings['whatsapp'] ) ? $settings['whatsapp'] : '';
	echo '<input type="text" name="bible_study_settings[whatsapp]" id="bible_study_whatsapp" value="' . esc_attr( $whatsapp ) . '" class="regular-text" />';
}

add_action( 'admin_init', 'bible_study_register_settings' );
/**
 * Register options page fields and settings option
 */
function bible_study_register_settings() {
	// Add Section for option fields.
	add_settings_section( 'bible_study_settings_section', __( 'Bible Study Options', 'bible-study' ), '__return_false', 'bible_study_settings' );
	add_settings_field( 'bible_study_lesson_field', __( 'Lesson', 'bible-study' ), 'bible_study_render_lesson_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_primarycolor_field', __( 'Primary Color', 'bible-study' ), 'bible_study_render_primarycolor_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_secondarycolor_field', __( 'Secondary Color', 'bible-study' ), 'bible_study_render_secondarycolor_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_lightalphacontainerbg_field', __( 'Light Alpha Container Background Color', 'bible-study' ), 'bible_study_render_lightalphacontainerbg_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_lightestcontainerbg_field', __( 'Lightest Container Background Color', 'bible-study' ), 'bible_study_render_lightestcontainerbg_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_containerbg_field', __( 'Container Background Color', 'bible-study' ), 'bible_study_render_containerbg_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_darkalphacontainerbg_field', __( 'Dark Alpha Container Background Color', 'bible-study' ), 'bible_study_render_darkalphacontainerbg_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_calloutbg_field', __( 'Callout Background Color', 'bible-study' ), 'bible_study_render_calloutbg_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_lightesttextcolor_field', __( 'Lightest Text Color', 'bible-study' ), 'bible_study_render_lightesttextcolor_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_lighttextcolor_field', __( 'Light Text Color', 'bible-study' ), 'bible_study_render_lighttextcolor_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_textcolor_field', __( 'Text Color', 'bible-study' ), 'bible_study_render_textcolor_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_darktextcolor_field', __( 'Dark Text Color', 'bible-study' ), 'bible_study_render_darktextcolor_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_darkesttextcolor_field', __( 'Darkest Text Color', 'bible-study' ), 'bible_study_render_darkesttextcolor_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_successbg_field', __( 'Success Background Color', 'bible-study' ), 'bible_study_render_successbg_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_success_field', __( 'Success Color', 'bible-study' ), 'bible_study_render_success_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_errorbg_field', __( 'Error Background Color', 'bible-study' ), 'bible_study_render_errorbg_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_error_field', __( 'Error Color', 'bible-study' ), 'bible_study_render_error_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_language_field', __( 'Language', 'bible-study' ), 'bible_study_render_language_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_messenger_field', __( 'Messenger', 'bible-study' ), 'bible_study_render_messenger_field', 'bible_study_settings', 'bible_study_settings_section' );
	add_settings_field( 'bible_study_whatsapp_field', __( 'Whatsapp', 'bible-study' ), 'bible_study_render_whatsapp_field', 'bible_study_settings', 'bible_study_settings_section' );

	register_setting( 'bible_study_settings', 'bible_study_settings' );
}

add_action( 'admin_menu', 'bible_study_settings_page' );

function bible_study_settings_page() {
	add_options_page( __( 'Bible Study Options', 'bible-study' ), __( 'Bible Study Options', 'bible-study' ), 'manage_options', 'bible_study_settings', 'bible_study_options_page' );
}