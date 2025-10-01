#!/bin/bash

# This script adds the Tutorial page and menu item to your WordPress site on Digital Ocean
# Run this script on your Digital Ocean server

# Configuration - CHANGE THESE VALUES TO MATCH YOUR SERVER SETUP
DB_USER="xmati_wp"
DB_PASSWORD="xMati@123"
DB_NAME="u264173018_a4PzX"
WP_PATH="/var/www/html"  # Adjust this to your WordPress installation path

# SQL file to add tutorial data
SQL_FILE="/tmp/add-tutorial.sql"

# Create SQL file
cat > $SQL_FILE << 'EOF'
-- Create the Tutorial page
INSERT INTO wp_posts (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count) 
VALUES (1, NOW(), NOW(), '<p>Welcome to the Tutorial page. This is a dummy screen for the Tutorial menu item.</p>', 'Tutorial', '', 'publish', 'closed', 'closed', '', 'tutorial', '', '', NOW(), NOW(), '', 0, 'http://xmati.ai/?page_id=1973', 0, 'page', '', 0);

-- Get the ID of the newly created page
SET @tutorial_page_id = LAST_INSERT_ID();

-- Assign the template to the page
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) 
VALUES (@tutorial_page_id, '_wp_page_template', 'tutorial-template.php');

-- Create the Tutorial menu item 
INSERT INTO wp_posts (post_title, post_name, post_content, post_excerpt, post_type, post_status, menu_order, post_date, post_date_gmt, post_modified, post_modified_gmt, post_author, comment_status, ping_status, guid)
VALUES ('Tutorial', 'tutorial', '', '', 'nav_menu_item', 'publish', 1, NOW(), NOW(), NOW(), NOW(), 1, 'closed', 'closed', 'http://xmati.ai/?p=2000');

-- Get the ID of the newly created menu item
SET @tutorial_menu_id = LAST_INSERT_ID();

-- Link the menu item to the Primary Menu (assuming term_taxonomy_id = 2 for the Primary Menu)
INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) 
VALUES (@tutorial_menu_id, 2, 0);

-- Set menu item metadata to link to the page
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) 
VALUES 
(@tutorial_menu_id, '_menu_item_type', 'post_type'),
(@tutorial_menu_id, '_menu_item_object', 'page'),
(@tutorial_menu_id, '_menu_item_object_id', @tutorial_page_id),
(@tutorial_menu_id, '_menu_item_url', '');

-- Update Login menu item to be last
UPDATE wp_posts SET menu_order = 6 WHERE post_name = 'login' AND post_type = 'nav_menu_item';
EOF

# Import SQL
mysql -u$DB_USER -p$DB_PASSWORD $DB_NAME < $SQL_FILE
if [ $? -eq 0 ]; then
  echo "✅ Tutorial page and menu item added successfully to the database"
else
  echo "❌ Failed to add Tutorial page and menu item to the database"
  exit 1
fi

# Create template file
THEME_PATH="$WP_PATH/wp-content/themes/astra"
mkdir -p "$THEME_PATH/assets/css"

# Create tutorial template file
cat > "$THEME_PATH/tutorial-template.php" << 'EOF'
<?php
/**
 * Template Name: Tutorial Template
 *
 * The template for displaying the Tutorial page
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" class="content-area primary">

	<main id="main" class="site-main">
		<article class="tutorial-content">
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>

			<div class="entry-content">
				<div class="tutorial-welcome">
					<h2>Welcome to the Tutorial Section</h2>
					<p>This is a dummy screen for the Tutorial menu item. You can customize this page with your tutorial content.</p>
				</div>

				<div class="tutorial-steps">
					<h3>Sample Tutorial Steps</h3>
					<ol>
						<li>
							<h4>Step 1: Getting Started</h4>
							<p>This is the first step in your tutorial.</p>
						</li>
						<li>
							<h4>Step 2: Understanding the Basics</h4>
							<p>This is the second step in your tutorial.</p>
						</li>
						<li>
							<h4>Step 3: Advanced Techniques</h4>
							<p>This is the third step in your tutorial.</p>
						</li>
					</ol>
				</div>

				<div class="tutorial-resources">
					<h3>Additional Resources</h3>
					<ul>
						<li><a href="#">Resource Link 1</a></li>
						<li><a href="#">Resource Link 2</a></li>
						<li><a href="#">Resource Link 3</a></li>
					</ul>
				</div>
			</div>
		</article>
	</main><!-- #main -->

</div><!-- #primary -->

<?php get_footer(); ?>
EOF

# Create CSS file
cat > "$THEME_PATH/assets/css/tutorial-custom.css" << 'EOF'
.tutorial-content {
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.tutorial-welcome, .tutorial-steps, .tutorial-resources {
    margin-bottom: 40px;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.tutorial-steps ol {
    padding-left: 20px;
}

.tutorial-steps li {
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.tutorial-steps li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.tutorial-resources ul {
    list-style-type: none;
    padding: 0;
}

.tutorial-resources li {
    margin-bottom: 10px;
}

.tutorial-resources a {
    color: #0073aa;
    text-decoration: none;
}

.tutorial-resources a:hover {
    text-decoration: underline;
}
EOF

# Update functions.php
grep -q "astra_tutorial_custom_styles" "$THEME_PATH/functions.php"
if [ $? -ne 0 ]; then
  # Function doesn't exist, add it
  cat >> "$THEME_PATH/functions.php" << 'EOF'

/**
 * Enqueue custom styles for the Tutorial template
 */
function astra_tutorial_custom_styles() {
    if (is_page_template('tutorial-template.php')) {
        wp_enqueue_style('astra-tutorial-style', get_template_directory_uri() . '/assets/css/tutorial-custom.css', array(), ASTRA_THEME_VERSION);
    }
}
add_action('wp_enqueue_scripts', 'astra_tutorial_custom_styles');
EOF
  echo "✅ Added custom styles enqueue function to functions.php"
else
  echo "ℹ️ Custom styles enqueue function already exists in functions.php"
fi

# Set correct permissions
chown -R www-data:www-data "$THEME_PATH/tutorial-template.php" "$THEME_PATH/assets/css/tutorial-custom.css"
chmod 644 "$THEME_PATH/tutorial-template.php" "$THEME_PATH/assets/css/tutorial-custom.css"

echo "✅ All done! Tutorial page and template files have been added."
echo "🌐 Visit your website and check the Tutorial menu item."

# Clean up
rm $SQL_FILE
