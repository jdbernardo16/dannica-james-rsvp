const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

console.log('🚀 Building SSR assets for better SEO...');

try {
    // Build regular assets
    console.log('📦 Building client assets...');
    execSync('npx vite build', { stdio: 'inherit' });

    // Build SSR assets
    console.log('🔧 Building SSR assets...');
    execSync('npx vite build --ssr', { stdio: 'inherit' });

    // Ensure SSR directory exists
    const ssrDir = path.join(__dirname, '../bootstrap/ssr');
    if (!fs.existsSync(ssrDir)) {
        fs.mkdirSync(ssrDir, { recursive: true });
    }

    // Copy SSR bundle to bootstrap/ssr
    const ssrSource = path.join(__dirname, '../public/build/ssr.js');
    const ssrDest = path.join(__dirname, '../bootstrap/ssr/ssr.mjs');

    if (fs.existsSync(ssrSource)) {
        fs.copyFileSync(ssrSource, ssrDest);
        console.log('✅ SSR bundle copied to bootstrap/ssr/ssr.mjs');
    }

    console.log('✨ SSR build completed successfully!');
    console.log('📋 Next steps:');
    console.log('   1. Start your SSR server: node bootstrap/ssr/ssr.mjs');
    console.log('   2. Start your Laravel app: php artisan serve');
    console.log('   3. Test SEO by viewing page source');
} catch (error) {
    console.error('❌ Build failed:', error.message);
    process.exit(1);
}
