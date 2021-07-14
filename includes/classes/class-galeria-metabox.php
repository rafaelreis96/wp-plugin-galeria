<?php

class WPPG_Galeria_Metabox {
    const BOX_TITLE = "Galeria de Fotos";
    const POSTS_TYPES = array('wppg_galeria');
    
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'register'));
        add_action('save_post', array($this, 'save_post_data'));
        add_action('admin_enqueue_scripts', array($this, 'load_styles') );
        add_action('admin_enqueue_scripts', array($this, 'load_scripts') );  

        //Add a callback to regiser our tinymce plugin   
        add_filter("mce_external_plugins", array($this, 'register_tinymce_plugin')); 

        // Add a callback to add our button to the TinyMCE toolbar
        add_filter('mce_buttons', array($this, 'add_tinymce_button')); 

        add_thickbox();
    }
    
    public function load_styles() {
        wp_enqueue_style( 'wppg-metabox', WPPG_PLUGIN_URL . 'admin/css/wppg-metabox.css' );
        wp_enqueue_style( 'wppg-galeria', WPPG_PLUGIN_URL . 'public/css/wppg-galeria.css' );
    }
    
    public function load_scripts() {
        //wp_enqueue_script('wppg-metabox', WPPG_PLUGIN_URL . 'admin/js/wppg-metabox.js', array ( 'jquery' ), '', true);
      //  wp_enqueue_script('wppg-button-tinymce', WPPG_PLUGIN_URL . 'admin/js/wppg-tinymce.js', array ( 'jquery' ), '', true);

    }

    //This callback registers our plug-in
    public function register_tinymce_plugin($plugin_array) {
        $plugin_array['wppg_button'] =  WPPG_PLUGIN_URL . 'admin/js/wppg-tinymce.js';
        return $plugin_array;
    }

    //This callback adds our button to the toolbar
    public function add_tinymce_button($buttons) {
                //Add the button ID to the $button array
        $buttons[] = "wppg_button";
        return $buttons;
    }
    
    public function register() {
        foreach (self::POSTS_TYPES as $postType ) {
            add_meta_box(
                'wppg_galeria_box_id',          // Unique ID
                self::BOX_TITLE, // Box title
                array($this, 'template'), // Content callback, must be of type callable
                $postType         // Post type
            );
        }
    }
    
    public function save_post_data(int $post_id) {
        if (array_key_exists('wppg_content', $_POST)) {
            $content = sanitize_text_field($_POST['wppg_content']);
            $images  = sanitize_text_field($_POST['wppg_images']);
            
            update_post_meta($post_id, '_wppg_content', $content);
            update_post_meta($post_id, '_wppg_images', $images);
        }
    }
    
    public static function get_content(int $post_id) {
        return get_post_meta($post_id, '_wppg_content', true);
    }
    
    public static function get_images_ids(int $post_id) {
        $images = get_post_meta($post_id, '_wppg_images', true);
        return !empty($images) ? explode(',', $images) : [];
    }

    public function template($post) {
        require_once WPPG_PLUGIN_PATH . 'admin/templates/galeria-metabox.php';
    }

}