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


//register_taxonomy_for_object_type( 'category', 'products' );


// Add the Products Meta Boxes

function add_products_metaboxes() {
  // add_meta_box('wpt_products_date', 'Product Date', 'wpt_products_date', 'products', 'side', 'default');
  add_meta_box('wpt_products_location', 'Product Location', 'wpt_products_location', 'products', 'normal', 'high');
}

// The Product Location Metabox

function wpt_products_location() {
  global $post;

  // Noncename needed to verify where the data originated
  echo '<input type="hidden" name="productmeta_noncename" id="productmeta_noncename" value="' .
  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

  // Get the location data if its already been entered
  $location = get_post_meta($post->ID, '_location', true);

  // Echo out the field
  echo '<input type="text" name="_location" value="' . $location  . '" class="widefat" />';

}

// Save the Metabox Data

function wpt_save_products_meta($post_id, $post) {

  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( !wp_verify_nonce( $_POST['productmeta_noncename'], plugin_basename(__FILE__) )) {
  return $post->ID;
  }

  // Is the user allowed to edit the post or page?
  if ( !current_user_can( 'edit_post', $post->ID ))
    return $post->ID;

  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.

  $products_meta['_location'] = $_POST['_location'];

  // Add values of $products_meta as custom fields

  foreach ($products_meta as $key => $value) { // Cycle through the $products_meta array!
    if( $post->post_type == 'revision' ) return; // Don't store custom data twice
    $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
    if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
      update_post_meta($post->ID, $key, $value);
    } else { // If the custom field doesn't have a value
      add_post_meta($post->ID, $key, $value);
    }
    if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
  }

}

add_action('save_post', 'wpt_save_products_meta', 1, 2); // save the custom fields



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
