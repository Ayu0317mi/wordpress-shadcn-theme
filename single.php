<?php
/**
 * The template for displaying all single posts
 */

get_header();
?>

<main id="primary" class="container mx-auto px-4 py-8">
  <?php while (have_posts()): the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('max-w-3xl mx-auto'); ?>>
      <header class="mb-8">
        <?php the_title('<h1 class="text-3xl font-bold tracking-tight mb-4">', '</h1>'); ?>
        
        <div class="flex items-center gap-4 text-sm text-muted-foreground">
          <div class="flex items-center gap-2">
            <?php echo get_avatar(get_the_author_meta('ID'), 32, '', '', array('class' => 'rounded-full w-8 h-8')); ?>
            <span><?php the_author(); ?></span>
          </div>
          
          <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
          
          <?php if (has_category()): ?>
            <div class="categories">
              <?php the_category(', '); ?>
            </div>
          <?php endif; ?>
        </div>
      </header>

      <?php if (has_post_thumbnail()): ?>
        <div class="mb-8 rounded-lg overflow-hidden">
          <?php the_post_thumbnail('large', ['class' => 'w-full h-auto']); ?>
        </div>
      <?php endif; ?>

      <div class="prose prose-lg max-w-none">
        <?php the_content(); ?>
      </div>

      <footer class="mt-8 pt-6 border-t">
        <?php if (has_tag()): ?>
          <div class="flex flex-wrap gap-2 mb-6">
            <?php the_tags('', '', ''); ?>
          </div>
        <?php endif; ?>
        
        <div class="flex justify-between items-center">
          <?php
          the_post_navigation(array(
            'prev_text' => '<span class="text-sm text-muted-foreground block">Previous</span><span class="font-medium">%title</span>',
            'next_text' => '<span class="text-sm text-muted-foreground block">Next</span><span class="font-medium">%title</span>',
            'class' => 'flex justify-between w-full',
          ));
          ?>
        </div>
        
        <?php
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()):
          comments_template();
        endif;
        ?>
      </footer>
    </article>
  <?php endwhile; ?>
</main>

<?php
get_footer();

