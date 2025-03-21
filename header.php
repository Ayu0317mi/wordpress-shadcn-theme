<?php
/**
 * The header for our theme
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> class="<?php echo (isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') ? 'dark' : ''; ?>">
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  
  <script>
    // Initial theme setup based on localStorage or system preference
    (function() {
      const userTheme = localStorage.getItem('theme');
      const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      
      if (userTheme === 'dark' || (userTheme === 'system' && systemPrefersDark) || (!userTheme && systemPrefersDark)) {
        document.documentElement.classList.add('dark');
        document.cookie = 'theme=dark; path=/; max-age=31536000';
      } else {
        document.documentElement.classList.remove('dark');
        document.cookie = 'theme=light; path=/; max-age=31536000';
      }
    })();
  </script>
  
  <?php wp_head(); ?>
</head>

<body <?php body_class('bg-background text-foreground antialiased'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="min-h-screen flex flex-col">
  <header id="masthead" class="sticky top-0 z-40 w-full border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
    <div class="container flex h-16 items-center justify-between py-4">
      <div class="flex items-center gap-2">
        <button 
          id="mobile-menu-toggle" 
          class="md:hidden p-2 rounded-md hover:bg-accent"
          aria-label="Toggle menu"
        >
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
            <line x1="4" x2="20" y1="12" y2="12"></line>
            <line x1="4" x2="20" y1="6" y2="6"></line>
            <line x1="4" x2="20" y1="18" y2="18"></line>
          </svg>
        </button>
        
        <div class="site-branding">
          <?php if (has_custom_logo()): ?>
            <div class="site-logo"><?php the_custom_logo(); ?></div>
          <?php else: ?>
            <h1 class="site-title font-bold text-xl">
              <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
            </h1>
          <?php endif; ?>
        </div>
      </div>

      <nav id="site-navigation" class="hidden md:flex items-center gap-6">
        <?php
        // Display primary menu with updated styles
        if (has_nav_menu('primary')) {
          $menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['primary']);
          
          if ($menu_items) {
            foreach ($menu_items as $menu_item) {
              // Check if this item has children
              $has_children = false;
              $child_items = array();
              
              foreach ($menu_items as $possible_child) {
                if ($possible_child->menu_item_parent == $menu_item->ID) {
                  $has_children = true;
                  $child_items[] = $possible_child;
                }
              }
              
              // Only display top level menu items
              if ($menu_item->menu_item_parent == 0) {
                if ($has_children) {
                  // Dropdown menu for parent items
                  echo '<div class="relative group">';
                  echo '<button class="text-sm font-medium transition-colors hover:text-primary flex items-center gap-1 px-1 h-auto py-1">';
                  echo esc_html($menu_item->title);
                  echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><polyline points="6 9 12 15 18 9"></polyline></svg>';
                  echo '</button>';
                  echo '<div class="absolute hidden group-hover:block left-0 mt-1 w-48 rounded-md border bg-card p-2 shadow-md z-50">';
                  
                  foreach ($child_items as $child_item) {
                    echo '<a href="' . esc_url($child_item->url) . '" class="block rounded-sm px-3 py-2 text-sm hover:bg-accent hover:text-accent-foreground">' . esc_html($child_item->title) . '</a>';
                  }
                  
                  echo '</div>';
                  echo '</div>';
                } else {
                  // Regular link for items without children
                  echo '<a href="' . esc_url($menu_item->url) . '" class="text-sm font-medium transition-colors hover:text-primary">' . esc_html($menu_item->title) . '</a>';
                }
              }
            }
          }
        } else {
          // Fallback menu items
          ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="text-sm font-medium transition-colors hover:text-primary">Home</a>
          <a href="<?php echo esc_url(home_url('/about')); ?>" class="text-sm font-medium transition-colors hover:text-primary">About</a>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="text-sm font-medium transition-colors hover:text-primary">Blog</a>
          <?php
        }
        ?>
      </nav>

      <div class="flex items-center gap-2">
        <div class="relative hidden md:block">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
          </svg>
          <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="search" name="s" placeholder="Search..." class="w-[200px] pl-8 md:w-[250px] rounded-full bg-muted h-10 border-0">
          </form>
        </div>
        
        <button id="theme-toggle" class="p-2 rounded-md hover:bg-accent" aria-label="Toggle dark mode">
          <!-- Sun icon (shown in dark mode) -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:block hidden h-5 w-5">
            <circle cx="12" cy="12" r="4"></circle>
            <path d="M12 2v2"></path>
            <path d="M12 20v2"></path>
            <path d="m4.93 4.93 1.41 1.41"></path>
            <path d="m17.66 17.66 1.41 1.41"></path>
            <path d="M2 12h2"></path>
            <path d="M20 12h2"></path>
            <path d="m6.34 17.66-1.41 1.41"></path>
            <path d="m19.07 4.93-1.41 1.41"></path>
          </svg>
          <!-- Moon icon (shown in light mode) -->
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:hidden h-5 w-5">
            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t">
      <div class="container py-4 space-y-4">
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="mb-4">
          <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground">
              <circle cx="11" cy="11" r="8"></circle>
              <path d="m21 21-4.3-4.3"></path>
            </svg>
            <input type="search" name="s" placeholder="Search..." class="w-full pl-8 rounded-md bg-muted h-10 border-0">
          </div>
        </form>
        
        <?php
        // Display mobile menu with updated styles
        if (has_nav_menu('primary')) {
          $menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['primary']);
          
          if ($menu_items) {
            echo '<div class="space-y-4">';
            
            foreach ($menu_items as $menu_item) {
              // Only display top level menu items
              if ($menu_item->menu_item_parent == 0) {
                // Check if this item has children
                $has_children = false;
                $child_items = array();
                
                foreach ($menu_items as $possible_child) {
                  if ($possible_child->menu_item_parent == $menu_item->ID) {
                    $has_children = true;
                    $child_items[] = $possible_child;
                  }
                }
                
                if ($has_children) {
                  // Parent items with children
                  echo '<div class="mobile-dropdown">';
                  echo '<p class="text-sm font-medium">' . esc_html($menu_item->title) . '</p>';
                  echo '<div class="pl-4 space-y-2 mt-2">';
                  
                  foreach ($child_items as $child_item) {
                    echo '<a href="' . esc_url($child_item->url) . '" class="block text-sm transition-colors hover:text-primary">' . esc_html($child_item->title) . '</a>';
                  }
                  
                  echo '</div>';
                  echo '</div>';
                } else {
                  // Regular links for items without children
                  echo '<a href="' . esc_url($menu_item->url) . '" class="block text-sm font-medium transition-colors hover:text-primary">' . esc_html($menu_item->title) . '</a>';
                }
              }
            }
            
            echo '</div>';
          }
        } else {
          // Fallback mobile menu items
          ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="block text-sm font-medium transition-colors hover:text-primary">Home</a>
          <a href="<?php echo esc_url(home_url('/about')); ?>" class="block text-sm font-medium transition-colors hover:text-primary">About</a>
          <a href="<?php echo esc_url(home_url('/blog')); ?>" class="block text-sm font-medium transition-colors hover:text-primary">Blog</a>
          <a href="<?php echo esc_url(home_url('/contact')); ?>" class="block text-sm font-medium transition-colors hover:text-primary">Contact</a>
          <?php
        }
        ?>
      </div>
    </div>
  </header>

  <div id="content" class="flex-grow">

