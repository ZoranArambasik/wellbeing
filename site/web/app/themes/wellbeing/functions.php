<?php


// add_action( 'transition_post_status', 'send_mails_on_publish', 10, 3 );

// function send_mails_on_publish( $new_status, $old_status, $post )
// {
//     if ( 'publish' !== $new_status or 'publish' === $old_status
//         or 'company' !== get_post_type( $post ) )
//         return;
//     $author   = get_userdata($post->post_author);
//     $subscribers = get_users( array ( 'role' => 'subscriber' ) );
//     $emails      = array ();

//     foreach ( $subscribers as $subscriber )
//         $emails[] = $subscriber->user_email;

//     $body = sprintf( 'Hey there is a new entry!
//         See <%s>',
//         get_permalink( $post )
//     );


//     wp_mail( $author, 'New entry!', $body );
// }


// do_action('wpml_register_single_string', 'Wellbeing', '', 'Main Header Image');
// do_action('wpml_register_single_string', 'Wellbeing', 'l-i', 'Low impact');
// do_action('wpml_register_single_string', 'Wellbeing', 'm-i', 'Medium impact');


add_action('init', function(){
    if (!is_admin()) {
        foreach (acf_get_field_groups() as $group) {
            $fields = acf_get_fields($group['ID']);
            if (is_array($fields) && count($fields)) {
                foreach ($fields as $field) {
                    do_action('wpml_register_single_string', 'ACF Labels', $field['label'], $field['label']);
                    do_action('wpml_register_single_string', 'ACF Messages', $field['message'], $field['message']);
                    do_action('wpml_register_single_string', 'ACF Instructions', $field['instructions'], $field['instructions']);
                }
            }
        }
    }
});

add_filter('acf/load_field', function (array $field) {
    $field['label'] = apply_filters('wpml_translate_single_string', $field['label'], 'ACF Labels', $field['label']);
    $field['message'] = apply_filters('wpml_translate_single_string', $field['message'], 'ACF Messages', $field['message']);
    $field['instructions'] = apply_filters('wpml_translate_single_string', $field['instructions'], 'ACF Instructions', $field['instructions']);
    return $field;
});

add_action( 'admin_init', 'disable_autosave' );
function disable_autosave() {
    wp_deregister_script( 'autosave' );
}

function wpse23007_redirect(){
  if( is_admin() && !defined('DOING_AJAX') && ( current_user_can('um_company-en')) ) {
    wp_redirect(home_url());
    exit;
  }
}
add_action('init','wpse23007_redirect');


function example_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );

add_filter('frm_email_message', 'add_email_header', 10, 2);
function add_email_header($message, $atts) {
 //edit the email header image source to include an image URL of your choice
 $email_header = '<div style="text-align:center; margin-bottom:20px;"><img src="' . get_bloginfo('url') . '/app/uploads/2021/12/logo-footer.png" alt="Header" /></div>';
 $message = $email_header . $message;
 return $message;
}
/*Detect which language we are on in a evaluation form*/
add_shortcode( 'current_wpml_lang', 'current_wpml_lang' );
function current_wpml_lang() {
  return apply_filters( 'wpml_current_language', null );
}


/*Detect post status*/
add_shortcode( 'current_post_status', 'current_post_status' );
function current_post_status() {
    global $post;
    return get_post_status($post->ID);
}

add_filter( 'comments_open', 'my_comments_open', 10, 2 );

function my_comments_open( $open, $post_id ) {

  $post = get_post( $post_id );

  if ( 'company' == $post->post_type )
      $open = true;

  return $open;
}


add_filter('comment_form_default_fields', 'website_remove');
function website_remove($fields)
{
if(isset($fields['url']))
    unset($fields['url']);
    return $fields;
}


// if (current_user_can('um_company-en')) {
//     add_filter('acf/validate_value/name=google_map', 'my_acf_validate_value', 10, 4);
// }
add_filter( 'frm_quiz_is_correct', 'frm_quiz_is_correct', 10, 2 );
function frm_quiz_is_correct( $is_correct, $args ) { 

    if ($args['value'] === '1' || $args['value'] === 'not-relevant') {
        $is_correct = true;
    }



    return $is_correct;
}
function spaceless_substr($string, $start, $count) {
    return substr($string, $start, ($count+substr_count($string, ' ', $start, $count)));
}
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
  wp_enqueue_style( 'dashicons' );
}
/**
* Customize the Favorites Listing HTML
*/
add_filter( 'favorites/list/listing/html', 'custom_favorites_listing_html', 10, 4 );

function custom_favorites_listing_html($html, $markup_template, $post_id, $list_options)
{

    $html ='';
    $location = get_field('google_map', $post_id);
    $small_description = get_field('small_description_home_page', $post_id);
    if( get_field('add_icon_or_default', $post_id) ){
        $marker_icon = get_field('add_icon_or_default', $post_id);                      
    } else {
        $marker_icon = '/app/themes/wellbeing/images/marker-medium.png';
    }
    $html .= '<div class="favoutrite-single-item">';
        $html .= '<div class="marker marker-fav" data-lat="' . esc_attr($location["lat"]) . '" data-lng="' . esc_attr($location["lng"]) .'" data-title="' . get_the_title($post_id) . '" data-icon="' . $marker_icon .'">';
            $html .= '<a href="' . get_the_permalink($post_id) . '">';
                $html .= '<div class="fav-sidebar">';
                    $html .= get_the_post_thumbnail($post_id);
                    $html .= get_favorites_button($post_id);
                $html .= '</div>';
                $html .= '<div class="fav-sidebar-text">';
                    $html .= '<div class="fav-title">' . get_the_title($post_id) . '</div>';
                    $html .= '<div class="fav-title">' . get_the_content($post_id) . '</div>';
                    $html .= '<div class="fav-address">' . $location['address'] . '</div>';
                 $html .=  '</div>';
                 $html .=  '<span class="pink-arrow lnr lnr-chevron-right"></span>';
            $html .= '</a>';   
        $html .=  '</div>';
    $html .=  '</div>';
    return $html;
}

function my_acf_google_map_api( $api ){
    $api['key'] = 'xxx';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
function register_acf_block_types() {
    acf_register_block_type(array(
        'name'              => 'about-us-members',
        'title'             => __('About us Members Section'),
        'description'       => __('A custom members block.'),
        'render_template'   =>  'template-parts/gutenberg-blocks/about-us-members.php',
        'category'          => '',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'about-us-members', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'slider-top',
        'title'             => __('Top Slider'),
        'description'       => __('A custom Slider block.'),
        'render_template'   =>  'template-parts/gutenberg-blocks/top-slider.php',
        'category'          => '',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'slider-top', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'places-taxonomy',
        'title'             => __('Display places Category'),
        'description'       => __('Display places Category'),
        'render_template'   =>  'template-parts/gutenberg-blocks/places-taxonomy.php',
        'category'          => 'places-taxonomy-block',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'places-taxonomy', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'wellbeing-section-home-page',
        'title'             => __('Display Wellbeing Home Page Section'),
        'description'       => __('Display Wellbeing Home Page Section'),
        'render_template'   =>  'template-parts/gutenberg-blocks/wellbeing-section-home-page.php',
        'category'          => 'wellbeing-section-home-page-block',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'wellbeing-section-home-page', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'page-slider',
        'title'             => __('Display Page Slider'),
        'description'       => __('Display Page Slider'),
        'render_template'   =>  'template-parts/gutenberg-blocks/page-slider.php',
        'category'          => 'page-slider-block',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'page-slider', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'download-pdf-image-text',
        'title'             => __('Image, Text Download File button'),
        'description'       => __('Image, Text Download File button'),
        'render_template'   =>  'template-parts/gutenberg-blocks/download-pdf-image-text.php',
        'category'          => 'download-pdf-image-text-block',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'download-pdf-image-text', 'quote' ),
    ));
    acf_register_block_type(array(
        'name'              => 'accordion-custom',
        'title'             => __('Accordion Custom'),
        'description'       => __('Text on click dropdown'),
        'render_template'   =>  'template-parts/gutenberg-blocks/accordion-custom.php',
        'category'          => 'accordion-custom-block',
        'icon'              => 'admin-comments',
        'keywords'          => array( 'accordion-custom', 'quote' ),
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}


function bootstrapstarter_wp_setup() {
    add_theme_support( 'title-tag' );
}
 
add_action( 'after_setup_theme', 'bootstrapstarter_wp_setup' );
// Register Custom Post Type

add_action('admin_head', 'block_editor_full_width');

function block_editor_full_width() {
    include( get_template_directory() . '/template-parts/gutenberg-blocks/gutenberg-styles.php' );
}
register_nav_menus( array(
	'primary' => __( 'Primary Navigation', '' )
) );

function theme_name_setup() {
    add_theme_support( 'align-wide' );
}
add_action( 'after_setup_theme', 'theme_name_setup' );

function bootstrapstarter_enqueue_styles() {
    wp_enqueue_style('linearicons', get_template_directory_uri() . '/bootstrap/css/linearicons.css' );
    wp_register_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/releases/v5.4.2/css/all.css' );
    $dependencies = array('bootstrap');
    wp_enqueue_style( 'bootstrapstarter-style', get_stylesheet_uri(), $dependencies ); 
}
function bootstrapstarter_enqueue_scripts() {
    $dependencies = array('jquery');
    wp_enqueue_script('bootstrap', get_template_directory_uri().'/bootstrap/js/bootstrap.min.js', $dependencies, '4.4.1', true );
}
function theme_name_script_enqueue() {
    wp_enqueue_style( 'slick','https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
    wp_enqueue_script( 'slickjs', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery') );
    wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/custom-style.css', array(), '1.0', 'all');
    wp_enqueue_script('customjs', get_template_directory_uri() . '/js/custom.js', array(), '1.0', true);
    if (is_front_page()) {
        wp_enqueue_script('customcookies', get_template_directory_uri() . '/js/cookies.js', array(), '2.0', true);
    }
    if (is_singular(array('places', 'company', 'trails'))) {
        wp_enqueue_script( 'sharefb', 'https://connect.facebook.net/en_US/sdk.js#version=v3.2&appId=306570680974291&xfbml=true&autoLogAppEvents=true', array('jquery') );
    }
}
function google_map_addon_scripts() {
    if (is_singular(array('places', 'company', 'route', 'trails')) || is_page('discover-places')) {
        wp_enqueue_script('markerclaster', get_template_directory_uri() . '/js/gmaps-markerclaster.js', array(), '1.0', true);
        wp_enqueue_script('markerlabelmin', get_template_directory_uri() . '/js/gmaps-markerwithlabel-1.9.1.min.js', array(), '1.0', true);
    }
}


add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'bootstrapstarter_enqueue_scripts' );
add_action( 'wp_enqueue_scripts', 'theme_name_script_enqueue' );
add_action( 'wp_enqueue_scripts', 'google_map_addon_scripts' );

add_action('init', 'my_custom_init');

function my_custom_init() {
  add_post_type_support( 'page', 'excerpt' );
}

function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}
 
function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}

add_theme_support( 'post-thumbnails' );

add_image_size( 'single_head_images', 1290, 540, true );
add_image_size( 'single_smaller_images', 720, 250, true );
add_image_size( 'home_page_thumb_route', 700, 500, true );
add_image_size( 'route_head_image', 1920, 700, true );
add_image_size( 'route_single_place_images', 900, 350, true );
register_sidebar( array(
        'id'          => 'website-logo',
        'name'        => 'Header Logo',
        'before_widget' => '<div class="website-logo">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'sign-up-section',
        'name'        => 'Sign Up Section Text',
        'before_widget' => '<div class="sign-up-section">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'head-menu',
        'name'        => 'Head menu',
        'before_widget' => '<div class="head-menu top-menu">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'footer-menu',
        'name'        => 'Footer menu 1',
        'before_widget' => '<div class="footer-menu">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'footer-logo',
        'name'        => 'Footer Logo',
        'before_widget' => '<div class="footer-logo">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'footer-menu-two',
        'name'        => 'Footer menu 2',
        'before_widget' => '<div class="footer-menu">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'footer-menu-three',
        'name'        => 'Footer menu 3',
        'before_widget' => '<div class="footer-menu">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'sb-well-image',
        'name'        => 'SB Well Logo',
        'before_widget' => '<div class="sb-well-image">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'footer-europe-image',
        'name'        => 'Footer EU image',
        'before_widget' => '<div class="footer-europe-image">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'footer-image-right',
        'name'        => 'Linnaeus Image',
        'before_widget' => '<div class="footer-image-right">',
        'after_widget' => '</div>',
    ) );
register_sidebar( array(
        'id'          => 'kontakt-info',
        'name'        => 'Kontakt Info',
        'before_widget' => '<div class="kontakt-info">',
        'after_widget' => '</div>',
    ) );


function my_register_additional_customizer_settings( $wp_customize ) { 

    $wp_customize->add_section('socialInfo' , array(
        'title' => 'Social Links',
        'description' => 'Social links'
    ));
      // Instagram
    $wp_customize->add_setting(
        'Instagram',
        array(
            'default' => '',
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options'
        )
    );
    
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'Instagram',
        array(
            'label'      => __( 'Instagram', 'textdomain' ),
            'description' => __( '', 'textdomain' ),
            'settings'   => 'Instagram',
            'priority'   => 10,
            'section'    => 'socialInfo',
            'type'       => 'text',
        )
    ) );
    // Facebook
    $wp_customize->add_setting(
        'Facebook',
        array(
            'default' => '',
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options'
        )
    );
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'Facebook',
        array(
            'label'      => __( 'Facebook link', 'textdomain' ),
            'description' => __( '', 'textdomain' ),
            'settings'   => 'Facebook',
            'priority'   => 10,
            'section'    => 'socialInfo',
            'type'       => 'text',
        )
    ) );
    // Pinterest
    $wp_customize->add_setting(
        'Pinterest',
        array(
            'default' => '',
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options'
        )
    );
    
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'Pinterest',
        array(
            'label'      => __( 'Pinterest', 'textdomain' ),
            'description' => __( '', 'textdomain' ),
            'settings'   => 'Pinterest',
            'priority'   => 10,
            'section'    => 'socialInfo',
            'type'       => 'text',
        )
    ) );
    // Twitter
    $wp_customize->add_setting(
        'Twitter',
        array(
            'default' => '',
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options'
        )
    );
    
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'Twitter',
        array(
            'label'      => __( 'Twitter', 'textdomain' ),
            'description' => __( '', 'textdomain' ),
            'settings'   => 'Twitter',
            'priority'   => 10,
            'section'    => 'socialInfo',
            'type'       => 'text',
        )
    ) );
    // youtube
    $wp_customize->add_setting(
        'Youtube',
        array(
            'default' => '',
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options'
        )
    );
    
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'Youtube',
        array(
            'label'      => __( 'Youtube', 'textdomain' ),
            'description' => __( '', 'textdomain' ),
            'settings'   => 'Youtube',
            'priority'   => 10,
            'section'    => 'socialInfo',
            'type'       => 'text',
        )
    ) );
    // linkedin
    $wp_customize->add_setting(
        'Linkedin',
        array(
            'default' => '',
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options'
        )
    );
    
    $wp_customize->add_control( new WP_Customize_Control(
        $wp_customize,
        'Linkedin',
        array(
            'label'      => __( 'Linkedin', 'textdomain' ),
            'description' => __( '', 'textdomain' ),
            'settings'   => 'Linkedin',
            'priority'   => 10,
            'section'    => 'socialInfo',
            'type'       => 'text',
        )
    ) );

 }
 
add_action( 'customize_register', 'my_register_additional_customizer_settings' );

// add_action('user_register','create_new_user_posts', 999);

// function create_new_user_posts($user_id) {


//         if (!$user_id > 0)
//                 return;
//         //here we know the user has been created so to create 
//         //3 posts we call wp_insert_post 3 times.
//         // Create post object
//         $user = get_user_by('id', $user_id);
//         // $current_user = wp_get_current_user();
//         $draft_company_post = array(
//              // 'insert_company_small_description' => get_field('company_small_description', $current_user),
//              'post_title' => $user->user_login,
//              'post_type' => 'company',
//              'post_content' => '',
//              'post_status' => 'draft',
//              'post_author' => $user_id
//         );
//         $draft_company = wp_insert_post( $draft_company_post );
//         //and if you want to store the post ids in 
//         //the user meta then simply use update_user_meta
        
//         update_user_meta($user_id,'_create_user_company',$draft_company);

// }

// IMAGE FIELD THE WORKS AS FEATURED IMAGE IN POST.
function acf_set_featured_image( $value, $post_id, $field  ){
    if (is_user_logged_in() && current_user_can('um_company-en')) { 
        if($value != '') {
            //Add the value which is the image ID to the _thumbnail_id meta data for the current post
            add_post_meta($post_id, '_thumbnail_id', $value);
        }
    }
    return $value;
}

// acf/update_value/name={$field_name} - filter for a specific field based on it's name
add_filter('acf/update_value/name=main_header_image_companies', 'acf_set_featured_image', 10, 3);



// add_action('save_post', 'wpml_duplicate_on_publish_final', 10, 1);
// function wpml_duplicate_on_publish_final($post_id) {
      
//     // Check permissions
//     if ( ! current_user_can( 'edit_post', $post_id ) )
//         return;
  
//     // unhook this function so it doesn't loop infinitely
//     remove_action('save_post', 'wpml_duplicate_on_publish_final');
  
//     if( function_exists( "icl_makes_duplicates" ) ){
//         icl_makes_duplicates( $post_id );
//     }
  
//     // re-hook this function
//     add_action('save_post', 'wpml_duplicate_on_publish_final');
// }