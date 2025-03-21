<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<main id="primary" class="min-h-screen bg-background text-foreground">
  <?php while (have_posts()): the_post(); ?>
    <!-- Article Header -->
    <div class="container py-8 md:py-12">
      <div class="mx-auto max-w-3xl">
        <div class="mb-8">
          <a href="<?php echo esc_url(home_url('/blog')); ?>" class="inline-flex items-center text-sm font-medium text-muted-foreground hover:text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2 h-4 w-4">
              <path d="m15 18-6-6 6-6"/>
            </svg>
            Back to all posts
          </a>
        </div>

        <div class="space-y-4">
          <div class="flex flex-wrap gap-2">
            <?php
            // Display categories as badges
            $categories = get_the_category();
            if (!empty($categories)) {
              foreach ($categories as $category) {
                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 bg-secondary text-secondary-foreground">' . esc_html($category->name) . '</a>';
              }
            }
            
            // Display tags as outline badges
            $tags = get_the_tags();
            if (!empty($tags)) {
              foreach ($tags as $tag) {
                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-input bg-background hover:bg-accent hover:text-accent-foreground">' . esc_html($tag->name) . '</a>';
              }
            }
            ?>
          </div>

          <?php the_title('<h1 class="text-3xl font-bold tracking-tight sm:text-4xl md:text-5xl">', '</h1>'); ?>

          <p class="text-xl text-muted-foreground">
            <?php echo get_the_excerpt(); ?>
          </p>

          <div class="flex items-center gap-4 pt-4">
            <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'rounded-full w-10 h-10')); ?>
            <div>
              <p class="text-sm font-medium"><?php the_author(); ?></p>
              <div class="flex items-center gap-3 text-sm text-muted-foreground">
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1 h-3 w-3">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                  </svg>
                  <?php echo get_the_date(); ?>
                </span>
                <span class="flex items-center">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1 h-3 w-3">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                  </svg>
                  <?php 
                  // Estimate reading time
                  $content = get_the_content();
                  $word_count = str_word_count(strip_tags($content));
                  $reading_time = ceil($word_count / 200); // Assuming 200 words per minute
                  echo $reading_time . ' min read';
                  ?>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Featured Image -->
    <?php if (has_post_thumbnail()): ?>
      <div class="w-full aspect-video md:aspect-[21/9] relative overflow-hidden">
        <?php the_post_thumbnail('full', ['class' => 'object-cover w-full h-full']); ?>
      </div>
    <?php endif; ?>

    <!-- Article Content -->
    <div class="container py-8 md:py-12">
      <div class="mx-auto max-w-3xl">
        <div class="flex justify-between items-center mb-8">
          <div class="flex gap-2">
            <button class="h-9 w-9 rounded-full p-0 hover:bg-accent flex items-center justify-center" aria-label="Share">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                <polyline points="16 6 12 2 8 6"></polyline>
                <line x1="12" x2="12" y1="2" y2="15"></line>
              </svg>
            </button>
            <button class="h-9 w-9 rounded-full p-0 hover:bg-accent flex items-center justify-center" aria-label="Bookmark">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z"></path>
              </svg>
            </button>
          </div>
          
          <?php if (comments_open() || get_comments_number()): ?>
            <div class="flex items-center gap-2">
              <a href="#comments" class="flex gap-1 text-sm hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
                  <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                <span><?php echo get_comments_number(); ?> Comments</span>
              </a>
            </div>
          <?php endif; ?>
        </div>

        <article id="post-<?php the_ID(); ?>" <?php post_class('prose prose-gray dark:prose-invert max-w-none'); ?>>
          <?php the_content(); ?>
        </article>

        <hr class="my-8 border-t border-border" />

        <!-- Author Bio -->
        <?php
        $author_id = get_the_author_meta('ID');
        $author_name = get_the_author_meta('display_name');
        $author_bio = get_the_author_meta('description');
        $author_position = get_the_author_meta('position') ? get_the_author_meta('position') : 'WordPress Author';
        ?>
        <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
          <div class="flex flex-col sm:flex-row gap-6">
            <?php echo get_avatar($author_id, 80, '', '', array('class' => 'rounded-full w-20 h-20')); ?>
            <div>
              <h3 class="text-lg font-medium"><?php echo esc_html($author_name); ?></h3>
              <p class="text-sm text-muted-foreground mb-4"><?php echo esc_html($author_position); ?></p>
              <?php if (!empty($author_bio)): ?>
                <p class="text-sm"><?php echo esc_html($author_bio); ?></p>
              <?php else: ?>
                <p class="text-sm">
                  <?php echo esc_html($author_name); ?> is a contributor to <?php bloginfo('name'); ?>, sharing expertise and insights on a variety of topics.
                </p>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Related Posts -->
        <?php
        // Get current post's categories
        $categories = get_the_category();
        $category_ids = array();
        
        // If there are categories, get their IDs
        if (!empty($categories)) {
          foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
          }
        }
        
        // Setup query for related posts
        $related_args = array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' => 2,
          'post__not_in' => array(get_the_ID()), // Exclude current post
          'category__in' => $category_ids,
          'orderby' => 'rand',
        );
        
        $related_posts = new WP_Query($related_args);
        
        if ($related_posts->have_posts()):
        ?>
          <div class="mt-12">
            <h2 class="text-2xl font-bold tracking-tight mb-6">Related Posts</h2>
            <div class="grid gap-6 sm:grid-cols-2">
              <?php while ($related_posts->have_posts()): $related_posts->the_post(); ?>
                <div class="overflow-hidden rounded-lg border bg-card text-card-foreground shadow-sm">
                  <div class="aspect-video overflow-hidden">
                    <?php if (has_post_thumbnail()): ?>
                      <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium', ['class' => 'object-cover w-full h-full transition-transform hover:scale-105']); ?>
                      </a>
                    <?php else: ?>
                      <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/public/placeholder.jpg" alt="<?php the_title_attribute(); ?>" class="object-cover w-full h-full transition-transform hover:scale-105">
                      </a>
                    <?php endif; ?>
                  </div>
                  
                  <div class="p-4">
                    <?php
                    // Display first category
                    $post_categories = get_the_category();
                    if (!empty($post_categories)) {
                      echo '<div class="inline-flex items-center rounded-md border px-2.5 py-0.5 text-xs font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-input bg-background mb-2">' . esc_html($post_categories[0]->name) . '</div>';
                    }
                    ?>
                    
                    <h3 class="font-medium text-lg mb-2 line-clamp-2">
                      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <p class="text-sm text-muted-foreground line-clamp-2">
                      <?php echo get_the_excerpt(); ?>
                    </p>
                    
                    <div class="flex items-center gap-2 mt-4 text-xs text-muted-foreground">
                      <span><?php echo get_the_date(); ?></span>
                      <span>•</span>
                      <span>
                        <?php 
                        $content = get_the_content();
                        $word_count = str_word_count(strip_tags($content));
                        $reading_time = ceil($word_count / 200);
                        echo $reading_time . ' min read';
                        ?>
                      </span>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
          </div>
        <?php 
        endif;
        // Reset post data back to original post
        wp_reset_postdata(); 
        ?>

        <!-- Comments Section -->
        <?php if (comments_open() || get_comments_number()): ?>
          <div id="comments" class="mt-12">
            <h2 class="text-2xl font-bold tracking-tight mb-6">
              Comments (<?php echo get_comments_number(); ?>)
            </h2>
            
            <?php
            // Arguments for comments list
            $comment_args = array(
              'style'        => 'div',
              'callback'     => 'shadcn_comment',
              'avatar_size'  => 40,
              'short_ping'   => true,
              'reply_text'   => 'Reply',
            );
            
            // Custom comment callback
            if (!function_exists('shadcn_comment')) {
              function shadcn_comment($comment, $args, $depth) {
                $GLOBALS['comment'] = $comment;
                ?>
                <div id="comment-<?php comment_ID(); ?>" <?php comment_class('flex gap-4 mb-6'); ?>>
                  <?php echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'rounded-full')); ?>
                  
                  <div class="space-y-2">
                    <div class="flex items-center gap-2">
                      <h4 class="font-medium"><?php comment_author(); ?></h4>
                      <span class="text-xs text-muted-foreground">
                        <?php 
                        $time_ago = human_time_diff(get_comment_time('U'), current_time('timestamp'));
                        echo $time_ago . ' ago'; 
                        ?>
                      </span>
                    </div>
                    
                    <div class="text-sm">
                      <?php comment_text(); ?>
                    </div>
                    
                    <div class="flex gap-4 pt-1">
                      <?php
                      comment_reply_link(array_merge($args, array(
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '<button class="text-xs text-muted-foreground hover:text-foreground">',
                        'after'     => '</button>'
                      )));
                      ?>
                      <button class="h-auto p-0 text-xs text-muted-foreground hover:text-foreground">Like</button>
                    </div>
                  </div>
                </div>
                <?php
              }
            }
            
            // Display comments list
            wp_list_comments($comment_args);
            
            // Display comment form
            $comment_form_args = array(
              'title_reply'         => '',
              'comment_notes_before' => '',
              'comment_notes_after'  => '',
              'class_form'          => 'mt-8 rounded-lg border p-4',
              'title_reply_before'  => '<h4 class="font-medium mb-4">',
              'title_reply_after'   => '</h4>',
              'submit_button'       => '<div class="mt-4 flex justify-end"><input type="submit" name="%1$s" id="%2$s" class="%3$s inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 px-4 py-2" value="%4$s" /></div>',
              'comment_field'       => '<textarea id="comment" name="comment" class="w-full min-h-[100px] rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Share your thoughts..."></textarea>',
            );
            
            comment_form($comment_form_args);
            ?>
          </div>
        <?php endif; ?>

        <!-- Post Navigation -->
        <div class="mt-12 pt-6 border-t flex flex-col sm:flex-row justify-between gap-4">
          <?php
          $prev_post = get_previous_post();
          if (!empty($prev_post)) {
            ?>
            <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="flex-1 p-4 border rounded-lg hover:bg-accent/50 transition-colors">
              <span class="text-sm text-muted-foreground block">Previous Article</span>
              <span class="font-medium"><?php echo esc_html(get_the_title($prev_post->ID)); ?></span>
            </a>
            <?php
          }
          
          $next_post = get_next_post();
          if (!empty($next_post)) {
            ?>
            <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="flex-1 p-4 border rounded-lg hover:bg-accent/50 transition-colors text-right">
              <span class="text-sm text-muted-foreground block">Next Article</span>
              <span class="font-medium"><?php echo esc_html(get_the_title($next_post->ID)); ?></span>
            </a>
            <?php
          }
          ?>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</main>

<?php
get_footer();

