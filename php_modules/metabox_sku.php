<?php

// Add the Products Meta Boxes

function add_products_metaboxes() {
  // add_meta_box('wpt_products_date', 'Product Date', 'wpt_products_date', 'products', 'side', 'default');
  add_meta_box('wpt_products_SKU', 'Product SKU', 'wpt_products_SKU', 'products', 'normal', 'high');
}

// The Product SKU Metabox

function wpt_products_SKU() {
  global $post;

  // Noncename needed to verify where the data originated
  echo '<input type="hidden" name="productmeta_noncename" id="productmeta_noncename" value="' .
  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

  // Get the SKU data if its already been entered
  $SKU = get_post_meta($post->ID, '_SKU', true);

  // Echo out the field
  echo '<input type="text" name="_SKU" value="' . $SKU  . '" class="widefat" />';

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

  $products_meta['_SKU'] = $_POST['_SKU'];

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


