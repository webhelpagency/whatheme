<?php
add_action('wp_enqueue_scripts', 'theme_name_scripts');
// add_action('wp_print_styles', 'theme_name_scripts'); // можно использовать этот хук он более поздний
function theme_name_scripts()
{
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('main-theme', get_template_directory_uri() . '/css/styles.css');
}


// UnderStrap's includes directory.
$understrap_inc_dir = get_template_directory() . '/inc';

// Array of files to include.
$understrap_includes = array(
	'/setup.php',                           // Theme setup and custom theme supports.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
    '/class-tgm-plugin-activation.php',                      // Include the TGM_Plugin_Activation class.
    '/sidebars.php',                      // Register Custom sidebars
    '/woocommerce.php',                      // Include the TGM_Plugin_Activation class.
	'/tgmpa_register.php',                      // Include the TGM_Plugin_Activation class.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
);

// Include files.
foreach ($understrap_includes as $file) {
	require_once $understrap_inc_dir . $file;
}
