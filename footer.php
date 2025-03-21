<?php
/**
 * The template for displaying the footer
 */
?>
  </div><!-- #content -->

  <footer id="colophon" class="border-t bg-background mt-auto">
    <div class="container py-8 md:py-12">
      <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-4">
        <div>
          <h3 class="text-lg font-medium mb-4">About</h3>
          <p class="text-sm text-muted-foreground">
            <?php bloginfo('description'); ?>
            A modern blog theme built with shadcn/ui components, focusing on clean design and excellent readability.
          </p>
        </div>
        
        <div>
          <h3 class="text-lg font-medium mb-4">Categories</h3>
          <ul class="space-y-2 text-sm">
            <?php
            $categories = get_categories(array(
              'orderby' => 'name',
              'order'   => 'ASC',
              'number'  => 4
            ));
            
            if (!empty($categories)) {
              foreach ($categories as $category) {
                echo '<li>';
                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="text-muted-foreground hover:text-foreground">' . esc_html($category->name) . '</a>';
                echo '</li>';
              }
            } else {
              // Fallback categories if none exist
              ?>
              <li><a href="#" class="text-muted-foreground hover:text-foreground">Technology</a></li>
              <li><a href="#" class="text-muted-foreground hover:text-foreground">Design</a></li>
              <li><a href="#" class="text-muted-foreground hover:text-foreground">Development</a></li>
              <li><a href="#" class="text-muted-foreground hover:text-foreground">Tutorials</a></li>
              <?php
            }
            ?>
          </ul>
        </div>
        
        <div>
          <h3 class="text-lg font-medium mb-4">Links</h3>
          <?php
          wp_nav_menu(array(
            'theme_location' => 'footer',
            'menu_id'        => 'footer-menu',
            'container'      => false,
            'menu_class'     => 'space-y-2 text-sm',
            'fallback_cb'    => false,
            'link_before'    => '<span class="text-muted-foreground hover:text-foreground">',
            'link_after'     => '</span>',
          ));
          
          // Display fallback navigation if no menu is set
          if (!has_nav_menu('footer')) {
            ?>
            <ul class="space-y-2 text-sm">
              <li><a href="<?php echo esc_url(home_url('/about')); ?>" class="text-muted-foreground hover:text-foreground">About Us</a></li>
              <li><a href="<?php echo esc_url(home_url('/privacy')); ?>" class="text-muted-foreground hover:text-foreground">Privacy Policy</a></li>
              <li><a href="<?php echo esc_url(home_url('/terms')); ?>" class="text-muted-foreground hover:text-foreground">Terms of Service</a></li>
            </ul>
            <?php
          }
          ?>
        </div>
        
        <div>
          <h3 class="text-lg font-medium mb-4">Subscribe</h3>
          <div class="flex flex-col gap-4">
            <p class="text-sm text-muted-foreground">Get the latest articles and updates delivered straight to your inbox.</p>
            <div class="flex">
              <input type="email" placeholder="Email address" class="flex h-10 w-full rounded-l-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
              <button class="inline-flex items-center justify-center whitespace-nowrap rounded-r-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
                Subscribe
              </button>
            </div>
            <p class="text-xs text-muted-foreground">By subscribing, you agree to our Privacy Policy.</p>
          </div>
          
          <div class="mt-6">
            <h4 class="text-sm font-medium mb-3">Follow Us</h4>
            <div class="flex space-x-4">
              <a href="#" class="p-2 rounded-md hover:bg-accent transition-colors" aria-label="Twitter">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                  <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"></path>
                </svg>
              </a>
              <a href="#" class="p-2 rounded-md hover:bg-accent transition-colors" aria-label="Facebook">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                  <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                </svg>
              </a>
              <a href="#" class="p-2 rounded-md hover:bg-accent transition-colors" aria-label="Instagram">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                  <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                  <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                  <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"></line>
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="mt-8 border-t pt-8 flex flex-col sm:flex-row justify-between items-center">
        <p class="text-sm text-muted-foreground">
          &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
        </p>
        <p class="text-sm text-muted-foreground mt-4 sm:mt-0">Built with shadcn/ui components</p>
      </div>
    </div>
  </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

