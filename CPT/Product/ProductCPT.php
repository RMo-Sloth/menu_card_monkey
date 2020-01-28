<?php

class MenuCardMonkeyProductCPT extends MenuCardMonkeyCPT {
  protected $post_type = 'mcm_products';

function registerCPT() {
    register_post_type( $this->post_type, array(
      'label' => __( 'Products', 'menu-card-monkey'),
      'labels' => array(
        'name' => __( 'Products', 'menu-card-monkey' ),
        'singular_name' => __( 'Product', 'menu-card-monkey' ),
        'add_new' => _x( 'Add Product', $this->post_type,'menu-card-monkey' ),
        'add_new_item' => __( 'Add New Product', 'menu-card-monkey' ),
        'edit_item' => __( 'Edit Product', 'menu-card-monkey' ),
        // 'new_item' =>
        // 'view_item' =>
        // 'view_items' =>
        // 'search_items' =>
        'not_found' => __( 'No products found', 'menu-card-monkey' ),
        // 'not_found_in_trash' => 'No porducts found in Trash',
        // 'parent_item_colon' => ,
        // 'all_items' = ,
        // 'archives'  => ,
        // 'attributes' => ,
        // 'insert_into_item ' => ,
        // 'uploaded_to_this_item' => ,
        // 'featured_image' =>,
        // 'set_featured_image' => ,
        // 'remove_featured_image' =>,
        // 'use_featured_image' =>,
        // 'menu_name' => ,
        // 'filter_items_list' => ,
        // 'items_list_navigation' => ,
        // 'items_list' => ,
        // 'item_published' => ,
        // 'item_published_privately' =>
        // 'item_reverted_to_draft' =>
        // 'item_scheduled' =>
        // 'item_updated' =>
      ),
      'description' => __( 'These are menu items that can be used to create a variety of menus.' ),
      'public' => true,
      // 'hierarchical' => true,
      'exclude_from_search' => true,
      'publicly_queryable' => false,
      'show_ui'=> true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'show_in_admin_bar' => false,
      'show_in_rest'=> true,
      // 'rest_base' => $post_type,
      // 'rest_controller_class' => 'WP_REST_Posts_Controller',
      'menu_position' => null,
      'menu_icon' => 'dashicons-store',
      // 'capability_type' => 'post',
      // 'capabilities' => ,
      // 'map_meta_cap' => false,
      'supports' => array(
        'title',
      ),
      // 'register_meta_box_cb' =>
      // 'taxonomies' =>
      'has_archive' => false,
      // 'rewrite' => array()
      // 'query_var'
      'can_export' => true,
      'delete_with_user' => true
    ) );
  }
  function add_meta_boxes() {
    add_meta_box(
        'mcm_product_meta',
        __( 'Product information' ),
        array( $this, 'meta_box_html' ),
        $this->post_type,
        'normal'
    );
  }
  function meta_box_html( $post ) {
    wp_register_style(
      'mcm_product_meta_box',
      plugins_url() . '/menu_card_monkey/CPT/Product/css/mcm-product-meta-box.css'
    );
    wp_enqueue_style( 'mcm_product_meta_box' );
    $productMetaString = get_post_meta( $post->ID, 'menu-card-monkey-product', true );
    if( $productMetaString === '') {
      echo '<p style="text-align: center">OOPS, the productinfo you are looking for does not seem to exist.</p>';
      $productMetaString = '{"price":"0","description":""}';
    }
    $productMeta = json_decode( $productMetaString );
    ?>
    <table role='presentation'>
      <tbody>
        <tr>
          <th><label for='mcm-price'><?php _e( 'Price', 'menu-card-monkey' ) ?></label></th>
          <td><input type='number' step='0.01' min='0' pattern='d*\.d{2}' id='mcm-price' name='price' value='<?php echo esc_html( $productMeta->price ); ?>'></textarea></td>
        </tr>
        <tr>
          <th><label for='mcm-description'><?php _e( 'Description', 'menu-card-monkey' ) ?></label></th>
          <td><textarea id='mcm-description' rows='5' name='description'><?php echo esc_html( $productMeta->description ); ?></textarea></td>
        </tr>
      </tbody>
    </table>
  <?php }
  function save_post_meta( $post_id, $post, $update ) {
    if( $update === false ) return ;
    if( !isset( $_POST['price'] ) || !preg_match("/\d+(\.\d{0,2})?/", $_POST['price'] ) ) return;
    if( !isset( $_POST['description'] ) ) return;

    $price = sanitize_text_field( $_POST['price'] );
    $description = sanitize_text_field( $_POST['description'] );

    $data = array(
      'price' => $price,
      'description' => $description
    );
    $data = json_encode( $data );
    update_post_meta( $post_id, 'menu-card-monkey-product', $data );
  }
}
