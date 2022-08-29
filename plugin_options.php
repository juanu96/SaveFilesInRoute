<?php

class vegalink_options
{

  protected $plugin_options_page = '';

  /**
   * Initialize hooks.
   */
  public function init()
  {

    add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    add_action('admin_init', array($this, 'register_plugin_settings'));
    add_action('admin_menu', array($this, 'create_admin_menu_page'));
  }

  public function register_plugin_settings()
  {
    register_setting('wp-react-plugin-settings-group', 'wp-react-plugin');
  }

  /**
   *
   * Create new plugin options page under the Settings menu.
   */
  public function create_admin_menu_page()
  {
    $this->plugin_options_page = add_options_page('vegalink', 'vegalink', 'manage_options', __FILE__, array($this, 'render_plugin_options_page'));
  }

  public function render_plugin_options_page()
  {
    $upload_dir = wp_upload_dir();
    $folder = $upload_dir['basedir'];
    $files = list_files($folder, 2);
    //error_log(print_r($files, true));
    foreach ($files as $file) {
      if (is_file($file)) {
        $filesize = size_format(filesize($file));
        $filename = basename($file);
      }
      error_log(print_r($file, true));
    }
    echo '<div id="vegalink"></div>';
  }

  public function enqueue_admin_scripts($hook)
  {

    // Are we on the plugin options page?
    if ($hook === $this->plugin_options_page) {

      // add react and react-dom from core
      $dep = ['wp-element'];
      //$dep = ['react', 'react-dom']; // alternative way of loading React via WP core

      $handle = 'wp-react-plugin-';

      // enqueue development or production React code
      if (file_exists(dirname(__FILE__) . "/dist/main.js")) {
        $handle .= 'prod';
        wp_enqueue_script($handle, plugins_url("/dist/main.js", __FILE__), $dep, '0.1', true);
        wp_enqueue_style($handle, plugins_url("/dist/main.css", __FILE__), false, '0.1', 'all');
      } else {
        $handle .= 'dev';
        wp_enqueue_script($handle, 'http://localhost:3000/main.js', $dep, '0.1', true);
        wp_enqueue_style($handle, 'http://localhost:3000/main.css', false, '0.1', 'all');
      }
    }
  }
}

$vegalink_options = new vegalink_options();
$vegalink_options->init();
