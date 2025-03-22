<?php
/**
 * Modern Sidebar Provider for the theme
 * Uses shadcn/ui components styling
 */
?>

<div id="sidebar-wrapper" class="fixed top-0 left-0 z-40 h-full">
  <!-- Sidebar Component -->
  <div id="sidebar" class="group text-sidebar-foreground shadow-xl" data-state="expanded" data-collapsible="" data-variant="sidebar" data-side="left">
    <!-- Sidebar fixed container -->
    <div class="fixed inset-y-0 left-0 z-10 h-full w-[280px] flex-col transform -translate-x-full transition-transform duration-200 ease-in-out shadow-xl border-r border-border">
      <div data-sidebar="sidebar" class="flex h-full w-full flex-col bg-background text-foreground">
        
        <!-- Sidebar Header -->
        <div data-sidebar="header" class="flex flex-col gap-2 p-4 border-b">
          <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">
              <?php bloginfo('name'); ?>
            </h2>
            <button id="sidebar-toggle" class="p-2 rounded-md hover:bg-accent flex items-center justify-center h-7 w-7">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <path d="M19 12H5M12 19l-7-7 7-7"></path>
              </svg>
              <span class="sr-only">Toggle Sidebar</span>
            </button>
          </div>
        </div>
        
        <!-- Sidebar Content -->
        <div data-sidebar="content" class="flex min-h-0 flex-1 flex-col gap-2 overflow-auto p-4">
          
          <!-- Search Group -->
          <div data-sidebar="group" class="relative flex w-full min-w-0 flex-col p-2 pb-6">
            <div data-sidebar="group-label" class="flex h-8 shrink-0 items-center rounded-md px-2 text-xs font-medium text-muted-foreground mb-2">
              Search
            </div>
            <div data-sidebar="group-content" class="w-full text-sm">
              <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground">
                  <circle cx="11" cy="11" r="8"></circle>
                  <path d="m21 21-4.3-4.3"></path>
                </svg>
                <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                  <input type="search" name="s" placeholder="Search..." class="w-full pl-8 rounded-md h-10 border bg-background">
                </form>
              </div>
            </div>
          </div>
          
          <!-- Navigation Group -->
          <div data-sidebar="group" class="relative flex w-full min-w-0 flex-col p-2">
            <div data-sidebar="group-label" class="flex h-8 shrink-0 items-center rounded-md px-2 text-xs font-medium text-muted-foreground mb-2">
              Navigation
            </div>
            <div data-sidebar="group-content" class="w-full text-sm">
              <ul data-sidebar="menu" class="flex w-full min-w-0 flex-col gap-1 pb-4">
                <?php
                // Display menu in sidebar with modern styling
                if (has_nav_menu('primary')) {
                  $menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['primary']);
                  
                  if ($menu_items) {
                    // Sort menu items by menu order
                    usort($menu_items, function($a, $b) {
                      return $a->menu_order - $b->menu_order;
                    });
                    
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
                        // Check if current page
                        $current = (is_home() && $menu_item->object_id == get_option('page_for_posts')) || 
                                   (is_front_page() && $menu_item->object_id == get_option('page_on_front')) ||
                                   ($menu_item->object_id == get_queried_object_id());
                        
                        echo '<li data-sidebar="menu-item" class="group/menu-item relative">';
                        
                        echo '<a href="' . esc_url($menu_item->url) . '" data-sidebar="menu-button" data-active="' . ($current ? 'true' : 'false') . '" 
                        class="flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm font-medium outline-none transition-colors hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground">';
                        
                        // Add appropriate icon based on menu item title
                        $icon = get_menu_item_icon($menu_item->title);
                        echo $icon;
                        
                        echo '<span>' . esc_html($menu_item->title) . '</span>';
                        
                        if ($has_children) {
                          echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-auto h-4 w-4 shrink-0 opacity-50"><path d="m9 18 6-6-6-6"></path></svg>';
                        }
                        
                        echo '</a>';
                        
                        if ($has_children) {
                          echo '<ul data-sidebar="menu-sub" class="pl-6 pt-1 flex min-w-0 flex-col gap-1">';
                          
                          foreach ($child_items as $child_item) {
                            $child_current = $child_item->object_id == get_queried_object_id();
                            
                            echo '<li>';
                            echo '<a href="' . esc_url($child_item->url) . '" data-sidebar="menu-sub-button" data-active="' . ($child_current ? 'true' : 'false') . '" 
                            class="flex h-8 min-w-0 items-center gap-2 rounded-md px-2 text-foreground outline-none hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground text-sm">';
                            echo '<div class="h-1 w-1 rounded-full bg-foreground/50"></div>';
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
                  $pages = get_pages(['sort_column' => 'menu_order']);
                  
                  // Home link
                  echo '<li data-sidebar="menu-item" class="group/menu-item relative">';
                  echo '<a href="' . esc_url(home_url('/')) . '" data-sidebar="menu-button" data-active="' . (is_home() || is_front_page() ? 'true' : 'false') . '" 
                  class="flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm font-medium outline-none transition-colors hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground">';
                  echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>';
                  echo '<span>Home</span>';
                  echo '</a>';
                  echo '</li>';
                  
                  // List all pages
                  foreach ($pages as $page) {
                    echo '<li data-sidebar="menu-item" class="group/menu-item relative">';
                    echo '<a href="' . esc_url(get_permalink($page->ID)) . '" data-sidebar="menu-button" data-active="' . (is_page($page->ID) ? 'true' : 'false') . '" 
                    class="flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm font-medium outline-none transition-colors hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground">';
                    
                    // Add icon based on page title
                    $icon = get_menu_item_icon($page->post_title);
                    echo $icon;
                    
                    echo '<span>' . esc_html($page->post_title) . '</span>';
                    echo '</a>';
                    echo '</li>';
                  }
                  
                  // Blog link if different from home
                  if (get_option('page_for_posts') && get_option('page_for_posts') != get_option('page_on_front')) {
                    echo '<li data-sidebar="menu-item" class="group/menu-item relative">';
                    echo '<a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '" data-sidebar="menu-button" data-active="' . (is_home() && !is_front_page() ? 'true' : 'false') . '" 
                    class="flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm font-medium outline-none transition-colors hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground">';
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>';
                    echo '<span>Blog</span>';
                    echo '</a>';
                    echo '</li>';
                  }
                }
                ?>
              </ul>
            </div>
          </div>
          
          <!-- Categories Group -->
          <div data-sidebar="group" class="relative flex w-full min-w-0 flex-col p-2">
            <div data-sidebar="group-label" class="flex h-8 shrink-0 items-center rounded-md px-2 text-xs font-medium text-muted-foreground mb-2">
              Categories
            </div>
            <div data-sidebar="group-content" class="w-full text-sm">
              <ul data-sidebar="menu" class="flex w-full min-w-0 flex-col gap-1">
                <?php
                $categories = get_categories([
                  'orderby' => 'name',
                  'order' => 'ASC',
                  'hide_empty' => true,
                ]);
                
                foreach ($categories as $category) {
                  $is_current = is_category($category->term_id);
                  
                  echo '<li data-sidebar="menu-item" class="group/menu-item relative">';
                  echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" data-sidebar="menu-button" data-active="' . ($is_current ? 'true' : 'false') . '" 
                  class="flex w-full items-center gap-2 overflow-hidden rounded-md p-2 text-left text-sm outline-none transition-colors hover:bg-accent hover:text-accent-foreground data-[active=true]:bg-accent data-[active=true]:text-accent-foreground">';
                  echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"></path></svg>';
                  echo '<span>' . esc_html($category->name) . '</span>';
                  echo '<span class="ml-auto text-xs text-muted-foreground">' . $category->count . '</span>';
                  echo '</a>';
                  echo '</li>';
                }
                ?>
              </ul>
            </div>
          </div>
        </div>
        
        <!-- Sidebar Footer -->
        <div data-sidebar="footer" class="mt-auto flex flex-col gap-2 p-4 border-t">
          <button id="theme-toggle" class="flex items-center gap-2 w-full rounded-md p-2 text-sm hover:bg-accent hover:text-accent-foreground transition-colors" aria-label="Toggle dark mode">
            <!-- Sun icon (shown in dark mode) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:block hidden h-4 w-4">
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
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:hidden h-4 w-4">
              <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
            </svg>
            <span>Switch Mode</span>
          </button>
        </div>
      </div>
    </div>
    
    <!-- Sidebar Trigger Button -->
    <button 
      id="sidebar-trigger" 
      class="fixed z-50 p-2 rounded-l-none rounded-r-md bg-background text-foreground hover:bg-accent hover:text-accent-foreground shadow-md border-t border-r border-b border focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
      aria-label="Toggle sidebar"
      style="top: 1rem; left: 0; transition: left 0.2s ease-in-out, transform 0.2s ease-in-out;"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
        <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
        <line x1="9" x2="9" y1="3" y2="21"></line>
      </svg>
    </button>
  </div>
  
  <!-- Mobile Sidebar -->
  <div id="mobile-sidebar" class="md:hidden">
    <div data-sidebar="sidebar" data-mobile="true" class="fixed inset-y-0 left-0 z-50 w-[280px] bg-background text-foreground p-0 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-xl border-r">
      <div class="flex h-full w-full flex-col">
        <!-- Mobile Sidebar Header -->
        <div data-sidebar="header" class="flex flex-col gap-2 p-4 border-b">
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
        
        <!-- Mobile Sidebar Content -->
        <div data-sidebar="content" class="flex min-h-0 flex-1 flex-col gap-4 overflow-auto p-4">
          
          <!-- Mobile Search Form -->
          <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="mb-4">
            <div class="relative">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.3-4.3"></path>
              </svg>
              <input type="search" name="s" placeholder="Search..." class="w-full pl-8 rounded-md h-10 border bg-background">
            </div>
          </form>
          
          <!-- Mobile Navigation -->
          <div class="space-y-1">
            <div class="text-xs font-medium text-muted-foreground mb-2 px-2">Navigation</div>
            <?php
            // Display mobile menu with updated styles
            if (has_nav_menu('primary')) {
              $menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['primary']);
              
              if ($menu_items) {
                foreach ($menu_items as $menu_item) {
                  // Only display top level menu items
                  if ($menu_item->menu_item_parent == 0) {
                    // Check if current page
                    $current = (is_home() && $menu_item->object_id == get_option('page_for_posts')) || 
                               (is_front_page() && $menu_item->object_id == get_option('page_on_front')) ||
                               ($menu_item->object_id == get_queried_object_id());
                    
                    // Check if this item has children
                    $has_children = false;
                    $child_items = array();
                    
                    foreach ($menu_items as $possible_child) {
                      if ($possible_child->menu_item_parent == $menu_item->ID) {
                        $has_children = true;
                        $child_items[] = $possible_child;
                      }
                    }
                    
                    // Parent items
                    echo '<a href="' . esc_url($menu_item->url) . '" class="flex items-center gap-2 rounded-md p-2 text-sm font-medium ' . ($current ? 'bg-accent text-accent-foreground' : 'hover:bg-accent hover:text-accent-foreground') . '">';
                    
                    // Add icon based on menu item title
                    $icon = get_menu_item_icon($menu_item->title);
                    echo $icon;
                    
                    echo esc_html($menu_item->title);
                    echo '</a>';
                    
                    // Child items if any
                    if ($has_children) {
                      echo '<div class="pl-6 mt-1 space-y-1">';
                      foreach ($child_items as $child_item) {
                        $child_current = $child_item->object_id == get_queried_object_id();
                        echo '<a href="' . esc_url($child_item->url) . '" class="flex items-center gap-2 rounded-md p-2 text-sm ' . ($child_current ? 'bg-accent text-accent-foreground' : 'hover:bg-accent hover:text-accent-foreground') . '">';
                        echo '<div class="h-1 w-1 rounded-full bg-foreground/50"></div>';
                        echo esc_html($child_item->title);
                        echo '</a>';
                      }
                      echo '</div>';
                    }
                  }
                }
              }
            } else {
              // Fallback mobile menu items - show all pages
              $pages = get_pages(['sort_column' => 'menu_order']);
              
              // Home link
              echo '<a href="' . esc_url(home_url('/')) . '" class="flex items-center gap-2 rounded-md p-2 text-sm font-medium ' . (is_home() || is_front_page() ? 'bg-accent text-accent-foreground' : 'hover:bg-accent hover:text-accent-foreground') . '">';
              echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>';
              echo 'Home';
              echo '</a>';
              
              // List all pages
              foreach ($pages as $page) {
                echo '<a href="' . esc_url(get_permalink($page->ID)) . '" class="flex items-center gap-2 rounded-md p-2 text-sm font-medium ' . (is_page($page->ID) ? 'bg-accent text-accent-foreground' : 'hover:bg-accent hover:text-accent-foreground') . '">';
                
                // Add icon based on page title
                $icon = get_menu_item_icon($page->post_title);
                echo $icon;
                
                echo esc_html($page->post_title);
                echo '</a>';
              }
              
              // Blog link if different from home
              if (get_option('page_for_posts') && get_option('page_for_posts') != get_option('page_on_front')) {
                echo '<a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '" class="flex items-center gap-2 rounded-md p-2 text-sm font-medium ' . (is_home() && !is_front_page() ? 'bg-accent text-accent-foreground' : 'hover:bg-accent hover:text-accent-foreground') . '">';
                echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>';
                echo 'Blog';
                echo '</a>';
              }
            }
            ?>
          </div>
          
          <!-- Mobile Categories -->
          <div class="space-y-1 mt-4">
            <div class="text-xs font-medium text-muted-foreground mb-2 px-2">Categories</div>
            <?php
            $categories = get_categories([
              'orderby' => 'name',
              'order' => 'ASC',
              'hide_empty' => true,
            ]);
            
            foreach ($categories as $category) {
              $is_current = is_category($category->term_id);
              
              echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="flex items-center justify-between rounded-md p-2 text-sm ' . ($is_current ? 'bg-accent text-accent-foreground' : 'hover:bg-accent hover:text-accent-foreground') . '">';
              echo '<div class="flex items-center gap-2">';
              echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"></path></svg>';
              echo esc_html($category->name);
              echo '</div>';
              echo '<span class="text-xs text-muted-foreground">' . $category->count . '</span>';
              echo '</a>';
            }
            ?>
          </div>
        </div>
        
        <!-- Mobile Sidebar Footer -->
        <div data-sidebar="footer" class="mt-auto p-4 border-t">
          <button id="mobile-theme-toggle" class="flex items-center gap-2 w-full rounded-md p-2 text-sm hover:bg-accent hover:text-accent-foreground transition-colors" aria-label="Toggle dark mode">
            <!-- Sun icon (shown in dark mode) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:block hidden h-4 w-4">
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
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:hidden h-4 w-4">
              <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
            </svg>
            <span>Toggle Theme</span>
          </button>
        </div>
      </div>
    </div>
    <!-- Mobile Sidebar Overlay -->
    <div id="mobile-sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden opacity-0 transition-opacity duration-300 ease-in-out"></div>
  </div>
</div>

<?php
// Helper function to get menu item icon based on title
function get_menu_item_icon($title) {
  $title = strtolower($title);
  
  if (strpos($title, 'home') !== false) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>';
  } elseif (strpos($title, 'about') !== false) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>';
  } elseif (strpos($title, 'blog') !== false || strpos($title, 'post') !== false || strpos($title, 'news') !== false) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M12 20h9"></path><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path></svg>';
  } elseif (strpos($title, 'contact') !== false) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>';
  } elseif (strpos($title, 'service') !== false) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="m8 3 4 8 5-5 5 15H2L8 3z"></path></svg>';
  } elseif (strpos($title, 'product') !== false || strpos($title, 'shop') !== false) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><circle cx="8" cy="21" r="1"></circle><circle cx="19" cy="21" r="1"></circle><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"></path></svg>';
  } elseif (strpos($title, 'portfolio') !== false || strpos($title, 'project') !== false || strpos($title, 'work') !== false) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><rect width="20" height="14" x="2" y="7" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>';
  } elseif (strpos($title, 'team') !== false || strpos($title, 'staff') !== false) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>';
  } elseif (strpos($title, 'faq') !== false) {
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><path d="M12 17h.01"></path></svg>';
  } else {
    // Default icon
    return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M21 7v10c0 3-3 4-6 4H9c-3 0-6-1-6-4V7c0-3 3-4 6-4h6c3 0 6 1 6 4Z"></path><path d="M12 3v18"></path><path d="M3 10h18"></path><path d="M3 14h18"></path></svg>';
  }
}
?>