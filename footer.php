<?php

/**
 * The template for displaying the footer
 */

?>
</div><!-- #page -->
<footer class="pt-4 my-md-5 pt-md-5 border-top">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md">
                <!-- Your site title as branding in the menu -->
                <?php if (!has_custom_logo()) { ?>

                    <?php if (is_front_page() && is_home()) : ?>

                        <h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a></h1>

                    <?php else : ?>

                        <a class="navbar-brand" rel="home" href="<?php echo esc_url(home_url('/')); ?>" itemprop="url"><?php bloginfo('name'); ?></a>

                    <?php endif; ?>

                <?php
                } else {
                    the_custom_logo();
                }
                ?>
        
            </div>
            <?php
            if ( function_exists('dynamic_sidebar') & is_active_sidebar('footer-sidebar-1') ) :
                echo '<div class="col-6 col-md">';
                    dynamic_sidebar('footer-sidebar-1');
                echo '</div>';
            endif;
            ?>
            <?php
            if ( function_exists('dynamic_sidebar') & is_active_sidebar('footer-sidebar-2') ) :
                echo '<div class="col-6 col-md">';
                    dynamic_sidebar('footer-sidebar-2');
                echo '</div>';
            endif;
            ?>
            <?php
            if ( function_exists('dynamic_sidebar') & is_active_sidebar('footer-sidebar-3') ) :
                echo '<div class="col-6 col-md">';
                    dynamic_sidebar('footer-sidebar-3');
                echo '</div>';
            endif;
            ?>
            </div>
        </div>
    </div>
    <div class="bg-light py-3">
        <div class="container">
            <span class="text-muted"><small class="d-block text-muted">&copy; <?php echo date('Y'); ?></small></span>
        </div>
    </div>
</footer>


<?php wp_footer(); ?>

</body>

</html>