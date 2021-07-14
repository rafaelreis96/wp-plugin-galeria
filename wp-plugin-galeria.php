<?php
if(!defined( 'ABSPATH' )) exit;
/*
 * Plugin Name: Wp Plugin Galeria
 * Plugin URI: https://github.com/Rafael-Reis/rr-plugin-galeria
 * Description: Plugin de Galeira para Wordpress.
 * Version:     1.0
 * Author:      rafaelreis.eti.br
 * Author URI:  http://rafaelreis.dev
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: wppg
*/

/*
 * contants do plugin
 */
define('WPPG_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('WPPG_PLUGIN_URL', plugin_dir_url(__FILE__));



require WPPG_PLUGIN_PATH . 'admin/wppg-admin.php';

WPPG_Admin::init();

/**
 * Install
 */
//require WPPG_PLUGIN_PATH . 'install.php';
//register_activation_hook( __FILE__, array(new Install(), 'activate') );

 