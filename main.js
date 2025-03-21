// This file integrates the WordPress theme with the blog components
// It provides compatibility for both the theme system and React components

document.addEventListener('DOMContentLoaded', () => {
  // Sidebar functionality
  const sidebar = document.getElementById("sidebar");
  const sidebarContent = sidebar?.querySelector(".fixed");
  const mobileSidebar = document.getElementById("mobile-sidebar");
  const mobileSidebarContent = mobileSidebar?.querySelector("[data-sidebar='sidebar']");
  const mobileSidebarOverlay = document.getElementById("mobile-sidebar-overlay");
  const sidebarTrigger = document.getElementById("sidebar-trigger");
  const sidebarToggle = document.getElementById("sidebar-toggle");
  const mobileSidebarClose = document.getElementById("mobile-sidebar-close");
  
  // Variables for sidebar state
  const SIDEBAR_COOKIE_NAME = "sidebar:state";
  const SIDEBAR_COOKIE_MAX_AGE = 60 * 60 * 24 * 7; // 7 days
  
  // Get the initial sidebar state from cookie
  function getSidebarState() {
    const match = document.cookie.match(new RegExp('(^|;)\\s*' + SIDEBAR_COOKIE_NAME + '\\s*=\\s*([^;]+)'));
    return match ? match[2] === 'true' : true; // Default to expanded
  }
  
  // Set the sidebar state
  function setSidebarState(expanded) {
    if (sidebar && sidebarContent) {
      sidebar.dataset.state = expanded ? "expanded" : "collapsed";
      sidebar.dataset.collapsible = expanded ? "" : "offcanvas";
      
      // Transform the sidebar instead of adjusting content margin
      sidebarContent.style.transform = expanded ? "translateX(0)" : "translateX(-100%)";
      
      // Set cookie
      document.cookie = `${SIDEBAR_COOKIE_NAME}=${expanded}; path=/; max-age=${SIDEBAR_COOKIE_MAX_AGE}`;
      
      // Move trigger button with sidebar
      if (sidebarTrigger) {
        // Use transition for smooth movement
        sidebarTrigger.style.transition = "left 0.2s ease-in-out";
        sidebarTrigger.style.left = expanded ? "16rem" : "0";
      }
    }
  }
  
  // Toggle desktop sidebar
  function toggleSidebar() {
    const isExpanded = sidebar?.dataset.state === "expanded";
    setSidebarState(!isExpanded);
  }
  
  // Toggle mobile sidebar
  function toggleMobileSidebar(open) {
    if (mobileSidebarContent && mobileSidebarOverlay) {
      if (open) {
        // First show the overlay but with opacity 0
        mobileSidebarOverlay.classList.remove("hidden");
        
        // Force a reflow to make sure the hidden removal is processed
        void mobileSidebarOverlay.offsetWidth;
        
        // Now fade in the overlay and slide in the sidebar
        mobileSidebarOverlay.style.opacity = "1";
        mobileSidebarContent.style.transform = "translateX(0)";
      } else {
        // First fade out and slide out
        mobileSidebarOverlay.style.opacity = "0";
        mobileSidebarContent.style.transform = "translateX(-100%)";
        
        // Hide the overlay after transition completes
        setTimeout(() => {
          mobileSidebarOverlay.classList.add("hidden");
        }, 300); // Match the transition duration
      }
    }
  }
  
  // Initialize sidebar state
  const initialSidebarState = getSidebarState();
  
  // Small delay to ensure all DOM elements are properly loaded before applying transitions
  setTimeout(() => {
    setSidebarState(initialSidebarState);
    
    // Make transitions visible only after initial state is set
    if (sidebarContent) {
      sidebarContent.style.transition = "transform 0.2s ease-in-out";
    }
  }, 50);
  
  // Add event listeners for sidebar
  if (sidebarTrigger) {
    sidebarTrigger.addEventListener("click", function() {
      const isMobile = window.innerWidth < 768;
      if (isMobile) {
        toggleMobileSidebar(true);
      } else {
        toggleSidebar();
      }
    });
  }
  
  if (sidebarToggle) {
    sidebarToggle.addEventListener("click", toggleSidebar);
  }
  
  if (mobileSidebarClose) {
    mobileSidebarClose.addEventListener("click", function() {
      toggleMobileSidebar(false);
    });
  }
  
  if (mobileSidebarOverlay) {
    mobileSidebarOverlay.addEventListener("click", function() {
      toggleMobileSidebar(false);
    });
  }
  
  // Listen for window resize to switch between mobile and desktop
  window.addEventListener("resize", function() {
    const isMobile = window.innerWidth < 768;
    if (!isMobile && mobileSidebarContent) {
      toggleMobileSidebar(false);
    }
  });
  
  // Add keyboard shortcut to toggle sidebar (Ctrl/Cmd + B)
  document.addEventListener("keydown", function(event) {
    if ((event.ctrlKey || event.metaKey) && event.key === "b") {
      event.preventDefault();
      const isMobile = window.innerWidth < 768;
      if (isMobile) {
        toggleMobileSidebar(true);
      } else {
        toggleSidebar();
      }
    }
  });
  
  // Dark mode toggle functionality
  const themeToggleButtons = [
    document.getElementById("theme-toggle"), 
    document.getElementById("mobile-theme-toggle")
  ].filter(Boolean);
  
  themeToggleButtons.forEach(button => {
    if (button) {
      button.addEventListener("click", function() {
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
  });
  
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