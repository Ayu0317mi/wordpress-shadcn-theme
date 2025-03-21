<?php
/**
 * Template Name: About Page
 * Description: A template for the About page
 */

get_header();
?>

<main id="primary" class="min-h-screen bg-background text-foreground">
  <div class="container py-12 md:py-16">
    <div class="mx-auto max-w-4xl">
      <!-- Hero Section -->
      <div class="text-center mb-12">
        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl md:text-6xl mb-6">
          WordPress + Shadcn UI
        </h1>
        <p class="text-xl text-muted-foreground mx-auto max-w-3xl">
          A modern WordPress theme that combines the power of WordPress with the elegance of Shadcn UI components and Tailwind CSS.
        </p>
      </div>

      <!-- Features Section -->
      <div class="grid gap-8 md:gap-12 mb-16">
        <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
          <div class="space-y-4">
            <div class="inline-flex items-center justify-center rounded-md bg-primary/10 p-2 text-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                <path d="m2 12 3-3 3 3-3 3-3-3Z"></path>
                <path d="m19 12-3-3-3 3 3 3 3-3Z"></path>
                <path d="m12 19-3-3-3 3 3 3 3-3Z"></path>
                <path d="m12 5-3-3-3 3 3 3 3-3Z"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold tracking-tight">Modern UI Components</h3>
            <p class="text-muted-foreground">
              This theme integrates Shadcn UI components into WordPress, providing beautiful, accessible, and customizable UI elements that work seamlessly within the WordPress ecosystem.
            </p>
            <ul class="grid gap-2 pt-2">
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>40+ prebuild UI components</span>
              </li>
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Customizable with the WordPress Customizer</span>
              </li>
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Fully responsive design for all screen sizes</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
          <div class="space-y-4">
            <div class="inline-flex items-center justify-center rounded-md bg-primary/10 p-2 text-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="M8 12h8"></path>
                <path d="M12 16V8"></path>
              </svg>
            </div>
            <h3 class="text-2xl font-bold tracking-tight">Dark Mode Support</h3>
            <p class="text-muted-foreground">
              Enjoy a seamless dark mode experience with automatic detection of system preferences and a toggle to switch between light and dark themes.
            </p>
            <ul class="grid gap-2 pt-2">
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>System preference detection</span>
              </li>
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>User preference saving with localStorage</span>
              </li>
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Optimized color scheme transitions</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
          <div class="space-y-4">
            <div class="inline-flex items-center justify-center rounded-md bg-primary/10 p-2 text-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                <polyline points="21 15 16 10 5 21"></polyline>
              </svg>
            </div>
            <h3 class="text-2xl font-bold tracking-tight">Advanced Blog Features</h3>
            <p class="text-muted-foreground">
              A sophisticated blog experience with modern layouts, reading time estimation, author profiles, and related posts functionality.
            </p>
            <ul class="grid gap-2 pt-2">
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Featured post section with card layout</span>
              </li>
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Reading time estimation for articles</span>
              </li>
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Related posts by category</span>
              </li>
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Styled author profiles and bios</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
          <div class="space-y-4">
            <div class="inline-flex items-center justify-center rounded-md bg-primary/10 p-2 text-primary">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                <path d="M12.89 1.45l8 4A2 2 0 0 1 22 7.24v9.53a2 2 0 0 1-1.11 1.79l-8 4a2 2 0 0 1-1.79 0l-8-4a2 2 0 0 1-1.1-1.8V7.24a2 2 0 0 1 1.11-1.79l8-4a2 2 0 0 1 1.78 0z"></path>
                <polyline points="2.32 6.16 12 11 21.68 6.16"></polyline>
                <line x1="12" x2="12" y1="22.76" y2="11"></line>
              </svg>
            </div>
            <h3 class="text-2xl font-bold tracking-tight">Tailwind CSS Integration</h3>
            <p class="text-muted-foreground">
              Built with Tailwind CSS for utility-first styling that makes customization easy and keeps the codebase clean and maintainable.
            </p>
            <ul class="grid gap-2 pt-2">
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Consistent design system with Tailwind variables</span>
              </li>
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Custom color palette with HSL variables</span>
              </li>
              <li class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 text-primary">
                  <path d="M20 6 9 17l-5-5"></path>
                </svg>
                <span>Typography plugin for beautiful content styling</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Technical Details -->
      <div class="mb-16">
        <h2 class="text-3xl font-bold tracking-tight mb-6">Technical Details</h2>
        <div class="rounded-lg border bg-card p-6 text-card-foreground shadow-sm">
          <div class="space-y-4">
            <p>This WordPress theme combines several modern technologies to deliver a superior web experience:</p>
            
            <h4 class="font-semibold text-lg">Core Technologies</h4>
            <ul class="list-disc pl-6 space-y-1">
              <li>WordPress as the content management system</li>
              <li>Shadcn UI components for beautiful interface elements</li>
              <li>Tailwind CSS for utility-first styling</li>
              <li>Next.js integration for optimized React components</li>
            </ul>

            <h4 class="font-semibold text-lg">Key Features</h4>
            <ul class="list-disc pl-6 space-y-1">
              <li>Responsive design across all device sizes</li>
              <li>Dark mode support with system preference detection</li>
              <li>Optimized typography for content-rich websites</li>
              <li>Modern navigation with dropdown support</li>
              <li>Custom footer with widget areas</li>
              <li>Enhanced blog layout with featured posts</li>
              <li>Reading time estimation</li>
              <li>Author profiles and bios</li>
              <li>Related posts functionality</li>
              <li>Styled comments with threading</li>
              <li>Placeholder image generation</li>
              <li>Social sharing integration</li>
            </ul>

            <h4 class="font-semibold text-lg">Performance Optimizations</h4>
            <ul class="list-disc pl-6 space-y-1">
              <li>Optimized asset loading</li>
              <li>Responsive image handling</li>
              <li>Efficient theme switching without page reload</li>
              <li>Lightweight and fast-loading components</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Call to Action -->
      <div class="text-center">
        <h2 class="text-3xl font-bold tracking-tight mb-4">Ready to Get Started?</h2>
        <p class="text-xl text-muted-foreground mb-8 max-w-2xl mx-auto">
          Start building modern WordPress websites with the power of Shadcn UI components and Tailwind CSS.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
          <a href="#" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 px-8 py-3">
            Documentation
          </a>
          <a href="#" class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground px-8 py-3">
            View on GitHub
          </a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
get_footer();