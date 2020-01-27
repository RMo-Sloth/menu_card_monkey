<?php
/**
* Plugin Name:        Menu Card Monkey
* Description:        Menu Card Monkey helps you create a restaurant menu for your website.
* Version:            0.0.0
* Author:             Rob Monhemius
* Author URI:         https://www.waardwebsites.nl
* Requires at least:  5.0.0
* Requires PHP:       7.0
* License:            No License
* License URI:
* Text Domain:        menu-card-monkey
* Domain Path:        languages
**/

// LOAD BLOCKS
require_once 'blocks/categories/MenuCardMonkeyBlockCategories.php';
require_once 'blocks/blocks/MenuCardMonkeyBlock.php';

// LOAD CPT's
require_once 'CPT/MenuCardMonkeyCPT.php';


MenuCardMonkeyBlockCategories::enable();
MenuCardMonkeyBlock::enable( 'menu-category' );

MenuCardMonkeyCPT::enable( 'products' );
