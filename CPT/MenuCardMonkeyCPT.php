<?php
require_once 'Product/ProductCPT.php';

abstract class MenuCardMonkeyCPT {
  protected $post_type;
  public static function enable( string $CPTName ) {
    $instance;
    switch( $CPTName ) {
      case 'products':
        $instance = new MenuCardMonkeyProductCPT();
        break;
    }
    $instance->register();
  }
  protected function register() {
    add_action( 'init', array( $this, 'registerCPT' ) );
    add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
    add_action( 'save_post_'.$this->post_type, array( $this, 'save_post_meta' ), 10, 3 );
  }
  abstract function registerCPT();
  abstract function add_meta_boxes();
  abstract function save_post_meta( $post_id, $post, $update );
}
