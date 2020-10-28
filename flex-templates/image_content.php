<?php
if( get_row_layout() == 'image__content' ):
    $image = get_sub_field('image');
    $content = get_sub_field('content');
    $reverse_desktop = get_sub_field('reverse_desktop');
    $reverse_mobile = get_sub_field('reverse_mobile');
    $attributes = get_sub_field('attributes');

    if ($reverse_desktop) 
    {$classes_desktop_cont = 'order-md-1'; $classes_desktop_img = 'order-md-2';} 
    else 
    {$classes_desktop_cont = 'order-md-2'; $classes_desktop_img = 'order-md-1';}

    if ($reverse_mobile) 
    {$classes_mob_img = 'order-2'; $classes_mob_cont = 'order-1';} 
    else 
    {$classes_mob_img = 'order-1'; $classes_mob_cont = 'order-2';}
?>
<section class="img-left-content-right">
    <div class="row <?php if ($attributes) echo $attributes; ?>">
        <?php
            if( $image ) {
                echo '<div class="col-12 col-md-6 ' . $classes_mob_img . ' ' . $classes_desktop_img . '">';
                echo wp_get_attachment_image( $image["ID"]  , 'full' );
                echo '</div>';
            }
        ?>
        <?php
            if( $content ) {
                echo '<div class="col-12 col-md-6 ' . $classes_mob_cont . ' ' . $classes_desktop_cont . '">' . $content . '</div>';
            }   
        ?>
    </div>
</section>
<?php
endif;