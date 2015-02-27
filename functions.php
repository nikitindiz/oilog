<?php
  register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'oilog' ),
      'topmenu' => __( 'Top Menu', 'oilog' ),
      'footer' => __( 'Footer Menu', 'oilog' ),
  ) );

add_theme_support( 'post-thumbnails' );

// Registers the new post type and taxonomy

function wpt_product_posttype() {
  register_post_type( 'products',
    array(
      'labels' => array(
        'name' => __( 'Products' ),
        'singular_name' => __( 'Product' ),
        'add_new' => __( 'Add New Product' ),
        'add_new_item' => __( 'Add New Product' ),
        'edit_item' => __( 'Edit Product' ),
        'new_item' => __( 'Add New Product' ),
        'view_item' => __( 'View Product' ),
        'search_items' => __( 'Search Product' ),
        'not_found' => __( 'No products found' ),
        'not_found_in_trash' => __( 'No products found in trash' )
      ),
      //'taxonomies' => array('category'),
      'public' => true,
      'supports' => array( 'title', 'editor', 'thumbnail', 'comments' ),
      'capability_type' => 'post',
      'rewrite' => array("slug" => "products"), // Permalinks format
      'menu_position' => 5,
      'register_meta_box_cb' => 'add_products_metaboxes',
      'menu_icon' => '',
      'has_archive' => true
    )
  );

  flush_rewrite_rules( false );


}

add_action( 'init', 'wpt_product_posttype' );


function my_taxonomies_products() {
  $labels = array(
    'name'              => _x( 'Product Categories', 'taxonomy general name' ),
    'singular_name'     => _x( 'Product Category', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Product Categories' ),
    'all_items'         => __( 'All Product Categories' ),
    'parent_item'       => __( 'Parent Product Category' ),
    'parent_item_colon' => __( 'Parent Product Category:' ),
    'edit_item'         => __( 'Edit Product Category' ),
    'update_item'       => __( 'Update Product Category' ),
    'add_new_item'      => __( 'Add New Product Category' ),
    'new_item_name'     => __( 'New Product Category' ),
    'menu_name'         => __( 'Product Categories' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'product_category', 'products', $args );
}

add_action( 'init', 'my_taxonomies_products', 0 );

require_once('php_modules/metabox_sku.php');
require_once('php_modules/shortcode_news.php');

function my_get_posts( $query ) {

  if ( is_home() && $query->is_main_query() )
    $query->set( 'post_type', array( 'post', 'page', 'products' ) );

  return $query;
}

add_filter( 'pre_get_posts', 'my_get_posts' );


function add_menu_icons_styles(){
?>

<style>
#adminmenu .menu-icon-products div.wp-menu-image:before {
  content: "\f174";
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );

add_theme_support( 'post-thumbnails' );

function empowerment_widgets_init() {
  register_sidebar( array(
    'name' => 'Call Us Widget',
    'id' => 'oilog_call_us',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ) );
  register_sidebar( array(
    'name' => 'Navigation Searchbar',
    'id' => 'oilog_search_bar',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ) );
  register_sidebar( array(
    'name' => 'Slider Bar under Navigation',
    'id' => 'oilog_slider',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ) );
  register_sidebar( array(
    'name' => 'Copyright Sidebar',
    'id' => 'oilog_copyright',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
  ) );
}

add_action( 'widgets_init', 'empowerment_widgets_init' );


// Register shortcode

function ng_item_link($atts, $content = null)
{
    $params = shortcode_atts( array(
        'id' => '',
        'name' => '',
        'description' => '',
        'link' => '',
        'img' => ''
    ), $atts );

  return '
    <a class="add-to-request-btn" href="#dummy-link"
    ng-click="addItemToRequestList(priceReqCtrl,
                                       {id: '.do_shortcode($params['id']).',
                                        name: \''.do_shortcode($params['name']).'\',
                                        description: \''.do_shortcode($params['description']).'\',
                                        link: \''.do_shortcode($params['link']).'\',
                                        img: \''.do_shortcode($params['img']).'\'});">
    <i class="fa fa-plus"></i></a>
  ';
}

add_shortcode('ng_item_link', 'ng_item_link');


function oilog_grid_wrapper($atts, $content = null)
{

  $params = shortcode_atts( array(
          'class' => ''
      ), $atts );

  return '
  <div class="'.do_shortcode($params['class']).'">
      <div class="content-wrapper">
      '.do_shortcode($content).'
      </div>
  </div>
  ';
}

add_shortcode('oilog_grid_wrapper', 'oilog_grid_wrapper');




function oilog_about_us_wrapper($content = null)
{

  return '
      <div class="about-us">
        '.$content.'
      </div>
  ';
}

add_shortcode('oilog_about_us_wrapper', 'oilog_about_us_wrapper');

function oilog_acordeon_wrapper($content = null)
{

  return '
        <ul id="about-us-accordeon">
        '.$content.'
        </ul>
        ';
}

add_shortcode('oilog_acordeon_wrapper', 'oilog_acordeon_wrapper');

function oilog_acordeon_item($atts, $content = null)
{

    $params = shortcode_atts( array(
        'class' => ''
    ), $atts );

  return '
          <li>
            <div class="">
              <a href="#dummy-link" class="'.$params['class'].' control-show" data-target="about-us-accordeon">Our People</a>
              <div class="description">'.$content.'</div>
            </div>
          </li>
        ';
}

add_shortcode('oilog_acordeon_item', 'oilog_acordeon_item');

function content_wrap($atts, $content = null)
{

    $params = shortcode_atts( array(
        'class' => ''
    ), $atts );

  return '
          <div class="content-wrapper '.$params['class'].'">
              '.do_shortcode($content).'
          </div>
        ';
}

add_shortcode('content_wrap', 'content_wrap');
