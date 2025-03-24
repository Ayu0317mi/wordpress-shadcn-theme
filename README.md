# WordPress Shadcn Theme

A modern WordPress theme that integrates shadcn/ui components with WordPress functionality. This theme offers a sleek and accessible design while maintaining WordPress's powerful features.

## Features

- **Modern UI Components**: Pre-built shadcn UI elements like cards, tooltips, popovers, and forms.
- **Responsive Design**: Works seamlessly on desktop, tablet, and mobile devices.
- **Dark/Light Mode**: Built-in theme switching based on system preference.
- **Advanced Sidebar**:
  - Collapsible navigation menu
  - User authentication display (Sign in / Sign out with avatar)
  - Category listing and search functionality
- **WordPress Integration**:
  - Custom page templates
  - Category and tag support
  - Related posts and reading time estimation
- **Modern Blog Layout**: Card-based design with featured images and metadata.
- **Accessibility**: ARIA-compliant components for an inclusive experience.

## Quick Start Guide

### 1️⃣ Using the Theme As-Is (No Coding Required)

1. **Download & Install the Theme**
   - Upload the theme ZIP file via **Appearance > Themes > Add New**
   - Activate the theme
2. **Customize via WordPress Admin**
   - Adjust logo, colors, and menus under **Appearance > Customize**
3. **Done!** 🎉 Your website is ready to use.

### 2️⃣ Modifying the Theme’s Styles (For Developers)

If you want to change the design or add custom styles:

1. **Install Development Dependencies**
   ```bash
   npm install
   ```
2. **Modify Styles**
   - Edit styles in `/src/` or `/components/`
   - Customize Tailwind settings in `tailwind.config.js`
3. **Rebuild CSS**
   ```bash
   npm run build
   ```
4. **Upload the Updated Theme** to WordPress
5. **Refresh your site** to see the changes

## Theme Structure

- **Essential Files** (Keep these):
  - `/style.css`, `/index.php`, `/functions.php`
  - `/header.php`, `/footer.php`, `/single.php`, `/sidebar-provider.php`
  - `/dist/output.css` (Compiled Styles)
  - `/public/` (Static assets like images and icons)

- **Development Files** (Only needed if modifying styles):
  - `/src/` (Source files for styling and scripts)
  - `/components/` (UI components for customization)
  - `/node_modules/` (Dependencies for building the theme)

## Troubleshooting

- **Styles not appearing?**
  - Ensure `/dist/output.css` exists (run `npm run build` if missing)
  - Check if the theme is properly activated
- **Sidebar issues?**
  - Check JavaScript console for errors
  - Ensure `sidebar-provider.php` is correctly included

## Contributing

Contributions are welcome! Feel free to submit a Pull Request.

## License

This project is licensed under the MIT License - see the LICENSE file for details.