# WordPress Shadcn Theme

A modern WordPress theme that integrates the elegant aesthetics of shadcn/ui components with WordPress functionality. This theme combines the power of WordPress with the beautiful, accessible components from shadcn/ui design system, offering a premium website experience.

## Features

- **Modern UI Components**: 40+ pre-built shadcn UI components including cards, tooltips, popovers, form elements, and more
- **Responsive Design**: Fully responsive layout that works seamlessly on desktop, tablet, and mobile devices
- **Dark/Light Mode**: Built-in theme switching with system preference detection
- **Advanced Sidebar**: 
  - Responsive with mobile support
  - Collapsible with toggle functionality
  - Navigation menu with icons
  - Categories listing
  - User authentication display
  - Search functionality
- **WordPress Integration**:
  - Custom page templates
  - Category and tag support
  - User profile integration
  - Reading time estimation
  - Related posts functionality
- **Modern Blog Layout**: Card-based design for posts with featured images and metadata
- **Accessibility**: ARIA compliant components designed with accessibility in mind

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher (recommended)
- Node.js and npm for theme development
- Modern browser support

## Installation

1. **Install the Theme**
   - Download or clone this repository to your `/wp-content/themes/` directory
   - Activate the theme through the WordPress admin panel (Appearance > Themes)

2. **Install Dependencies**
   ```bash
   cd /path/to/wordpress-shadcn-theme
   npm install --legacy-peer-deps
   ```

3. **Build CSS Files**
   ```bash
   npm run build:css
   ```

4. **Configure WordPress Menus**
   - Go to WordPress admin > Appearance > Menus
   - Create a primary menu and assign it to "Primary Menu" location
   - Optionally create menus for other locations

## Development

For ongoing development work:

1. **Watch for CSS changes**
   ```bash
   npm run watch:css
   ```

2. **Theme Structure**
   - `/components/ui/` - shadcn UI components
   - `/src/css/globals.css` - Main CSS file with Tailwind directives
   - `/dist/output.css` - Compiled CSS file (generated from build)
   - `/src/js/main.js` - JavaScript for the theme
   - `/dist/main.js` - Compiled JavaScript
   - PHP template files in root directory

## Customization

### Theme Colors

Colors are defined as CSS variables in `globals.css` and can be customized:
- Light mode colors are defined in `:root`
- Dark mode colors are defined in `.dark`

### Styling

The theme uses Tailwind CSS for styling:
1. Modify the CSS in `/src/css/globals.css`
2. Run `npm run build:css` to compile

### Components

The theme leverages shadcn UI components which can be customized in `/components/ui/`.

## Technologies Used

- **WordPress**: The world's most popular content management system
- **Shadcn UI**: A collection of beautifully designed components
- **Tailwind CSS**: Utility-first CSS framework for styling
- **React**: For interactive UI components
- **Next.js**: For modern front-end tooling
- **PostCSS**: For processing CSS
- **TypeScript**: For type-safe JavaScript code

## Troubleshooting

If styles aren't appearing:
- Ensure `/dist/output.css` exists (run `npm run build:css` if missing)
- Check browser console for errors
- Verify the theme is activated in WordPress

If the sidebar isn't working:
- Check JavaScript console for errors
- Ensure the sidebar-provider.php file is included correctly

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the LICENSE file for details.