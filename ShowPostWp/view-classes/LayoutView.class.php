<?php
namespace Shortcode\View;

class LayoutView {

  protected $layout;

  function __construct($layout) {
    $this->layout = $layout;
    $this->subfolder = 'template-parts';
  }

  function getTemplateView() {
    // $view_template = 'layout-'. $this->layout . '.php';
    $view_template = 'load-more.php';

    // Look for a file in theme
    if( $theme_template = locate_template('ShowPostWp/' . $this->subfolder . '/' . $view_template ) ) {

      require $theme_template;

    } else {

      // Nothing found, let's look in our plugin
      $plugin_template = FILE_TEMPLATE_DIR . $view_template;
      if( file_exists( $plugin_template ) ){
        require $plugin_template;
      }

    }
  }

  function getButtonTemplate() {
    $button_template = 'load-more-btn.php';

    // Look for file in theme
    if( $theme_template = locate_template('ShowPostWp/' . $this -> subfolder . '/' . $button_template ) ) {
      
      require $theme_template;

    } else {

      //Nothing found, look in plugin
      $plugin_template = FILE_TEMPLATE_DIR . $button_template;
      if( file_exists( $plugin_template ) ){
        require $plugin_template;
      }
    }
  }

  function getCategoryListTemplate( $category_args ) {
    $cat_list_template = 'category-list.php';

    // Look for file in theme
    if( $theme_template = locate_template('ShowPostWp/' . $this -> subfolder . '/' . $cat_list_template ) ) {
      
      require $theme_template;

    } else {

      //Nothing found, look in plugin
      $plugin_template = FILE_TEMPLATE_DIR . $cat_list_template;
      if( file_exists( $plugin_template ) ){
        require $plugin_template;
      }
    }

  }

}
