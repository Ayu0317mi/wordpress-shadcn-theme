'use client'

import * as React from 'react'
import {
  ThemeProvider as NextThemesProvider,
  useTheme,
  type ThemeProviderProps,
} from 'next-themes'

export function ThemeProvider({ children, ...props }: ThemeProviderProps) {
  return <NextThemesProvider {...props}>{children}</NextThemesProvider>
}

// Custom hook to use theme with WordPress integration
export function useThemeIntegration() {
  const { theme, setTheme, systemTheme } = useTheme()
  
  // Listen for theme change events from WordPress
  React.useEffect(() => {
    const handleThemeChange = (event: CustomEvent) => {
      if (event.detail && event.detail.theme) {
        setTheme(event.detail.theme)
      }
    }

    // Add event listener
    window.addEventListener('theme-change', handleThemeChange as EventListener)
    
    // Apply the current theme to the HTML element
    if (theme) {
      const htmlElement = document.documentElement
      
      if (theme === 'dark' || (theme === 'system' && systemTheme === 'dark')) {
        htmlElement.classList.add('dark')
      } else {
        htmlElement.classList.remove('dark')
      }
      
      // Store the theme preference in localStorage for WordPress
      localStorage.setItem('theme', theme)
    }
    
    // Cleanup
    return () => {
      window.removeEventListener('theme-change', handleThemeChange as EventListener)
    }
  }, [theme, setTheme, systemTheme])
  
  return { theme, setTheme, systemTheme }
}

// Theme Toggle Component for React-based usage
export function ThemeToggle() {
  const { theme, setTheme } = useTheme()
  
  return (
    <button 
      onClick={() => setTheme(theme === 'dark' ? 'light' : 'dark')}
      className="p-2 rounded-md hover:bg-accent transition-colors"
      aria-label="Toggle dark mode"
    >
      {/* Sun icon */}
      <svg 
        xmlns="http://www.w3.org/2000/svg" 
        width="24" 
        height="24" 
        viewBox="0 0 24 24" 
        fill="none" 
        stroke="currentColor" 
        strokeWidth="2" 
        strokeLinecap="round" 
        strokeLinejoin="round" 
        className={theme === 'dark' ? 'hidden' : 'block'}
      >
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
      
      {/* Moon icon */}
      <svg 
        xmlns="http://www.w3.org/2000/svg" 
        width="24" 
        height="24" 
        viewBox="0 0 24 24" 
        fill="none" 
        stroke="currentColor" 
        strokeWidth="2" 
        strokeLinecap="round" 
        strokeLinejoin="round" 
        className={theme === 'dark' ? 'block' : 'hidden'}
      >
        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
      </svg>
    </button>
  )
}
