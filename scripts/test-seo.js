const https = require('https');
const http = require('http');

console.log('🔍 Testing SEO meta tags rendering...\n');

const baseUrl = process.env.APP_URL || 'http://localhost:8000';
const testRoutes = ['/', '/mobile', '/legacy', '/rsvp'];

async function testSEO(route) {
    return new Promise((resolve, reject) => {
        const url = `${baseUrl}${route}`;
        const client = url.startsWith('https') ? https : http;

        console.log(`📄 Testing: ${url}`);

        const req = client.request(url, (res) => {
            let data = '';

            res.on('data', (chunk) => {
                data += chunk;
            });

            res.on('end', () => {
                const checks = {
                    title: /<title>(.*?)<\/title>/i.test(data),
                    description:
                        /<meta name="description" content="(.*?)"/i.test(data),
                    ogTitle: /<meta property="og:title" content="(.*?)"/i.test(
                        data,
                    ),
                    ogDescription:
                        /<meta property="og:description" content="(.*?)"/i.test(
                            data,
                        ),
                    ogImage: /<meta property="og:image" content="(.*?)"/i.test(
                        data,
                    ),
                    twitterCard:
                        /<meta name="twitter:card" content="(.*?)"/i.test(data),
                    canonical: /<link rel="canonical" href="(.*?)"/i.test(data),
                    ssrContent:
                        data.includes('id="app"') &&
                        !data.includes('<div id="app"></div>'),
                };

                console.log(`  ✅ Title: ${checks.title ? '✓' : '✗'}`);
                console.log(
                    `  ✅ Description: ${checks.description ? '✓' : '✗'}`,
                );
                console.log(`  ✅ OG Title: ${checks.ogTitle ? '✓' : '✗'}`);
                console.log(
                    `  ✅ OG Description: ${checks.ogDescription ? '✓' : '✗'}`,
                );
                console.log(`  ✅ OG Image: ${checks.ogImage ? '✓' : '✗'}`);
                console.log(
                    `  ✅ Twitter Card: ${checks.twitterCard ? '✓' : '✗'}`,
                );
                console.log(
                    `  ✅ Canonical URL: ${checks.canonical ? '✓' : '✗'}`,
                );
                console.log(
                    `  ✅ SSR Content: ${checks.ssrContent ? '✓' : '✗'}`,
                );

                const passedChecks =
                    Object.values(checks).filter(Boolean).length;
                const totalChecks = Object.keys(checks).length;
                console.log(
                    `  📊 Score: ${passedChecks}/${totalChecks} (${Math.round((passedChecks / totalChecks) * 100)}%)\n`,
                );

                resolve({ route, checks, score: passedChecks / totalChecks });
            });
        });

        req.on('error', (err) => {
            console.error(`  ❌ Error testing ${route}:`, err.message);
            reject(err);
        });

        req.end();
    });
}

async function runTests() {
    console.log(`🌐 Testing SEO on: ${baseUrl}\n`);

    const results = [];

    for (const route of testRoutes) {
        try {
            const result = await testSEO(route);
            results.push(result);
        } catch (error) {
            console.error(`Failed to test ${route}:`, error.message);
        }
    }

    // Summary
    console.log('📋 SEO Test Summary:');
    console.log('==================');

    results.forEach((result) => {
        const percentage = Math.round(result.score * 100);
        const status = percentage >= 80 ? '✅' : percentage >= 60 ? '⚠️' : '❌';
        console.log(`${status} ${result.route}: ${percentage}%`);
    });

    const averageScore =
        results.reduce((sum, r) => sum + r.score, 0) / results.length;
    const averagePercentage = Math.round(averageScore * 100);

    console.log(`\n🎯 Overall SEO Score: ${averagePercentage}%`);

    if (averagePercentage >= 80) {
        console.log('🎉 Excellent! Your SEO is well implemented.');
    } else if (averagePercentage >= 60) {
        console.log("⚠️ Good, but there's room for improvement.");
    } else {
        console.log('❌ SEO needs significant improvement.');
    }

    console.log('\n💡 Tips:');
    console.log(
        '   • Make sure SSR server is running: node bootstrap/ssr/ssr.mjs',
    );
    console.log('   • Check that meta tags are rendered in the initial HTML');
    console.log('   • Verify structured data is present for rich snippets');
    console.log('   • Test with tools like Lighthouse and Rich Results Test');
}

// Check if server is running
async function checkServer() {
    return new Promise((resolve) => {
        const client = baseUrl.startsWith('https') ? https : http;
        const req = client.request(baseUrl, (res) => {
            resolve(res.statusCode === 200);
        });

        req.on('error', () => {
            console.log(`❌ Server not running at ${baseUrl}`);
            console.log('💡 Please start your server with: php artisan serve');
            process.exit(1);
        });

        req.end();
    });
}

async function main() {
    const serverRunning = await checkServer();
    if (serverRunning) {
        await runTests();
    }
}

main().catch(console.error);
