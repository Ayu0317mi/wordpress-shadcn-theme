<?php
/**
 * The template for displaying the footer
 */
?>
  </div><!-- #content -->

  <footer id="colophon" class="border-t py-6 mt-auto">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
          <h2 class="font-semibold text-lg mb-4">About</h2>
          <p class="text-muted-foreground">
            <?php bloginfo('description'); ?>
          </p>
        </div>
        
        <div>
          <h2 class="font-semibold text-lg mb-4">Navigation</h2>
          <?php
          wp_nav_menu(array(
            'theme_location' => 'footer',
            'menu_id'        => 'footer-menu',
            'container'      => false,
            'menu_class'     => 'space-y-2',
            'fallback_cb'    => false,
          ));
          ?>
        </div>
        
        <div>
          <h2 class="font-semibold text-lg mb-4">Subscribe</h2>
          <div class="flex">
            <input type="email" placeholder="Email address" class="flex h-10 w-full rounded-l-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
            <button class="inline-flex items-center justify-center whitespace-nowrap rounded-r-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-10 px-4 py-2">
              Subscribe
            </button>
          </div>
        </div>
      </div>
      
      <div class="mt-8 pt-6 border-t text-center text-muted-foreground text-sm">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
      </div>
    </div>
  </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

