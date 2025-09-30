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
