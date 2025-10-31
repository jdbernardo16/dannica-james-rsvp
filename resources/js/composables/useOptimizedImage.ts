/**
 * Composable for getting optimized image paths
 * Returns the optimized WebP version if available, falls back to original
 */
export function useOptimizedImage(imagePath: string): string {
    // Remove leading / if present
    const cleanPath = imagePath.startsWith('/')
        ? imagePath.slice(1)
        : imagePath;

    // Check if the image is in the images directory
    if (!cleanPath.startsWith('images/')) {
        return imagePath;
    }

    // Get the filename and extension
    const lastSlashIndex = cleanPath.lastIndexOf('/');
    const filename =
        lastSlashIndex >= 0 ? cleanPath.slice(lastSlashIndex + 1) : cleanPath;
    const filenameWithoutExt = filename.includes('.')
        ? filename.slice(0, filename.lastIndexOf('.'))
        : filename;

    // Return the optimized version path
    return `/images/optimized/${filenameWithoutExt}.webp`;
}

/**
 * Composable for generating picture element with optimized images
 * Returns both WebP and fallback sources for better browser support
 */
export function useOptimizedPicture(
    imagePath: string,
    alt: string = '',
    classes: string = '',
    loading: 'lazy' | 'eager' = 'lazy',
): string {
    const optimizedPath = useOptimizedImage(imagePath);

    return `
        <picture>
            <source srcset="${optimizedPath}" type="image/webp">
            <img src="${imagePath}" alt="${alt}" class="${classes}" loading="${loading}">
        </picture>
    `;
}
