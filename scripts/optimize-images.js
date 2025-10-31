import fs from 'fs';
import imagemin from 'imagemin';
import imageminWebp from 'imagemin-webp';
import path from 'path';

const publicImagesDir = path.join(process.cwd(), 'public/images');
const outputDir = path.join(process.cwd(), 'public/images/optimized');

// Create output directory if it doesn't exist
if (!fs.existsSync(outputDir)) {
    fs.mkdirSync(outputDir, { recursive: true });
}

async function optimizeImages() {
    try {
        console.log('🖼️  Starting image optimization...');

        // Get all image files from public/images directory
        const files = fs.readdirSync(publicImagesDir);
        const imageFiles = files.filter((file) =>
            /\.(jpg|jpeg|png|gif)$/i.test(file),
        );

        if (imageFiles.length === 0) {
            console.log('No images found to optimize.');
            return;
        }

        console.log(`Found ${imageFiles.length} images to optimize...`);

        // Optimize each image
        for (const file of imageFiles) {
            const filePath = path.join(publicImagesDir, file);
            const fileExt = path.extname(file).toLowerCase();

            console.log(`Processing ${file}...`);

            // Create WebP version
            try {
                await imagemin([filePath], {
                    destination: outputDir,
                    plugins: [
                        imageminWebp({
                            quality: fileExt === '.png' ? 85 : 80,
                            preset: 'default',
                        }),
                    ],
                });
                console.log(`✅ Created WebP version of ${file}`);
            } catch (webpError) {
                console.warn(
                    `⚠️  Could not create WebP version of ${file}:`,
                    webpError.message,
                );
            }

            // Copy original to optimized directory as fallback
            const outputPath = path.join(outputDir, file);
            fs.copyFileSync(filePath, outputPath);
            console.log(`📁 Copied original ${file} to optimized directory`);
        }

        console.log('🎉 Image optimization completed!');
        console.log(`Optimized images are available in: ${outputDir}`);
        console.log('\n📝 Usage instructions:');
        console.log(
            '1. Use WebP versions for modern browsers (better compression)',
        );
        console.log('2. Fall back to original images for older browsers');
        console.log(
            '3. Update your HTML/Blade templates to use picture elements for optimal loading',
        );
    } catch (error) {
        console.error('❌ Error optimizing images:', error);
        process.exit(1);
    }
}

// Run the optimization
optimizeImages();
