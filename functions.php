<?php
/**
 * Theme functions and definitions
 */

// Enqueue styles and scripts
function shadcn_wp_scripts() {
  // Check if the CSS file exists before enqueuing
  $css_file_path = get_template_directory() . '/dist/output.css';
  $css_file_uri = get_template_directory_uri() . '/dist/output.css';
  
  // Fallback to src/css/globals.css if the compiled CSS doesn't exist
  if (!file_exists($css_file_path)) {
    $css_file_uri = get_template_directory_uri() . '/src/css/globals.css';
  }
  
  wp_enqueue_style('shadcn-wp-style', $css_file_uri);
  
  // Check if the JS file exists before enqueuing
  $js_file_path = get_template_directory() . '/dist/main.js';
  $js_file_uri = get_template_directory_uri() . '/dist/main.js';
  
  // Fallback to src/js/main.js if the compiled JS doesn't exist
  if (!file_exists($js_file_path)) {
    $js_file_uri = get_template_directory_uri() . '/src/js/main.js';
  }
  
  wp_enqueue_script('shadcn-wp-script', $js_file_uri, array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'shadcn_wp_scripts');

// Theme support
function shadcn_wp_setup() {
  // Add default posts and comments RSS feed links to head
  add_theme_support('automatic-feed-links');

  // Let WordPress manage the document title
  add_theme_support('title-tag');

  // Enable support for Post Thumbnails on posts and pages
  add_theme_support('post-thumbnails');

  // Switch default core markup to output valid HTML5
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script',
  ));

  // Register navigation menus
  register_nav_menus(array(
    'primary' => esc_html__('Primary Menu', 'shadcn-wp'),
    'footer' => esc_html__('Footer Menu', 'shadcn-wp'),
  ));
}
add_action('after_setup_theme', 'shadcn_wp_setup');

// Register widget area
function shadcn_wp_widgets_init() {
  register_sidebar(array(
    'name'          => esc_html__('Sidebar', 'shadcn-wp'),
    'id'            => 'sidebar-1',
    'description'   => esc_html__('Add widgets here.', 'shadcn-wp'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title">',
    'after_title'   => '</h2>',
  ));
}
add_action('widgets_init', 'shadcn_wp_widgets_init');

// Custom template tags for this theme
$template_tags_path = get_template_directory() . '/inc/template-tags.php';
if (file_exists($template_tags_path)) {
  require $template_tags_path;
}

// Create dist directory and copy source files if they don't exist
function shadcn_wp_create_dist_files() {
  // Check if dist directory exists
  $dist_dir = get_template_directory() . '/dist';
  if (!file_exists($dist_dir)) {
    mkdir($dist_dir, 0755, true);
  }
  
  // Check and copy CSS file
  $dist_css = $dist_dir . '/output.css';
  $src_css = get_template_directory() . '/src/css/globals.css';
  if (!file_exists($dist_css) && file_exists($src_css)) {
    copy($src_css, $dist_css);
  }
  
  // Check and copy JS file
  $dist_js = $dist_dir . '/main.js';
  $src_js = get_template_directory() . '/src/js/main.js';
  if (!file_exists($dist_js) && file_exists($src_js)) {
    copy($src_js, $dist_js);
  }
}
// Run on theme activation
add_action('after_switch_theme', 'shadcn_wp_create_dist_files');
// Also run on each page load during development
if (WP_DEBUG) {
  shadcn_wp_create_dist_files();
}

