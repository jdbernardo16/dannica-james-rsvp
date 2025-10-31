# Image Optimization Guide

This project includes an automated image optimization system that converts images to WebP format for better performance and automatically updates references in Vue components.

## How It Works

1. **Image Optimization Script** (`scripts/optimize-images.js`):
    - Scans `public/images/` directory for JPG, PNG, and GIF files
    - Creates optimized WebP versions in `public/images/optimized/`
    - Copies original files to the optimized directory as fallbacks

2. **OptimizedImage Component** (`resources/js/components/OptimizedImage.vue`):
    - Automatically uses WebP versions when available
    - Falls back to original images if WebP fails to load
    - Provides a drop-in replacement for `<img>` tags

3. **Reference Update Script** (`scripts/update-image-references.js`):
    - Scans all Vue files for `<img>` tags with `/images/` sources
    - Automatically converts them to use the `OptimizedImage` component
    - Adds necessary imports

## Usage

### Manual Optimization

To optimize images and update references:

```bash
# Optimize images only
npm run optimize-images

# Update image references in Vue files
npm run update-image-references

# Do both and build
npm run build:optimized
```

### Development Workflow

1. Add new images to `public/images/`
2. Run `npm run optimize-images` to create WebP versions
3. Run `npm run update-image-references` to update Vue components
4. Test with `npm run dev`

### Production Build

For production, use the optimized build command:

```bash
npm run build:optimized
```

This will:

1. Optimize all images
2. Update all image references
3. Build the production assets

## File Structure

```
public/
├── images/           # Original images
│   ├── logo.png
│   ├── photo.jpg
│   └── ...
└── images/optimized/  # Optimized WebP versions
    ├── logo.webp
    ├── photo.webp
    └── ...
```

## Browser Support

- Modern browsers will load WebP images (smaller file size)
- Older browsers will fall back to original formats
- The `<picture>` element ensures optimal loading for all browsers

## Performance Benefits

- WebP images are typically 25-35% smaller than JPEG/PNG
- Automatic fallback ensures compatibility
- Lazy loading by default for better performance
- No manual HTML changes required after initial setup

## Troubleshooting

### Images not loading as WebP

1. Check that the optimized image exists in `public/images/optimized/`
2. Verify the file name matches (same base name, .webp extension)
3. Check browser console for any errors

### Build issues

1. Ensure all images in `public/images/` have valid formats
2. Check that the `glob` package is installed (`npm install`)
3. Verify file permissions on the `public/images/optimized/` directory

### Component not working

1. Make sure `OptimizedImage` component is imported
2. Check that the `src` path starts with `/images/`
3. Verify the image exists in the original directory
