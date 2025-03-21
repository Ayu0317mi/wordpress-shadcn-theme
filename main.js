// This file integrates the WordPress theme with the blog components
// It provides compatibility for both the theme system and React components

document.addEventListener('DOMContentLoaded', () => {
  // Toggle mobile menu
  const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
  const mobileMenu = document.getElementById("mobile-menu");
  
  if (mobileMenuToggle && mobileMenu) {
    mobileMenuToggle.addEventListener("click", function() {
      mobileMenu.classList.toggle("hidden");
    });
  }
  
  // Dark mode toggle functionality
  const themeToggleButton = document.getElementById("theme-toggle");
  
  if (themeToggleButton) {
    themeToggleButton.addEventListener("click", function() {
      const isDark = document.documentElement.classList.toggle("dark");
      localStorage.setItem("theme", isDark ? "dark" : "light");
      
      // Update the cookie so PHP can access the theme preference
      document.cookie = `theme=${isDark ? 'dark' : 'light'}; path=/; max-age=31536000`;
      
      // Dispatch a custom event for React components
      window.dispatchEvent(new CustomEvent('theme-change', {
        detail: { theme: isDark ? 'dark' : 'light' }
      }));
    });
  }
  
  // Initialize theme based on stored preference or system preference
  initializeTheme();
  
  // Add smooth scroll for comment links
  const commentLinks = document.querySelectorAll('a[href*="#comments"]');
  if (commentLinks.length > 0) {
    commentLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        const commentSection = document.querySelector(this.getAttribute('href'));
        if (commentSection) {
          commentSection.scrollIntoView({ behavior: 'smooth' });
        }
      });
    });
  }
  
  // Initialize image hover effects
  initializeImageHoverEffects();
});

// Initialize theme based on local storage or system preference
function initializeTheme() {
  const userTheme = localStorage.getItem('theme');
  const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  
  if (userTheme === 'dark' || (userTheme === 'system' && systemPrefersDark) || (!userTheme && systemPrefersDark)) {
    document.documentElement.classList.add('dark');
    document.cookie = 'theme=dark; path=/; max-age=31536000';
  } else {
    document.documentElement.classList.remove('dark');
    document.cookie = 'theme=light; path=/; max-age=31536000';
  }
  
  // Listen for system changes
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', ({ matches }) => {
    if (localStorage.getItem('theme') === 'system') {
      if (matches) {
        document.documentElement.classList.add('dark');
        document.cookie = 'theme=dark; path=/; max-age=31536000';
      } else {
        document.documentElement.classList.remove('dark');
        document.cookie = 'theme=light; path=/; max-age=31536000';
      }
    }
  });
}

// Add image hover effects to post thumbnails
function initializeImageHoverEffects() {
  const thumbnails = document.querySelectorAll('.aspect-video img');
  
  thumbnails.forEach(img => {
    img.addEventListener('mouseenter', function() {
      this.style.transform = 'scale(1.05)';
      this.style.transition = 'transform 0.3s ease';
    });
    
    img.addEventListener('mouseleave', function() {
      this.style.transform = 'scale(1)';
    });
  });
}