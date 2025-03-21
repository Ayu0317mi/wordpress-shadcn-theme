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
  <header id="masthead" class="sticky top-0 z-40 w-full border-b bg-white dark:bg-gray-950 shadow-sm">
    <div class="container flex h-16 items-center py-4">
      <div class="flex-1 flex items-center justify-start">
        <!-- This div left empty for layout balance -->
      </div>

      <div class="flex-1 flex justify-center">
        <div class="site-branding">
          <?php if (has_custom_logo()): ?>
            <div class="site-logo"><?php the_custom_logo(); ?></div>
          <?php else: ?>
            <h1 class="site-title font-bold text-xl text-center">
              <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
            </h1>
          <?php endif; ?>
        </div>
      </div>

      <div class="flex-1 flex items-center justify-end gap-4">
        <div class="relative hidden md:block">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="absolute left-2.5 top-2.5 h-4 w-4 text-muted-foreground">
            <circle cx="11" cy="11" r="8"></circle>
            <path d="m21 21-4.3-4.3"></path>
          </svg>
          <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <input type="search" name="s" placeholder="Search..." class="w-[200px] pl-8 md:w-[200px] rounded-full bg-muted h-10 border-0">
          </form>
        </div>
      </div>
    </div>
  </header>

  <!-- Include the Sidebar -->
  <?php include(get_template_directory() . '/sidebar-provider.php'); ?>

  <div id="content" class="flex-grow">