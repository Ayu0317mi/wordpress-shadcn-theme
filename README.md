# Shadcn WordPress Theme

A WordPress theme inspired by the shadcn/ui design system.

## Setup

This theme uses Tailwind CSS for styling. Here's how to set it up:

1. Install dependencies:
   ```bash
   npm install --legacy-peer-deps
   ```

2. Build the CSS:
   ```bash
   npm run build:css
   ```

3. Watch for CSS changes during development:
   ```bash
   npm run watch:css
   ```

## Theme Structure

- `/src/css/globals.css` - Main CSS file with Tailwind directives
- `/dist/output.css` - Compiled CSS file (generated from build)
- `/src/js/main.js` - JavaScript for the theme
- `/dist/main.js` - Copied JavaScript for the theme

## Development

1. Make changes to the CSS in `/src/css/globals.css`
2. Run `npm run watch:css` to automatically update the compiled CSS
3. Test your changes in WordPress

## Troubleshooting

If styles aren't appearing:
- Ensure `/dist/output.css` exists
- Check browser console for any errors
- Verify the theme is activated in WordPress