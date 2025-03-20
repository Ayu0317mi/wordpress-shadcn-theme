<?php
/**
 * The header for our theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class('bg-background text-foreground antialiased'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="min-h-screen flex flex-col">
  <header id="masthead" class="border-b">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
      <div class="site-branding">
        <?php if (has_custom_logo()): ?>
          <div class="site-logo"><?php the_custom_logo(); ?></div>
        <?php else: ?>
          <h1 class="site-title font-bold text-xl">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
          </h1>
        <?php endif; ?>
      </div>

      <nav id="site-navigation" class="hidden md:block">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'primary',
          'menu_id'        => 'primary-menu',
          'container'      => false,
          'menu_class'     => 'flex space-x-4',
          'fallback_cb'    => false,
        ));
        ?>
      </nav>

      <button id="mobile-menu-toggle" class="md:hidden p-2 rounded-md hover:bg-accent">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu">
          <line x1="4" x2="20" y1="12" y2="12"></line>
          <line x1="4" x2="20" y1="6" y2="6"></line>
          <line x1="4" x2="20" y1="18" y2="18"></line>
        </svg>
      </button>
    </div>

    <div id="mobile-menu" class="hidden md:hidden">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_id'        => 'mobile-menu',
        'container'      => false,
        'menu_class'     => 'flex flex-col space-y-2 p-4',
        'fallback_cb'    => false,
      ));
      ?>
    </div>
  </header>

  <div id="content" class="flex-grow">

