<?php
/**
 * Theme functions and definitions
 */

// Enqueue styles and scripts
function shadcn_wp_scripts() {
  // Check if the CSS file exists before enqueuing
  $css_file_path = get_template_directory() . '/dist/output.css';
  $css_file_uri = get_template_directory_uri() . '/dist/output.css';
  
  // Fallback to app/globals.css if the compiled CSS doesn't exist
  if (!file_exists($css_file_path)) {
    $css_file_uri = get_template_directory_uri() . '/app/globals.css';
  }
  
  wp_enqueue_style('shadcn-wp-style', $css_file_uri, array(), filemtime($css_file_path));
  
  // Main JavaScript file
  $main_js_path = get_template_directory() . '/main.js';
  if (file_exists($main_js_path)) {
    wp_enqueue_script('shadcn-wp-main', get_template_directory_uri() . '/main.js', array(), filemtime($main_js_path), true);
  }
  
  // Fallback to src/js/main.js if it exists
  $src_js_path = get_template_directory() . '/src/js/main.js';
  if (file_exists($src_js_path)) {
    wp_enqueue_script('shadcn-wp-src', get_template_directory_uri() . '/src/js/main.js', array(), filemtime($src_js_path), true);
  }
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

  // Add image sizes for blog cards and featured images
  add_image_size('blog-card', 600, 400, true);
  add_image_size('blog-featured', 1200, 600, true);

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

  // Add theme support for selective refresh for widgets
  add_theme_support('customize-selective-refresh-widgets');

  // Add support for responsive embeds
  add_theme_support('responsive-embeds');

  // Register navigation menus
  register_nav_menus(array(
    'primary' => esc_html__('Primary Menu', 'shadcn-wp'),
    'footer' => esc_html__('Footer Menu', 'shadcn-wp'),
    'categories' => esc_html__('Categories Menu', 'shadcn-wp'),
  ));
}
add_action('after_setup_theme', 'shadcn_wp_setup');

// Register widget area
function shadcn_wp_widgets_init() {
  register_sidebar(array(
    'name'          => esc_html__('Sidebar', 'shadcn-wp'),
    'id'            => 'sidebar-1',
    'description'   => esc_html__('Add widgets here.', 'shadcn-wp'),
    'before_widget' => '<section id="%1$s" class="widget %2$s rounded-lg border bg-card p-6 text-card-foreground shadow-sm mb-6">',
    'after_widget'  => '</section>',
    'before_title'  => '<h2 class="widget-title text-lg font-semibold mb-4">',
    'after_title'   => '</h2>',
  ));
  
  register_sidebar(array(
    'name'          => esc_html__('Footer Widgets', 'shadcn-wp'),
    'id'            => 'footer-widgets',
    'description'   => esc_html__('Add footer widgets here.', 'shadcn-wp'),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="text-lg font-medium mb-4">',
    'after_title'   => '</h3>',
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
  
  // Check if public directory exists for placeholder images
  $public_dir = get_template_directory() . '/public';
  if (!file_exists($public_dir)) {
    mkdir($public_dir, 0755, true);
  }
  
  // Create a simple placeholder image if it doesn't exist
  $placeholder_path = $public_dir . '/placeholder.jpg';
  if (!file_exists($placeholder_path)) {
    // Create a placeholder image using GD library if available
    if (function_exists('imagecreatetruecolor')) {
      $width = 800;
      $height = 600;
      $image = imagecreatetruecolor($width, $height);
      
      // Create background
      $bg_color = imagecolorallocate($image, 240, 240, 240);
      imagefill($image, 0, 0, $bg_color);
      
      // Create text
      $text_color = imagecolorallocate($image, 120, 120, 120);
      $text = "Placeholder Image";
      $font_size = 5; // Default font size for GD
      
      // Center text
      $text_box = imagettfbbox($font_size, 0, 5, $text);
      $text_width = $text_box[2] - $text_box[0];
      $text_height = $text_box[7] - $text_box[1];
      
      // If imagettfbbox doesn't work, use a simple approach
      if (empty($text_width)) {
        $text_width = strlen($text) * 9;
        $text_height = 15;
      }
      
      $x = ($width - $text_width) / 2;
      $y = ($height - $text_height) / 2 + $text_height;
      
      // Draw the text
      if (function_exists('imagettftext')) {
        imagettftext($image, $font_size, 0, $x, $y, $text_color, 5, $text);
      } else {
        imagestring($image, 5, $x, $y, $text, $text_color);
      }
      
      // Save the image
      imagejpeg($image, $placeholder_path, 90);
      imagedestroy($image);
    }
  }
  
  // Check and copy CSS file
  $dist_css = $dist_dir . '/output.css';
  $src_css = get_template_directory() . '/app/globals.css';
  if (!file_exists($dist_css) && file_exists($src_css)) {
    copy($src_css, $dist_css);
  }
}
// Run on theme activation
add_action('after_switch_theme', 'shadcn_wp_create_dist_files');
// Also run on each page load during development
if (WP_DEBUG) {
  shadcn_wp_create_dist_files();
}

/**
 * Modify the excerpt length
 */
function shadcn_wp_excerpt_length($length) {
  return 20;
}
add_filter('excerpt_length', 'shadcn_wp_excerpt_length');

/**
 * Modify the excerpt more string
 */
function shadcn_wp_excerpt_more($more) {
  return '...';
}
add_filter('excerpt_more', 'shadcn_wp_excerpt_more');

/**
 * Add custom classes to body based on template and dark mode
 */
function shadcn_wp_body_classes($classes) {
  // Add a class for dark mode from cookie
  if (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') {
    $classes[] = 'dark-mode';
  }
  
  // Add page-specific classes
  if (is_single()) {
    $classes[] = 'single-post-template';
  } elseif (is_page()) {
    $classes[] = 'page-template';
  } elseif (is_front_page()) {
    $classes[] = 'home-template';
  } elseif (is_archive()) {
    $classes[] = 'archive-template';
  }
  
  return $classes;
}
add_filter('body_class', 'shadcn_wp_body_classes');

/**
 * Customize comment form fields
 */
function shadcn_wp_comment_form_defaults($defaults) {
  $defaults['comment_field'] = '<textarea id="comment" name="comment" class="w-full min-h-[100px] rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="' . __('Share your thoughts...', 'shadcn-wp') . '"></textarea>';
  
  $defaults['submit_button'] = '<input name="%1$s" type="submit" id="%2$s" class="%3$s inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2" value="%4$s" />';
  
  return $defaults;
}
add_filter('comment_form_defaults', 'shadcn_wp_comment_form_defaults');

/**
 * Add custom classes to the navigation menu
 */
function shadcn_wp_menu_css_class($classes, $item, $args, $depth) {
  if ($args->theme_location === 'primary') {
    $classes[] = 'nav-item';
    if ($depth === 0) {
      $classes[] = 'text-sm font-medium transition-colors hover:text-primary';
    }
  }
  
  return $classes;
}
add_filter('nav_menu_css_class', 'shadcn_wp_menu_css_class', 10, 4);

/**
 * Estimate reading time for posts
 */
function shadcn_wp_reading_time($content = '') {
  global $post;
  
  if (empty($content) && isset($post->post_content)) {
    $content = $post->post_content;
  }
  
  // Count words
  $word_count = str_word_count(strip_tags($content));
  $reading_time = ceil($word_count / 200); // Assuming 200 words per minute
  
  // Ensure at least 1 minute
  if ($reading_time < 1) {
    $reading_time = 1;
  }
  
  return $reading_time;
}

/**
 * Register a custom function for the template directory
 */
function shadcn_wp_get_template_directory_uri() {
  return get_template_directory_uri();
}

