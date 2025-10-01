/**
 * Add this code to your theme's functions.php file
 * This will enqueue the custom styles for the Tutorial template
 */

/**
 * Enqueue custom styles for the Tutorial template
 */
function astra_tutorial_custom_styles() {
    if (is_page_template('tutorial-template.php')) {
        wp_enqueue_style('astra-tutorial-style', get_template_directory_uri() . '/assets/css/tutorial-custom.css', array(), ASTRA_THEME_VERSION);
    }
}
add_action('wp_enqueue_scripts', 'astra_tutorial_custom_styles');
