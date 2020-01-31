<?php

abstract class MenuCardMonkeyBlock {
  static function enable( string $blockName ) {
    $instance;
    switch( $blockName ) {
      case 'menu-category':
        $instance = new MenuCardMonkeyBlock_MenuCategory();
        break;
      default:
        return;
    }
    add_action( 'init', array( $instance, 'register' ) );
  }
  function register() {
    $this->registerScript();
    $this->registerStyle();
    $this->registerBlock();
  }
  abstract function registerScript();
  abstract function registerStyle();
  abstract function registerBlock();
}

class MenuCardMonkeyBlock_MenuCategory extends MenuCardMonkeyBlock {
  function registerScript() {
    wp_register_script(
      'menu-card-monkey-editor-menu-card-section',
      plugins_url() . '/menu_card_monkey/blocks/js/menu_card_section.js',
      array(
        'wp-blocks',
        'wp-element',
        'wp-editor'
      )
    );
  }
  function registerStyle() {
    wp_register_style(
      'mcm-block-menu-card-section-style',
      plugins_url() . '/menu_card_monkey/blocks/css/menu_card_section.css'
    );
  }
  function registerBlock() {
    register_block_type(
      'menu-card-monkey/menu-card-section',
      array(
        'editor_script' => 'menu-card-monkey-editor-menu-card-section',
        'style' => 'mcm-block-menu-card-section-style'
      )
    );
  }
}
