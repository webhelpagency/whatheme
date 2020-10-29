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
			
					woocommerce_content();
				
			?>

		</main><!-- #main -->

		<!-- The pagination component -->
		<?php whatheme_pagination(); ?>

</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
