<?php
/*
Plugin Name: Retina Image Support
Plugin URI: http://www.tripleginteractive.com/blog/retina-image-support/
Description: This plugin lets you serve retina images to retina devices easily.
Version: 1.1
Author: Gregg Henry
Author URI: http://www.tripleginteractive.com
Author Email: gregg@tripleginteractive.com
License:

  Copyright 2013 gregghenry (gregg@tripleginteractive.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as 
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
  
  **
     This plugin is based on Shaun Inman's Automatic Conditional Retina Images
     http://shauninman.com/tmp/retina/ 
  **
  
*/

class RetinaImageSupport {

	/*--------------------------------------------*
	 * Constants
	 *--------------------------------------------*/
	const name = 'Retina Image Support';
	const slug = 'retina_image_support';
	
	/**
	 * Constructor
	 */
	function __construct() {
		//register an activation hook for the plugin
		register_activation_hook( __FILE__, array( &$this, 'install_retina_image_support' ) );

		//register an deactivation/unistall hook 
		register_deactivation_hook( __FILE__, array( 'RetinaImageSupport',  'remove_retina_rules' ) );
		register_uninstall_hook(__FILE__,  array( 'RetinaImageSupport', 'remove_retina_rules') );

		//Hook up to the init action
		add_action( 'init', array( &$this, 'init_retina_image_support' ) );
	}
  
	/**
	 * Runs when the plugin is activated
	 */  
	function install_retina_image_support() {
		global $wp_rewrite;
		$proxy = plugin_dir_path(__FILE__) . 'retina-image-support.php';
        $home_path = trailingslashit( get_home_path() );
        if ((!file_exists($home_path . '.htaccess') && is_writable($home_path)) || is_writable($home_path . '.htaccess')) {
		    $rule = "<IfModule mod_rewrite.c>\n";
			$rule .= "Options -MultiViews\n";
		    $rule .= "RewriteEngine On\n";
			$rule .= "RewriteCond %{HTTP_COOKIE} HTTP_IS_RETINA [NC]\n";
			$rule .= "RewriteCond %{REQUEST_FILENAME} !@2x\n";
			$rule .= "RewriteRule ^(.*)\.(gif|jpg|png)$ $1@2x.$2\n";
			$rule .= "# if @2x isn't available fulfill the original request\n";
			$rule .= "RewriteCond %{REQUEST_FILENAME} !-f\n";
			$rule .= "RewriteRule ^(.*)@2x\.(gif|jpg|png)$ $1.$2\n";
		    $rule .= "</IfModule>\n";
            insert_with_markers( $home_path.'.htaccess', 'RETINA_IMAGE_SUPPORT', explode( "\n", $rule ) );
        }
        $wp_rewrite->flush_rules();
	}
  
	/**
	 * Runs when the plugin is initialized
	 */
	function init_retina_image_support() {
		if ( is_admin() ) {
			//this will run when in the WordPress admin
		} else {
			//this will run when on the frontend
			add_action('wp_head', array( $this, 'add_to_head')); 
		}
	}
  	
	function add_to_head() {
		echo "<script>if((window.devicePixelRatio===undefined?1:window.devicePixelRatio)>1)
	document.cookie='HTTP_IS_RETINA=1;path=/';</script>";
	}
	
	function remove_retina_rules()
	{
		global $wp_rewrite;
		$home_path = trailingslashit( get_home_path() );
		insert_with_markers($home_path.'.htaccess', 'RETINA_IMAGE_SUPPORT', array() );
		$wp_rewrite->flush_rules();
	}
  
} // end class
new RetinaImageSupport();

?>