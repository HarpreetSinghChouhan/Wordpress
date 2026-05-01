<?php 
/**
 * 
 *Plugin Name:Custom-Plugin
 * Description: First Plugin
 *                                                                                                                                                                                                                                                                                                                 
*/

if(!defined('ABSPATH')){
    die('invalid request.');
}
function create_book_post_type() {
    register_post_type('travel',
        array(
            'labels'      => array(
                'name'          => __('Travel'),
                'singular_name' => __('Travel'),
                // 'add_new'=>_('Add New Books'),
                'add_new_item'=> _('Add New Travel'),
                'edit_item'=> _('Edit Travel'),
                'all_items'=>_('All Travel Package'),
                'item_slug'=>_('Edit Travel Slug'),
                'menu_item'=>_('Travel  Location')
            ),
            'public'      => true,
            'has_archive' => true,
            'menu_icon'  => 'dashicons-airplane',
            'supports'    => array('title', 'editor', 'thumbnail','author','excerpt','post-formats','revisions'),
            'show_in_rest' => true, // Enables the Block Editor (Gutenberg)
        )
    );
}
add_action('init', 'create_book_post_type');

// ?>
<!-- <div>
<input type="text" name="" id="">
</div> -->