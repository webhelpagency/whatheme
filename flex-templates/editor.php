<?php
if( get_row_layout() == 'widsiwyg_editor' ):
    $editor = get_sub_field('widsiwyg_editor');
?>
<section class="section-wysiwyg-editor">
        <?php
            if( $editor ) {
                echo $editor;
            }   
        ?>
</section>
<?php
endif;