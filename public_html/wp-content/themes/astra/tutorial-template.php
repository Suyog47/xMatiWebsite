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
