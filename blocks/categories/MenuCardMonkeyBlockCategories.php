<?php

class MenuCardMonkeyBlockCategories {
  static function enable() {
    $instance = new MenuCardMonkeyBlockCategories();
    add_filter( 'block_categories', array( $instance, 'register' ), 10, 2 );
  }
  public function register( $categories, $post ) {
    $category = array(
        'slug' => 'menu-card-monkey-blocks',
        'title' => __( 'Menu Card Monkey', 'menu-card-monkey' ),
      );
    array_push( $categories, $category );
    return $categories;
  }

}
