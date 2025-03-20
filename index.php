<?php
/**
 * The main template file
 */

get_header();
?>

<main id="primary" class="container mx-auto px-4 py-8">
  <?php if (have_posts()): ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php while (have_posts()): the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('rounded-lg border bg-card text-card-foreground shadow-sm overflow-hidden'); ?>>
          <?php if (has_post_thumbnail()): ?>
            <div class="aspect-video overflow-hidden">
              <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover']); ?>
            </div>
          <?php endif; ?>
          
          <div class="p-6">
            <header class="mb-4">
              <?php the_title('<h2 class="text-xl font-semibold tracking-tight mb-2"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
              
              <div class="text-sm text-muted-foreground">
                <?php
                printf(
                  esc_html__('Posted on %s', 'shadcn-wp'),
                  '<time datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>'
                );
                ?>
              </div>
            </header>

            <div class="entry-content prose prose-sm max-w-none">
              <?php the_excerpt(); ?>
            </div>
            
            <div class="mt-4 pt-4 border-t flex justify-between items-center">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 px-4 py-2">
                Read more
              </a>
              
              <?php if (has_category()): ?>
                <div class="text-sm text-muted-foreground">
                  <?php the_category(', '); ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
    </div>
    
    <div class="mt-8 flex justify-center">
      <?php the_posts_pagination(array(
        'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>',
        'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>',
        'class' => 'flex items-center gap-1',
      )); ?>
    </div>
  <?php else: ?>
    <div class="prose max-w-none">
      <h1><?php esc_html_e('Nothing Found', 'shadcn-wp'); ?></h1>
      <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for.', 'shadcn-wp'); ?></p>
    </div>
  <?php endif; ?>
</main>

<?php
get_footer();

