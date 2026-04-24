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
    register_post_type('book',
        array(
            'labels'      => array(
                'name'          => __('Books'),
                'singular_name' => __('Book'),
                // 'add_new'=>_('Add New Books'),
                'add_new_item'=> _('Add New Book'),
                'edit_item'=> _('Edit Book'),
                'all_items'=>_('All Books '),
                'Utem_slug'=>_('Edit Book Slug'),
            ),
            'public'      => true,
            'has_archive' => true,
            'supports'    => array('title', 'editor', 'thumbnail'),
            'show_in_rest' => true, // Enables the Block Editor (Gutenberg)
        )
    );
}
add_action('init', 'create_book_post_type');

// ?>