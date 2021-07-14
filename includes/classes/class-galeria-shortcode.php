<?php

require_once 'class-galeria-metabox.php';

class WPPG_Galeria_Shortcode {
    
    public function __construct() {
        add_action('init', array($this, 'init_shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'load_styles') );
       // add_action('wp_enqueue_scripts', array($this, 'load_scripts') );
    }
    
    public function load_styles() {
        wp_enqueue_style('wppg-galeria', WPPG_PLUGIN_URL . 'public/css/wppg-galeria.css' );
    }
    
    public function load_scripts() {
        
    }
    
    public function init_shortcode() {
        add_shortcode('wppg-galeria', array($this, 'template'));
    }
    
    public function template($atts = [], $content = null, $tag = '') {
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );
        
        if(!isset($atts['id']) && !is_int($atts['id'])) {
            return '';
        }
        
        $arrayIds = WPPG_Galeria_Metabox::get_images_ids($atts['id']);
            
        $html = '';
        $html .= '<div class="wppg-grid-img">';
      
            if(count($arrayIds) > 0) {
                foreach ($arrayIds as $id) {
                    $html .= '<div id="'.$id .'" class="col">';
                    $html .= wp_get_attachment_image($id, array(250, 180));
                    $html .= '</div>';
                }
            }
            
            if ( ! is_null( $content ) ) {
                // secure output by executing the_content filter hook on $content
                $html .= apply_filters( 'the_content', $content );

                // run shortcode parser recursively
                $html .= do_shortcode( $content );
            }
    
        $html .= '</div>';
        
        return $html;
    }
    
    
}