<?php
/**
 * The main template file
 */

get_header();

// Check if this is the front page
$is_front_page = is_front_page() && !is_home();
$featured_post_id = 0;

// Get the latest post for the featured section
if ($is_front_page) {
  $featured_args = array(
    'posts_per_page' => 1,
    'post_status' => 'publish',
  );
  $featured_query = new WP_Query($featured_args);
  
  if ($featured_query->have_posts()) {
    $featured_query->the_post();
    $featured_post_id = get_the_ID();
    
    // Featured Post Hero Section
    ?>
    <section class="container py-12 md:py-20">
      <div class="grid gap-6 lg:grid-cols-2 lg:gap-12 items-center">
        <div class="space-y-4">
          <?php
          // Display categories as badges
          $categories = get_the_category();
          if (!empty($categories)) {
            echo '<div class="flex flex-wrap gap-2 mb-2">';
            echo '<div class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-secondary text-secondary-foreground">Featured Post</div>';
            foreach ($categories as $category) {
              echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-primary/10 text-primary hover:bg-primary/20">' . esc_html($category->name) . '</a>';
            }
            echo '</div>';
          }
          ?>
          
          <h1 class="text-3xl font-bold tracking-tight sm:text-4xl md:text-5xl">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h1>
          
          <p class="text-muted-foreground">
            <?php echo get_the_excerpt(); ?>
          </p>
          
          <div class="flex items-center gap-4 pt-4">
            <?php
            echo get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'rounded-full w-10 h-10'));
            ?>
            <div>
              <p class="text-sm font-medium"><?php the_author(); ?></p>
              <p class="text-sm text-muted-foreground">
                <?php echo get_the_date(); ?> • 
                <?php 
                // Estimate reading time
                $content = get_the_content();
                $word_count = str_word_count(strip_tags($content));
                $reading_time = ceil($word_count / 200); // Assuming 200 words per minute
                echo $reading_time . ' min read';
                ?>
              </p>
            </div>
          </div>
          
          <div class="pt-4">
            <a href="<?php the_permalink(); ?>" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary text-primary-foreground hover:bg-primary/90 h-10 py-2 px-4">
              Read Article
            </a>
          </div>
        </div>
        
        <div class="aspect-video overflow-hidden rounded-xl">
          <?php
          if (has_post_thumbnail()) {
            the_post_thumbnail('large', ['class' => 'object-cover w-full h-full']);
          } else {
            // Fallback image if no featured image is set
            echo '<img src="' . get_template_directory_uri() . '/public/placeholder.jpg" alt="Featured post" class="object-cover w-full h-full">';
          }
          ?>
        </div>
      </div>
    </section>
    
    <hr class="border-t border-border">
    <?php
    // Reset post data
    wp_reset_postdata();
  }
}
?>

<main id="primary" class="container py-12 md:py-16">
  <?php if (is_home() || is_front_page()): ?>
    <div class="flex items-center justify-between mb-8">
      <h2 class="text-2xl font-bold tracking-tight">
        <?php echo $is_front_page ? 'Recent Posts' : 'Blog'; ?>
      </h2>
      <?php if ($is_front_page): ?>
        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="text-sm font-medium text-primary hover:underline">
          View all posts
        </a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
  
  <?php
  // Main query (exclude featured post if on front page)
  if ($is_front_page && $featured_post_id > 0) {
    // Create a new query to exclude the featured post
    $main_args = array(
      'post__not_in' => array($featured_post_id),
      'posts_per_page' => get_option('posts_per_page'),
      'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
    );
    $main_query = new WP_Query($main_args);
    $have_posts = $main_query->have_posts();
  } else {
    $main_query = $GLOBALS['wp_query'];
    $have_posts = have_posts();
  }
  
  if ($have_posts):
  ?>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <?php 
      while ($main_query->have_posts()): $main_query->the_post();
      ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('overflow-hidden rounded-lg border bg-card text-card-foreground shadow-sm'); ?>>
          <div class="aspect-video overflow-hidden">
            <?php if (has_post_thumbnail()): ?>
              <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium_large', ['class' => 'object-cover w-full h-full transition-transform hover:scale-105']); ?>
              </a>
            <?php else: ?>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/public/placeholder.jpg" alt="<?php the_title_attribute(); ?>" class="object-cover w-full h-full transition-transform hover:scale-105">
              </a>
            <?php endif; ?>
          </div>
          
          <div class="p-4">
            <div class="flex items-center gap-2 mb-2">
              <?php
              // Display first category as badge
              $categories = get_the_category();
              if (!empty($categories)) {
                echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '" class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-secondary text-secondary-foreground">' . esc_html($categories[0]->name) . '</a>';
              }
              ?>
              <span class="text-xs text-muted-foreground"><?php echo get_the_date(); ?></span>
            </div>
            
            <h2 class="line-clamp-2 text-xl font-semibold tracking-tight mb-2">
              <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
            
            <div class="text-muted-foreground line-clamp-3">
              <?php the_excerpt(); ?>
            </div>
            
            <div class="mt-4 pt-4 border-t flex items-center gap-4">
              <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'rounded-full w-8 h-8')); ?>
              <span class="text-sm"><?php the_author(); ?></span>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
    
    <div class="mt-8 flex justify-center">
      <?php 
      $pagination_args = array(
        'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left h-4 w-4"><path d="m15 18-6-6 6-6"/></svg><span class="sr-only">Previous Page</span>',
        'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right h-4 w-4"><path d="m9 18 6-6-6-6"/></svg><span class="sr-only">Next Page</span>',
        'class' => 'flex items-center gap-1',
      );
      
      if ($is_front_page && $featured_post_id > 0) {
        // Custom pagination for custom query
        $total_pages = $main_query->max_num_pages;
        $current_page = max(1, get_query_var('paged'));
        
        echo '<div class="flex gap-1">';
        
        // Previous page
        if ($current_page > 1) {
          echo '<a href="' . get_pagenum_link($current_page - 1) . '" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 w-9 p-0">' . $pagination_args['prev_text'] . '</a>';
        }
        
        // Page numbers
        for ($i = 1; $i <= $total_pages; $i++) {
          $active_class = $i === $current_page ? 'bg-primary text-primary-foreground hover:bg-primary/90' : 'border border-input bg-background hover:bg-accent hover:text-accent-foreground';
          echo '<a href="' . get_pagenum_link($i) . '" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 ' . $active_class . ' h-9 w-9 p-0">' . $i . '</a>';
        }
        
        // Next page
        if ($current_page < $total_pages) {
          echo '<a href="' . get_pagenum_link($current_page + 1) . '" class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 w-9 p-0">' . $pagination_args['next_text'] . '</a>';
        }
        
        echo '</div>';
      } else {
        // Standard pagination for main query
        the_posts_pagination($pagination_args);
      }
      ?>
    </div>
    
    <?php if ($is_front_page): ?>
    <!-- Newsletter Section -->
    <section class="mt-16">
      <div class="rounded-xl bg-muted p-6 md:p-8 lg:p-10">
        <div class="mx-auto max-w-2xl text-center">
          <h2 class="text-2xl font-bold tracking-tight md:text-3xl">Subscribe to our newsletter</h2>
          <p class="mt-4 text-muted-foreground">
            Get the latest articles, resources, and updates delivered straight to your inbox.
          </p>
          <div class="mt-6 flex flex-col sm:flex-row gap-2 mx-auto max-w-md">
            <input type="email" placeholder="Enter your email" class="flex-1 h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:opacity-50 disabled:pointer-events-none bg-primary text-primary-foreground hover:bg-primary/90 h-10 py-2 px-4">Subscribe</button>
          </div>
          <p class="mt-4 text-xs text-muted-foreground">
            By subscribing, you agree to our Privacy Policy and consent to receive updates from our company.
          </p>
        </div>
      </div>
    </section>
    <?php endif; ?>
    
  <?php else: ?>
    <div class="prose max-w-none">
      <h1><?php esc_html_e('Nothing Found', 'shadcn-wp'); ?></h1>
      <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'shadcn-wp'); ?></p>
    </div>
  <?php 
  endif;
  
  // Reset postdata if custom query was used
  if ($is_front_page && $featured_post_id > 0) {
    wp_reset_postdata();
  }
  ?>
</main>

<?php
get_footer();

