<?php
add_action( 'widgets_init', 'register_whatheme_widgets' );
function register_whatheme_widgets(){
	register_sidebar( array(
		'name'          => sprintf(__('Footer Sidebar %d'), 1 ),
		'id'            => "footer-sidebar-1",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => "</h5>\n",
    ) );
    
    register_sidebar( array(
		'name'          => sprintf(__('Footer Sidebar %d'), 2 ),
		'id'            => "footer-sidebar-2",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => "</h5>\n",
    ) );
    
    register_sidebar( array(
		'name'          => sprintf(__('Footer Sidebar %d'), 3 ),
		'id'            => "footer-sidebar-3",
		'description'   => '',
		'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => "</div>\n",
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => "</h5>\n",
	) );
}