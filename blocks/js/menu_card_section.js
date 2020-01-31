(function mcm_register_menu_card_section_block() {
  wp.blocks.registerBlockType( 'menu-card-monkey/menu-card-section', {
    title: 'Menu Category',
    description: 'This block displays a list of products from a specific category in your menu.',
    category: 'menu-card-monkey-blocks',
    icon: 'list-view',
    // keywords: ,
    // styles: [],
    attributes: {
      menu_title: {
        type: 'string',
        source: 'text',
        selector: '.product-list-title',
        default: 'Please enter a menu title',
        }
    },
    // example,
    // transforms,
    // parent
    supports: {
      anchor: true,
      customClassName: false,
    },
    edit( properties ) {
      return wp.element.createElement( 'div', null, 'Edit function output.' );
    },
    save( properties ) {
      let listItems = [];
      let name = 'product 1';
      let price = 12.35;
      price = price.toString();
      price = price.padStart( 7, ' ' )
      price = String.fromCharCode(8364).concat( price ); // 8364 = currencyCharCode

      for( let i=0; i<2; i++ ) {
        // set up product
        let productName = wp.element.createElement( 'span', {className: 'product-name'}, name );
        let productPrice = wp.element.createElement( 'span', {className: 'product-price'}, price );
        let listItem = wp.element.createElement( 'li', {className: 'product'}, productName, productPrice );
        // add to list
        listItems.push( listItem );
      }

      let title = wp.element.createElement( 'h2', {className: 'product-list-title'}, properties.attributes.menu_title );
      let list = wp.element.createElement( 'ul', {className: 'product-list'}, ...listItems );
      let template = wp.element.createElement( 'div', null, title, list );

      return template;
    }
  } );
})();
