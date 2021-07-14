<?php

require_once WPPG_PLUGIN_PATH . 'includes/classes/class-galeria-metabox.php';
require_once WPPG_PLUGIN_PATH . 'includes/classes/class-galeria-post-type.php';
require_once WPPG_PLUGIN_PATH . 'includes/classes/class-galeria-shortcode.php';

class WPPG_Admin {

	 
    public static function init() {
        if ( is_admin() ) {
            new WPPG_Galeria_Post_Type();
            new WPPG_Galeria_Metabox();
        }
        
        new WPPG_Galeria_Shortcode();
    }

    public function load_scripts() {
       
    }

    
}