"use client"

import { useEffect } from "react"
import { ThemeProvider } from "../components/theme-provider"

export default function SyntheticV0PageForDeployment() {
  useEffect(() => {
    // Load the main.js script for WordPress compatibility
    const script = document.createElement('script')
    script.src = "/src/js/main.js"
    script.async = true
    document.body.appendChild(script)
    
    return () => {
      document.body.removeChild(script)
    }
  }, [])

  return (
    <ThemeProvider attribute="class" defaultTheme="system" enableSystem>
      <div>ShadCN WordPress Theme</div>
    </ThemeProvider>
  )
}