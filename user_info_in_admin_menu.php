<?php
/*
Plugin Name: User Info in Admin Menu
Plugin URI: http://yobd.github.io/YOBD-User-Info-in-Admin-Menu/
Description: Add current user info at the top of the admin menu
Version: 1.0.0
Author: YODB Digital
Author URI: http://yobd.github.io/YOBD-User-Info-in-Admin-Menu/
License: GPL3
*/

/*
Copyright 2015 YODB Digital
 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 3, as
published by the Free Software Foundation.
 
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Register style sheet.

function yobd_user_admin_menu_info_plugin_styles() {
	wp_register_style( 'user-info-in-admin-menu', plugins_url( 'assets/css/user_info_in_admin_menu_style.css' ) );
	wp_enqueue_style( 'user-info-in-admin-menu' );
}

add_action( 'wp_enqueue_scripts', 'yobd_user_admin_menu_info_plugin_styles' );


// Do your thing

function yobd_user_admin_menu_info() {

	global $current_user;

	get_currentuserinfo();

	echo '<link rel="stylesheet" href="' . plugins_url( 'assets/css/user_info_in_admin_menu_style.css', __FILE__ ) . '" > ';

    ?>
    <script type="text/javascript">
        jQuery( document ).ready( function() {
            jQuery( '#adminmenuwrap' ).prepend( '<?php 
            	echo '<div class="admin_user_menu_info_wrap"><ul>';
            		echo '<li>';
	            		echo '<a href="' . get_edit_user_link() . '">'; 
	            			//echo '<img class="admin_user_menu_info_av" src="' . plugins_url( 'assets/blank.jpg', __FILE__ ) . '">';
	            			echo addslashes( get_avatar( $current_user->ID, 120, '', '', array ('class' => 'admin_user_menu_info_av','force_display' => 'true') ) );
	            		echo '</a>';
	            	echo '</li>';

	            	echo '<li>';
	            		echo '<a href="' . get_edit_user_link() . '">'; 
	            			echo '<p class="admin_user_menu_info_text admin_user_menu_info_name">';
	            				echo 'Howdy, ' . $current_user->user_login . '';
	            			echo '</p>';
	            		echo '</a>';
	            	echo '</li>';

	            	echo '<li>';
	            		echo '<p class="admin_user_menu_info_text admin_user_menu_info_logout">'; 
	            			echo '<a href="' . get_edit_user_link() . '">Edit Profile</a>';
	            			echo ' · ';
	            			echo '<a href="' . wp_logout_url() . '">Logout</a>';
	            		echo '</p>';
	            	echo '</li>';

            	echo '</ul></div>';
            ?>');
        });
    </script>
    <?php

}


	add_action( 'admin_footer', 'yobd_user_admin_menu_info' );


?>