<?php

require_once 'class-galeria-metabox.php';

class WPPG_Galeria_Post_Type {
    const POST_TYPE = 'wppg_galeria';

    public function __construct() {
        add_action('init', array($this, 'register'));
        
        add_filter('manage_wppg_galeria_posts_columns', function($columns) {
            return array_merge(array('thumbnail' => __('Thumbnail', 'wppg')), $columns);
        });

        add_action('manage_wppg_galeria_posts_custom_column', function($column , $post_id) {
            if ($column == 'thumbnail') {
                
                $ids = WPPG_Galeria_Metabox::get_images_ids($post_id);
                
                if(isset($ids[0])) {
                    echo wp_get_attachment_image($ids[0], array(60, 60));
                }
            }
        }, 10, 2);
 
    }
    
    public function register() {
        register_post_type(self::POST_TYPE,
            array(
                'labels'      => array(
                    'name'          => __('Galerias', 'wppg'),
                    'singular_name' => __('Galeria', 'wppg'),
                ),
                'public'      => true,
                'has_archive' => true,
                'supports'    => array('title','thumbnail'),
                'menu_icon'   => 'dashicons-format-gallery',
                'rewrite'     => array( 'slug' => 'galerias' ), 
            )
        );
    }
    
}