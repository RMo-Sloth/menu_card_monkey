<?php

class MenuCardMonkeyBlock {

  static function enable() {
    // NOTE: refactor to allow inheritance
    $instance = new MenuCardMonkeyBlock();
    add_action( 'init', array( $instance, 'register' ) );
  }
  function register () {
    wp_register_script(
      'menu-card-monkey-editor-menu-card-section',
      plugins_url() . '/menu_card_monkey/blocks/js/menu_card_section.js',
      array(
        'wp-blocks',
        'wp-dom-ready',
        'wp-element',
      )
    );

    wp_register_style(
      'mcm-block-menu-card-section-style',
      plugins_url() . '/menu_card_monkey/blocks/css/menu_card_section.css'
    );

    register_block_type(
      'menu-card-monkey/menu-card-section',
      array(
        'title' => __( 'Menu Card Category', 'menu-card-monkey' ),
        'description' => __( 'This block displays a list of products from a specific category in your menu.', 'menu-card-monkey' ),
        'category' => 'menu-card-monkey-blocks',
        'icon' => 'list-view',
        'attributes' => array(
          'menu_title' => array(
            'type' => 'string',
            'source' => 'text',
            'selector' => '.product-list-title',
            'default' => __( 'Please enter a menu title', 'menu-card-monkey' ),
          ),
        ),
        'editor_script' => 'menu-card-monkey-editor-menu-card-section',
        'style' => 'mcm-block-menu-card-section-style'
      )
    );
  }

}
