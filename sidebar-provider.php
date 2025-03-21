<?php
/**
 * Sidebar Provider for the theme
 */

// Theme sidebar with integration for the shadcn/ui sidebar component
?>

<div id="sidebar-wrapper" class="fixed top-0 left-0 z-40 h-full pointer-events-none">
  <!-- Sidebar -->
  <div id="sidebar" class="group pointer-events-auto hidden md:block text-sidebar-foreground" data-state="expanded" data-collapsible="" data-variant="sidebar" data-side="left">
    <!-- Sidebar fixed container -->
    <div class="fixed inset-y-0 left-0 z-10 h-svh w-[16rem] md:flex flex-col transition-transform duration-200 ease-in-out transform -translate-x-full shadow-xl">
      <div data-sidebar="sidebar" class="flex h-full w-full flex-col bg-[hsl(var(--sidebar-background))] text-[hsl(var(--sidebar-foreground))] border-r border-[hsl(var(--sidebar-border))]">
        
        <!-- Sidebar Header -->
        <div data-sidebar="header" class="flex flex-col gap-2 p-4">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">
              <?php bloginfo('name'); ?>
            </h2>
            <button id="sidebar-toggle" class="p-2 rounded-md hover:bg-accent md:flex items-center justify-center h-7 w-7">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <path d="M19 12H5M12 19l-7-7 7-7"></path>
              </svg>
              <span class="sr-only">Toggle Sidebar</span>
            </button>
          </div>
        </div>
        
        <!-- Sidebar Separator -->
        <div data-sidebar="separator" class="mx-2 w-auto bg-sidebar-border h-[1px]"></div>
        
        <!-- Sidebar Content -->
        <div data-sidebar="content" class="flex min-h-0 flex-1 flex-col gap-2 overflow-auto p-2">
          
          <!-- Search Group -->
          <div data-sidebar="group" class="relative flex w-full min-w-0 flex-col p-2">
            <div data-sidebar="group-label" class="duration-200 flex h-8 shrink-0 items-center rounded-md px-2 text-xs font-medium text-sidebar-foreground/70 outline-none ring-sidebar-ring transition-[margin,opa] ease-linear focus-visible:ring-2 [&>svg]:size-4 [&>svg]:shrink-0 group-data-[collapsible=icon]:-mt-8 group-data-[collapsible=icon]:opacity-0">
              Search
            </div>
            <div data-sidebar="group-content" class="w-full text-sm">
              <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground">
                  <circle cx="11" cy="11" r="8"></circle>
                  <path d="m21 21-4.3-4.3"></path>
                </svg>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                  <input type="search" name="s" placeholder="Search..." class="w-full pl-8 rounded-md bg-muted h-10 border-0">
                </form>
              </div>
            </div>
          </div>
          
          <!-- Navigation Group -->
          <div data-sidebar="group" class="relative flex w-full min-w-0 flex-col p-2">
            <div data-sidebar="group-label" class="duration-200 flex h-8 shrink-0 items-center rounded-md px-2 text-xs font-medium text-sidebar-foreground/70 outline-none ring-sidebar-ring transition-[margin,opa] ease-linear focus-visible:ring-2 [&>svg]:size-4 [&>svg]:shrink-0 group-data-[collapsible=icon]:-mt-8 group-data-[collapsible=icon]:opacity-0">
              Navigation
            </div>
            <div data-sidebar="group-content" class="w-full text-sm">
              <ul data-sidebar="menu" class="flex w-full min-w-0 flex-col gap-1">
                <?php
                // Display menu in sidebar
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
                        echo '<li data-sidebar="menu-item" class="group/menu-item relative">';
                        
                        $current = (is_home() && $menu_item->object_id == get_option('page_for_posts')) || 
                                   (is_front_page() && $menu_item->object_id == get_option('page_on_front')) ||
                                   ($menu_item->object_id == get_queried_object_id());
                        
                        echo '<a href="' . esc_url($menu_item->url) . '" data-sidebar="menu-button" data-active="' . ($current ? 'true' : 'false') . '" class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-none ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-[[data-sidebar=menu-action]]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground data-[state=open]:hover:bg-sidebar-accent data-[state=open]:hover:text-sidebar-accent-foreground group-data-[collapsible=icon]:!size-8 group-data-[collapsible=icon]:!p-2 [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0">';
                        
                        if ($has_children) {
                          echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="m9 18 6-6-6-6"></path></svg>';
                        }
                        echo '<span>' . esc_html($menu_item->title) . '</span>';
                        echo '</a>';
                        
                        if ($has_children) {
                          echo '<ul data-sidebar="menu-sub" class="mx-3.5 flex min-w-0 translate-x-px flex-col gap-1 border-l border-sidebar-border px-2.5 py-0.5 group-data-[collapsible=icon]:hidden">';
                          
                          foreach ($child_items as $child_item) {
                            $child_current = $child_item->object_id == get_queried_object_id();
                            
                            echo '<li>';
                            echo '<a href="' . esc_url($child_item->url) . '" data-sidebar="menu-sub-button" data-size="md" data-active="' . ($child_current ? 'true' : 'false') . '" class="flex h-7 min-w-0 -translate-x-px items-center gap-2 overflow-hidden rounded-md px-2 text-sidebar-foreground outline-none ring-sidebar-ring hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 aria-disabled:pointer-events-none aria-disabled:opacity-50 [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0 [&>svg]:text-sidebar-accent-foreground data-[active=true]:bg-sidebar-accent data-[active=true]:text-sidebar-accent-foreground text-sm group-data-[collapsible=icon]:hidden">';
                            echo '<span>' . esc_html($child_item->title) . '</span>';
                            echo '</a>';
                            echo '</li>';
                          }
                          
                          echo '</ul>';
                        }
                        
                        echo '</li>';
                      }
                    }
                  }
                } else {
                  // Fallback menu items
                  $pages = [
                    ['title' => 'Home', 'url' => home_url('/')],
                    ['title' => 'About', 'url' => home_url('/about')],
                    ['title' => 'Blog', 'url' => home_url('/')]
                  ];
                  
                  foreach ($pages as $page) {
                    echo '<li data-sidebar="menu-item" class="group/menu-item relative">';
                    echo '<a href="' . esc_url($page['url']) . '" data-sidebar="menu-button" class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-none ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 group-has-[[data-sidebar=menu-action]]/menu-item:pr-8 aria-disabled:pointer-events-none aria-disabled:opacity-50 data-[active=true]:bg-sidebar-accent data-[active=true]:font-medium data-[active=true]:text-sidebar-accent-foreground data-[state=open]:hover:bg-sidebar-accent data-[state=open]:hover:text-sidebar-accent-foreground group-data-[collapsible=icon]:!size-8 group-data-[collapsible=icon]:!p-2 [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0">';
                    echo '<span>' . esc_html($page['title']) . '</span>';
                    echo '</a>';
                    echo '</li>';
                  }
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Sidebar Footer -->
        <div data-sidebar="footer" class="flex flex-col gap-2 p-4">
          <div data-sidebar="separator" class="mx-2 w-auto bg-sidebar-border h-[1px]"></div>
          <button id="theme-toggle" class="p-2 rounded-md hover:bg-accent flex items-center gap-2 w-full" aria-label="Toggle dark mode">
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
            <span>Toggle Theme</span>
          </button>
        </div>
      </div>
    </div>
    
    <!-- Sidebar Trigger Button - Attached to sidebar -->
    <button 
      id="sidebar-trigger" 
      class="fixed z-50 p-2 rounded-l-none rounded-r-md bg-[hsl(var(--sidebar-background))] text-[hsl(var(--sidebar-foreground))] hover:bg-[hsl(var(--sidebar-accent))] hover:text-[hsl(var(--sidebar-accent-foreground))] shadow-md border-t border-r border-b border-[hsl(var(--sidebar-border))] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[hsl(var(--sidebar-ring))]"
      aria-label="Toggle sidebar"
      style="top: 5.5rem; left: 0; transition: left 0.2s ease-in-out;"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
        <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
        <line x1="9" x2="9" y1="3" y2="21"></line>
      </svg>
    </button>
  </div>
  
  <!-- Mobile Sidebar -->
  <div id="mobile-sidebar" class="md:hidden pointer-events-auto">
    <div data-sidebar="sidebar" data-mobile="true" class="fixed inset-y-0 left-0 z-50 w-[18rem] bg-[hsl(var(--sidebar-background))] text-[hsl(var(--sidebar-foreground))] p-0 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-xl">
      <div class="flex h-full w-full flex-col">
        <!-- Mobile Sidebar Header -->
        <div data-sidebar="header" class="flex flex-col gap-2 p-4">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">
              <?php bloginfo('name'); ?>
            </h2>
            <button id="mobile-sidebar-close" class="p-2 rounded-md hover:bg-accent">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
              </svg>
              <span class="sr-only">Close Sidebar</span>
            </button>
          </div>
        </div>
        
        <!-- Mobile Sidebar Separator -->
        <div data-sidebar="separator" class="mx-2 w-auto bg-sidebar-border h-[1px]"></div>
        
        <!-- Mobile Sidebar Content -->
        <div data-sidebar="content" class="flex min-h-0 flex-1 flex-col gap-2 overflow-auto p-4">
          
          <!-- Mobile Search Form -->
          <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="mb-4">
            <div class="relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
              </svg>
              <input type="search" name="s" placeholder="Search..." class="w-full pl-8 rounded-md bg-muted h-10 border-0">
            </div>
          </form>
          
          <!-- Mobile Navigation -->
          <div class="space-y-4">
            <?php
            // Display mobile menu with updated styles
            if (has_nav_menu('primary')) {
              $menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['primary']);
              
              if ($menu_items) {
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
              }
            } else {
              // Fallback mobile menu items
              ?>
              <a href="<?php echo esc_url(home_url('/')); ?>" class="block text-sm font-medium transition-colors hover:text-primary">Home</a>
              <a href="<?php echo esc_url(home_url('/about')); ?>" class="block text-sm font-medium transition-colors hover:text-primary">About</a>
              <a href="<?php echo esc_url(home_url('/')); ?>" class="block text-sm font-medium transition-colors hover:text-primary">Blog</a>
              <?php
            }
            ?>
          </div>
        </div>
        
        <!-- Mobile Sidebar Footer -->
        <div data-sidebar="footer" class="p-4">
          <div data-sidebar="separator" class="mx-2 w-auto bg-sidebar-border h-[1px] mb-4"></div>
          <button id="mobile-theme-toggle" class="p-2 rounded-md hover:bg-accent flex items-center gap-2 w-full" aria-label="Toggle dark mode">
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
            <span>Toggle Theme</span>
          </button>
        </div>
      </div>
    </div>
    <!-- Mobile Sidebar Overlay -->
    <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden opacity-0 transition-opacity duration-300 ease-in-out pointer-events-auto"></div>
  </div>
</div>