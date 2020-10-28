<?php
/**
 * The main template file
 */

get_header();
?>

<div class="wrapper" id="index-wrapper">

<div class="container" id="content" tabindex="-1">

		<!-- Do the left sidebar check and opens the primary div -->
		<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

		<main class="site-main" id="main">

			<?php
			if ( have_posts() ) {
				// Start the Loop.
				while ( have_posts() ) {
					the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'loop-templates/content', get_post_format() );
				}
			} else {
				get_template_part( 'loop-templates/content', 'none' );
			}
			?>

		</main><!-- #main -->

		<!-- The pagination component -->
		<?php whatheme_pagination(); ?>

</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
