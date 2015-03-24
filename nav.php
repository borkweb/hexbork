<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
<?php
wp_nav_menu( array(
	'container' => 'nav',
	'container_class' => 'menu-{menu slug}-container',
	'menu_class' => 'nav menu',
	'theme_location' => 'primary',
	'fallback_cb' => 'wp_page_menu',
) );
