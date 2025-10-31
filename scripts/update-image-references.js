import fs from 'fs';
import { glob } from 'glob';
import path from 'path';

// Directories to search for Vue files
const vueFilesDir = path.join(process.cwd(), 'resources/js');

// Get all Vue files
const vueFiles = glob.sync('**/*.vue', { cwd: vueFilesDir });

console.log(`Found ${vueFiles.length} Vue files to process...`);

// Pattern to find img tags with src attributes starting with /images/
const imgTagRegex = /<img\s+[^>]*src="\/images\/[^"]*"[^>]*>/g;

// Function to convert img tag to OptimizedImage component
function convertImgTagToOptimized(imgTag) {
    // Extract attributes from img tag
    const srcMatch = imgTag.match(/src="([^"]*)"/);
    const altMatch = imgTag.match(/alt="([^"]*)"/);
    const classMatch = imgTag.match(/class="([^"]*)"/);
    const loadingMatch = imgTag.match(/loading="([^"]*)"/);

    if (!srcMatch) return imgTag; // Skip if no src attribute

    const src = srcMatch[1];
    const alt = altMatch ? altMatch[1] : '';
    const className = classMatch ? classMatch[1] : '';
    const loading = loadingMatch ? loadingMatch[1] : 'lazy';

    // Generate OptimizedImage component
    return `<OptimizedImage src="${src}" alt="${alt}" class="${className}" loading="${loading}" />`;
}

// Process each Vue file
vueFiles.forEach((file) => {
    const filePath = path.join(vueFilesDir, file);
    const content = fs.readFileSync(filePath, 'utf8');

    // Check if file already imports OptimizedImage
    const hasOptimizedImport = content.includes('import OptimizedImage');

    // Find and replace img tags
    const newContent = content.replace(imgTagRegex, (match) => {
        return convertImgTagToOptimized(match);
    });

    // Add import if needed and content changed
    if (newContent !== content) {
        let finalContent = newContent;

        if (!hasOptimizedImport) {
            // Add import after the first script setup line
            const scriptSetupMatch = finalContent.match(
                /<script setup lang="ts">[\s\S]*?import[\s\S]*?\n/,
            );
            if (scriptSetupMatch) {
                const importLine =
                    "import OptimizedImage from '@/components/OptimizedImage.vue';\n";
                finalContent = finalContent.replace(
                    scriptSetupMatch[0],
                    scriptSetupMatch[0] + importLine,
                );
            } else {
                // If no other imports, add it right after script setup tag
                finalContent = finalContent.replace(
                    /<script setup lang="ts">/,
                    '<script setup lang="ts">\nimport OptimizedImage from \'@/components/OptimizedImage.vue\';',
                );
            }
        }

        fs.writeFileSync(filePath, finalContent);
        console.log(`✅ Updated: ${file}`);
    }
});

console.log('\n🎉 Image reference update completed!');
console.log('\n📝 Next steps:');
console.log('1. Run `npm run dev` to test the changes');
console.log('2. Check that images are loading correctly with WebP format');
console.log('3. Run `npm run build` to create production build');
