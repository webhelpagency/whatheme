<?php /* Template Name: Flexible Template */ 

get_header();
?>

<div class="wrapper" id="index-wrapper">

<div class="container" id="content" tabindex="-1">

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
                    

                    // Check value exists.
                    if( have_rows('flexible_content') ):

                        // Loop through rows.
                        while ( have_rows('flexible_content') ) : the_row();

                            get_template_part( 'flex-templates/image_content' );

                        // End loop.
                        endwhile;

                    // No value.
                    else :
                        // Do something...
                    endif;
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
