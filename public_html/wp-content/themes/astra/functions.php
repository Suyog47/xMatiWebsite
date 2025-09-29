<?php
/**
 * Astra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'ASTRA_THEME_VERSION', '4.8.11' );
define( 'ASTRA_THEME_SETTINGS', 'astra-settings' );
define( 'ASTRA_THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'ASTRA_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
define( 'ASTRA_THEME_ORG_VERSION', file_exists( ASTRA_THEME_DIR . 'inc/w-org-version.php' ) );

/**
 * Minimum Version requirement of the Astra Pro addon.
 * This constant will be used to display the notice asking user to update the Astra addon to the version defined below.
 */
define( 'ASTRA_EXT_MIN_VER', '4.8.9' );

/**
 * Load in-house compatibility.
 */
if ( ASTRA_THEME_ORG_VERSION ) {
	require_once ASTRA_THEME_DIR . 'inc/w-org-version.php';
}

/**
 * Setup helper functions of Astra.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-theme-options.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-theme-strings.php';
require_once ASTRA_THEME_DIR . 'inc/core/common-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-icons.php';

define( 'ASTRA_WEBSITE_BASE_URL', 'https://wpastra.com' );

/**
 * ToDo: Deprecate constants in future versions as they are no longer used in the codebase.
 */
define( 'ASTRA_PRO_UPGRADE_URL', ASTRA_THEME_ORG_VERSION ? astra_get_pro_url( '/pricing/', 'free-theme', 'dashboard', 'upgrade' ) : 'https://woocommerce.com/products/astra-pro/' );
define( 'ASTRA_PRO_CUSTOMIZER_UPGRADE_URL', ASTRA_THEME_ORG_VERSION ? astra_get_pro_url( '/pricing/', 'free-theme', 'customizer', 'upgrade' ) : 'https://woocommerce.com/products/astra-pro/' );

/**
 * Update theme
 */
require_once ASTRA_THEME_DIR . 'inc/theme-update/astra-update-functions.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-theme-background-updater.php';

/**
 * Fonts Files
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-font-families.php';
if ( is_admin() ) {
	require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts-data.php';
}

require_once ASTRA_THEME_DIR . 'inc/lib/webfont/class-astra-webfont-loader.php';
require_once ASTRA_THEME_DIR . 'inc/lib/docs/class-astra-docs-loader.php';
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts.php';

require_once ASTRA_THEME_DIR . 'inc/dynamic-css/custom-menu-old-header.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/container-layouts.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/astra-icons.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-walker-page.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-enqueue-scripts.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-gutenberg-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-wp-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/block-editor-compatibility.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/inline-on-mobile.php';
require_once ASTRA_THEME_DIR . 'inc/dynamic-css/content-background.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-dynamic-css.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-global-palette.php';

// Enable NPS Survey only if the starter templates version is < 4.3.7 or > 4.4.4 to prevent fatal error.
if ( ! defined( 'ASTRA_SITES_VER' ) || version_compare( ASTRA_SITES_VER, '4.3.7', '<' ) || version_compare( ASTRA_SITES_VER, '4.4.4', '>' ) ) {
	// NPS Survey Integration
	require_once ASTRA_THEME_DIR . 'inc/lib/class-astra-nps-notice.php';
	require_once ASTRA_THEME_DIR . 'inc/lib/class-astra-nps-survey.php';
}

/**
 * UTM Analytics lib file.
 */
require_once ASTRA_THEME_DIR . 'inc/lib/class-astra-utm-analytics.php';

/**
 * Custom template tags for this theme.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-attr.php';
require_once ASTRA_THEME_DIR . 'inc/template-tags.php';

require_once ASTRA_THEME_DIR . 'inc/widgets.php';
require_once ASTRA_THEME_DIR . 'inc/core/theme-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/admin-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/sidebar-manager.php';

/**
 * Markup Functions
 */
require_once ASTRA_THEME_DIR . 'inc/markup-extras.php';
require_once ASTRA_THEME_DIR . 'inc/extras.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog-config.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog.php';
require_once ASTRA_THEME_DIR . 'inc/blog/single-blog.php';

/**
 * Markup Files
 */
require_once ASTRA_THEME_DIR . 'inc/template-parts.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-loop.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-mobile-header.php';

/**
 * Functions and definitions.
 */
require_once ASTRA_THEME_DIR . 'inc/class-astra-after-setup-theme.php';

// Required files.
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-helper.php';

require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-schema.php';

/* Setup API */
require_once ASTRA_THEME_DIR . 'admin/includes/class-astra-api-init.php';

if ( is_admin() ) {
	/**
	 * Admin Menu Settings
	 */
	require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-settings.php';
	require_once ASTRA_THEME_DIR . 'admin/class-astra-admin-loader.php';
	require_once ASTRA_THEME_DIR . 'inc/lib/astra-notices/class-astra-notices.php';
}

/**
 * Metabox additions.
 */
require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-boxes.php';

require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-box-operations.php';

/**
 * Customizer additions.
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-customizer.php';

/**
 * Astra Modules.
 */
require_once ASTRA_THEME_DIR . 'inc/modules/posts-structures/class-astra-post-structures.php';
require_once ASTRA_THEME_DIR . 'inc/modules/related-posts/class-astra-related-posts.php';

/**
 * Compatibility
 */
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gutenberg.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-jetpack.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/woocommerce/class-astra-woocommerce.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/edd/class-astra-edd.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/lifterlms/class-astra-lifterlms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/learndash/class-astra-learndash.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bb-ultimate-addon.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-contact-form-7.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-visual-composer.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-site-origin.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gravity-forms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bne-flyout.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-ubermeu.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-divi-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-amp.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-yoast-seo.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/surecart/class-astra-surecart.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-starter-content.php';
require_once ASTRA_THEME_DIR . 'inc/addons/transparent-header/class-astra-ext-transparent-header.php';
require_once ASTRA_THEME_DIR . 'inc/addons/breadcrumbs/class-astra-breadcrumbs.php';
require_once ASTRA_THEME_DIR . 'inc/addons/scroll-to-top/class-astra-scroll-to-top.php';
require_once ASTRA_THEME_DIR . 'inc/addons/heading-colors/class-astra-heading-colors.php';
require_once ASTRA_THEME_DIR . 'inc/builder/class-astra-builder-loader.php';

// Elementor Compatibility requires PHP 5.4 for namespaces.
if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor-pro.php';
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-web-stories.php';
}

// Beaver Themer compatibility requires PHP 5.3 for anonymous functions.
if ( version_compare( PHP_VERSION, '5.3', '>=' ) ) {
	require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-themer.php';
}

require_once ASTRA_THEME_DIR . 'inc/core/markup/class-astra-markup.php';

/**
 * Load deprecated functions
 */
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-filters.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-functions.php';
function dynamic_owl_carousel_shortcode($atts) {
    // Enqueue Owl Carousel CSS and JS files
    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_style('owl-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
    wp_enqueue_script('jquery');  // Ensure jQuery is loaded
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), '', true);

    // Inline script to initialize Owl Carousel
    wp_add_inline_script('owl-carousel-js', '
    jQuery(document).ready(function($) {
        $(".owl-carousel").owlCarousel({
            //loop: true,             // Enable continuous looping
            margin: 10,
            //nav: true,              // Show navigation arrows
            dots: true,             // Show dots
            //autoplay: true,         // Enable autoplay
            //autoplayTimeout: 2000,  // Set the autoplay speed to 2000ms (2 seconds)
            autoplayHoverPause: true, // Pause autoplay on hover
            responsive: {
                0: {
                    items: 1      // 1 item for screens smaller than 600px
                },
                600: {
                    items: 2      // 2 items for screens between 600px and 1000px
                },
                1000: {
                    items: 4      // 4 items for screens larger than 1000px
                }
            }
        });
    });
    ');

    // Query for the latest 4 posts (you can change the number as needed)
    $args = array(
        'post_type' => 'post', // Change to a custom post type if needed
        'posts_per_page' => -1, // Limit to 4 posts
        'post_status' => 'publish'
    );

    $query = new WP_Query($args);

    // Start the output for the carousel
    $output = '<div class="owl-carousel owl-theme">';

    // Loop through the posts
    while ($query->have_posts()) {
        $query->the_post();
        
        // Get the post title, featured image, excerpt, and post date
        $title = get_the_title();
        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // 'full' size image
        $excerpt = get_the_excerpt();
        $date = get_the_date();  // Get the post's publish date

        // Add each post as an item in the carousel
        $output .= '
        <div class="item">
            <div class="image">
                <a href="' .get_permalink() . '">
                    <img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">
                </a>
            </div>
            <div class="description">
                <h3><a href="' . get_permalink() . '">' . esc_html($title) . '</a></h3>
                <p class="post-date">' . esc_html($date) . '</p>  <!-- Display the post date -->
                <p>' . esc_html($excerpt) . '</p>
            </div>
        </div>
    ';
    }

    // Reset post data to the original query
    wp_reset_postdata();

    // Add some custom CSS to remove unnecessary white space
    $output .= '
    <style>
        /* Remove any default padding or margin around the carousel */
        .owl-carousel {
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Remove padding and margin from items */
        .owl-carousel .item {
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Ensure images inside carousel fit perfectly without stretching */
        .owl-carousel .item .image img {
            width: 100%;
            height: auto;
        }

        /* Description section styles */
        .owl-carousel .item .description {
            padding: 10px;
        }

        .description .post-date {
            font-size: 12px;
            color: #999;
            margin-top: 5px;
        }

        /* Remove extra space between navigation arrows and content */
        .owl-carousel .owl-nav,
        .owl-carousel .owl-dots {
            margin: 0 !important;
        }
			
		.owl-stage .owl-item.active:last-child {
				width: 0px !important;  /* Remove the width 0px restriction */
			}

			.owl-carousel .owl-item:empty {
				display: none !important; /* Hide empty items */
			}

    </style>';

    $output .= '</div>'; // Close the Owl Carousel

    return $output;
}

add_shortcode('dynamic_owl_carousel', 'dynamic_owl_carousel_shortcode');



function my_custom_shortcode() {
    return '<p style="font-size:17px;color:#fff;">- Xmati</p>
                    <p style="font-size:24px;color:#fff;margin-bottom:20px">Chatbots with easy deployment and unified experience.</p>
					<div id="typed-output"></div>
            <style>
                #typed-output {
                    display: inline; /* Ensures the text and cursor stay on the same line */
                    color: #fff !important;
                    font-size: 24px !important;
                }
					.typed-cursor{
						color: #fff !important;}

                /* Style the cursor if needed */
                .typed-cursor {
                    font-family: monospace; /* Make cursor font consistent */
                    font-size: 24px; /* Adjust cursor size */
                    margin-left: 2px; /* Space between cursor and text */
                    animation: blink 0.7s infinite step-end; /* Make the cursor blink */
                }

                /* Keyframe for cursor blinking */
                @keyframes blink {
                    50% { opacity: 0; }
                }

                /* Full width container for the layout */
                .full {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin: 20px 0;
                }

                /* Half-width sections inside the .full container */
                .halfwidth {
                    width: 48%; /* Ensures each section takes up 50% of the container */
                    box-sizing: border-box;
                }

                /* Style the text in the .halfwidth section */
                .halfwidth .text {
                    font-size: 24px;
                    margin-top: 10px;
                    color: #fff;
                }

                /* Optional: Style the link */
                .halfwidth a {
                    display: inline-block;
                    background-color: #0073e6;
                    color: #fff;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 5px;
                    margin-top: 20px;
                    transition: background-color 0.3s;
                }

                .halfwidth a:hover {
                    background-color: #005bb5;
                }

                /* Background styles for the block */
                .uagb-block-bd3eb68b {
                    background: url("http://xmati.ai/wp-content/uploads/2025/02/highlights_bg_V1.jpg") ;
                    /* Ensure the background image covers the container */
                    padding: 20px;
                    /* Optional rounded corners */
                    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                }

                /* Ensure proper spacing within inner blocks */
                .uagb-block-bd3eb68b .uagb-container-inner-blocks-wrap {
                    display: block !important;
                    position: relative;
                    box-sizing: border-box;
                    margin-left: auto !important;
                    margin-right: auto !important;
                }

                /* Make layout responsive for smaller screens */
                @media (max-width: 768px) {
                    .full {
                        flex-direction: column;
                    }

                    .halfwidth {
                        width: 100%;
                        margin-bottom: 20px;
                    }
					.uagb-block-bd3eb68b{
					margin-top:30px;}
					.uagb-block-bd3eb68b .uagb-container-inner-blocks-wrap{
					padding:20px !important;
					}
					.uagb-block-bd3eb68b .uagb-container-inner-blocks-wrap p,#typed-output{
					line-height:50px !important;
					}
                }
            </style>
            
            
                    
                    <div id="typed-output"></div> <!-- Typing output will be here -->
					<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
                    <script>
                        var options = {
                            strings: ["Automate Across Channels", "Seamless Integration", "Customized AI Agent", "Last-Mile Connectivity", "Maximize Cloud Investments"],
                            typeSpeed: 50,
                            backSpeed: 30,
                            backDelay: 1000,
                            startDelay: 500,
                            loop: true,
                            showCursor: true, // Make sure the cursor is enabled
                        };
                        var typed = new Typed("#typed-output", options);
                    </script>
                
                <div class="halfwidth">
                    <a href="#"> Request Demo</a>
                </div>
            ';
}
add_shortcode('typed_text', 'my_custom_shortcode');



// Disable core update emails
add_filter( 'auto_core_update_send_email', '__return_false' );
// Disable plugin update emails
add_filter( 'auto_plugin_update_send_email', '__return_false' );
// Disable theme update emails
add_filter( 'auto_theme_update_send_email', '__return_false' );

function kinsta_hide_update_nag() {
if ( ! current_user_can( 'update_core' ) ) {
remove_action( 'admin_notices', 'update_nag', 3 );
}
}

add_action('admin_menu','kinsta_hide_update_nag');


function remove_core_updates(){
        global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
    }
    add_filter('pre_site_transient_update_core','remove_core_updates');
    add_filter('pre_site_transient_update_plugins','remove_core_updates');
    add_filter('pre_site_transient_update_themes','remove_core_updates');



add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
   #wpcontent #wpbody-content .error {
            display:none !important;
        }
  </style>';
}


