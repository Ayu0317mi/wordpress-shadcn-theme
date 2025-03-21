// WordPress-safe mobile menu and dark mode toggle
(function() {
  document.addEventListener("DOMContentLoaded", function() {
    // Toggle mobile menu
    const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    if (mobileMenuToggle && mobileMenu) {
      mobileMenuToggle.addEventListener("click", function() {
        mobileMenu.classList.toggle("hidden");
      });
    }
    
    // Dark mode toggle functionality
    setupDarkMode();
  });

  function setupDarkMode() {
    // Check for saved theme preference or use the system preference
    const userTheme = localStorage.getItem("theme");
    const systemPrefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    
    // Apply theme based on stored preference
    if (userTheme === "dark" || (userTheme === "system" && systemPrefersDark) || (!userTheme && systemPrefersDark)) {
      document.documentElement.classList.add("dark");
    } else {
      document.documentElement.classList.remove("dark");
    }
    
    // Add dark mode toggle button to the header if it exists
    const header = document.querySelector("header .container");
    if (header) {
      const darkModeButton = document.createElement("button");
      darkModeButton.id = "theme-toggle";
      darkModeButton.className = "p-2 rounded-md hover:bg-accent transition-colors";
      darkModeButton.setAttribute("aria-label", "Toggle dark mode");
      darkModeButton.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="dark:hidden">
          <circle cx="12" cy="12" r="4"></circle>
          <path d="M12 2v2"></path>
          <path d="M12 20v2"></path>
          <path d="m4.93 4.93 1.41 1.41"></path>
          <path d="m17.66 17.66 1.41 1.41"></path>
          <path d="M2 12h2"></path>
          <path d="M20 12h2"></path>
          <path d="m6.34 17.66-1.41 1.41"></path>
          <path d="m19.07 4.93-1.41 1.41"></path>
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden dark:block">
          <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
        </svg>
      `;
      
      darkModeButton.addEventListener("click", function() {
        // Toggle dark mode
        const isDark = document.documentElement.classList.toggle("dark");
        
        // Update localStorage
        if (isDark) {
          localStorage.setItem("theme", "dark");
        } else {
          localStorage.setItem("theme", "light");
        }
        
        // Dispatch a custom event that the ThemeProvider can listen to
        window.dispatchEvent(new CustomEvent('theme-change', { 
          detail: { theme: isDark ? 'dark' : 'light' } 
        }));
      });
      
      // Insert before the mobile menu toggle
      const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
      if (mobileMenuToggle) {
        header.insertBefore(darkModeButton, mobileMenuToggle);
      } else {
        header.appendChild(darkModeButton);
      }
    }
    
    // Listen for system preference changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', ({ matches }) => {
      if (localStorage.getItem("theme") === "system") {
        if (matches) {
          document.documentElement.classList.add("dark");
        } else {
          document.documentElement.classList.remove("dark");
        }
      }
    });
  }
})();

