<?php 
 /**
  * Plugin Name: News Plugin
 *Description :  This plugin for Create News For Different news categories
  *Author Name: Harpreet Singh 
 */
    
  if(!defined('ABSPATH')){
    die("invalid request. ");
  };

add_action('init','create_post_type_news');
function create_post_type_news(){
    $label  = array(
        'name'=> _('News'),
        'singular_name' => _('News'),
        'add_new'=> _('Add News'),
        "search_items" => _('Search News'),
        'add_new_item' => _('Add New News'),
        'edit_item' => _('Edit News'),
        'remove_item' => _('Remove News'),
        'view_item' => _('View News'),
        'all_items' => _('All News')
        
    );
    $support = array(
        'author',
        'editor',
        'title',
        'description',
        'excerpt',
        'thumbnail',
        'post-formats'
    );
    $argument =  array(
        'labels'=>$label,
        'public' => true,
        'has_archive'=> true,
        'hierarchical' => false,
        'supports'=>$support,   
        'rewrite'=>array('slug'=>'news'),
        'menu_icon' =>'dashicons-admin-page'    
    );
    register_post_type('news',$argument);
    $labelCategory =  array(
      'name' => _x('New category','taxonomy general name'),
      'singular_name' => _x(' Category','taxonomy singular name'),
      'menu_name' => _('New Category'),
      'search_item' =>  _('Search  Category'),
      'all_items' => _(' All Categories'), 
      'edit_item' => _('Edit Category'),
      'new_item'=>_('New Category'),
      'remove_item'=> _('remove Category'),
      'view_item' => _('View Category'),
    );
    $argumentCategory = array(
        'hierarchical'=> true,
          'labels' => $labelCategory,
        'rewrite' => array(
          'slug' => 'news_main_category'  
        ),
    );
    register_taxonomy('news_main_category','news',$argumentCategory);
    register_taxonomy('location_category','news',array(
         'labels'=> array(
            'name'=> _x('Location Category','taxonomy general name'),
            'singular_name'=> _x('Location Category','taxonomy singular name'),
            'menu_name'=> _('location Category'),
            'search_items' => _('search Location'),
            'add_items'=>  _('new Location'),

         ),
         'hierarchical' => true, 
         'rewrite'=> array(
          'slug' => 'location_category',
          'hierarchical' => true
         )                  
    ));
    register_taxonomy('news_category','news',array(
         'labels'=> array(
            'name'=> _x('News Category','taxonomy general name'),
            'singular_name'=> _x('News Category','taxonomy singular name'),
            'menu_name'=> _('News category')

         ),
         'hierarchical' => true,
         'rewrite'=> array(
          'slug' => 'news_category',
          'hierarchical' => true
         )                  
    ));

}


// 2. ENQUEUE SCRIPTS (ONLY FOR ADMIN)
add_action('admin_enqueue_scripts', function($hook) {
    global $post_type;
    if ( 'news' !== $post_type ) return;

    wp_enqueue_media(); 
    wp_enqueue_script(
        'backend-save-video-js', 
        plugin_dir_url(__FILE__) . 'assets/js/backend.js', 
        array('jquery'), 
        time(), 
        true 
    );
});

// 3. META BOXES
add_action("add_meta_boxes",'add_meta_news_image_uploader');
function add_meta_news_image_uploader(){
   add_meta_box('image_field','Image Uploader','news_uploader_meta_box_dir','news','normal','high');
}
function news_uploader_meta_box_dir($post){
  return  include plugin_dir_path(__FILE__) . "meta-box/news-image-feature.php";
}

add_action("add_meta_boxes","add_meta_news_videos_uploader");
function add_meta_news_videos_uploader(){
  add_meta_box('video_field','Video Uploader','news_video_uploader_meta_box','news','normal', 'high');
}
function news_video_uploader_meta_box($post){
 return include plugin_dir_path(__FILE__) . 'meta-box/news-video-uploader.php';
}

// 4. SAVE DATA
add_action('save_post', 'my_video_repeater_save');
function my_video_repeater_save($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // Save or delete videos
    if (isset($_POST['custom_videos'])) {
        $videos = array_map('esc_url_raw', $_POST['custom_videos']);
        update_post_meta($post_id, 'custom_videos', array_filter($videos));
    } else {
        delete_post_meta($post_id, 'custom_videos'); // ✅ correct
    }

    // Save or delete images (separate block)
    if (isset($_POST['custom_images'])) {
        $images = array_map('esc_url_raw', $_POST['custom_images']);
        update_post_meta($post_id, 'custom_images', array_filter($images));
    } else {
        delete_post_meta($post_id, 'custom_images'); // ✅ correct
    }
}
add_action('wp_enqueue_scripts', 'ecs_travel_package_front_repeater_script3', 99);
function ecs_travel_package_front_repeater_script3()
{
    if (get_post_type() == 'news') {
        wp_enqueue_style('googleapis', '//fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;1,100;1,300&display=swap');
        wp_enqueue_style('cloudflare-css', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
        // wp_enqueue_style('style-css', path . 'assets/css/style.css');

        // wp_enqueue_script('script-js', path . 'assets/js/front.js', array('jquery'), '', true);
        // wp_enqueue_script('bootstrap-js',  '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '',true );
        wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array('jquery'), '', true);
        wp_enqueue_script('JS-cus-validation-v-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js');
        wp_enqueue_script('js-cus-validation-v1-script', '//cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js');
        // wp_enqueue_script('form-ajax-js', path . 'assets/js/form-single.js', ['jquery'], null, true);
        wp_enqueue_script('date-ui-js', '//code.jquery.com/ui/1.13.1/jquery-ui.js', array('jquery'), '', true);
        wp_enqueue_style('date-ui-picker-css', '//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css');

        // wp_enqueue_script('custom-script-shortcode-scriptecs', path . 'shotcode/js/script.js');
    }
    wp_enqueue_style('slider-lib-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
    wp_enqueue_script('rgb-shortcode-slider-lib-js', '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
    wp_enqueue_script('sweetalert2-shortcode-script', '//cdn.jsdelivr.net/npm/sweetalert2@11');
    // wp_enqueue_script('rgb-shortcode-slider-js', path . 'shotcode/js/script-slider.js');
    // wp_enqueue_style('custom-tempateecs-css', path . 'shotcode/css/cards-theme-ecs.css');


    $post_types = array('news');
    wp_enqueue_style('custom-single-select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css');
    wp_enqueue_script('rgb-shortcode-select2js', '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js', array('jquery'), '', true);
    if (is_singular($post_types)) {
        wp_enqueue_style('custom-single-page-rgb-bootstrap', "//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
        wp_enqueue_style('custom-single-page-rgb-font-awesome', "//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css");
        wp_enqueue_style('custom-single-page-rgb', path . 'assets/css/singlepage.css');
        wp_enqueue_script('rgb-ingle-popper', '//cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '', true);
        wp_enqueue_script('rgb-shortcode-bootstrapjs', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('jquery'), '', true);
    }
}

?>