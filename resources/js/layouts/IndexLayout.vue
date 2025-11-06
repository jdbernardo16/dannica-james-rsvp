<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

interface Props {
    title?: string;
    description?: string;
    showWeddingTheme?: boolean;
    showHeader?: boolean;
    showFooter?: boolean;
    keywords?: string;
    author?: string;
    imageUrl?: string;
    url?: string;
}

const props = withDefaults(defineProps<Props>(), {
    title: 'James & Dannica',
    description:
        'Mark your calendars for our special day as we celebrate love and new beginnings. Two souls with but a single thought, two hearts that beat as one. Villaluz - Tejada Nuptial',
    showWeddingTheme: true,
    showHeader: true,
    showFooter: true,
    keywords:
        'wedding, James, Dannica, Villaluz, Tejada, marriage, celebration, RSVP, wedding ceremony, wedding reception, love story, wedding vows, nuptial',
    author: 'James & Dannica',
    imageUrl: '/images/meta-image.png',
    url: 'https://www.jamesdannica.site/',
});
</script>

<template>
    <div
        :class="[
            'flex min-h-screen flex-col',
            showWeddingTheme
                ? 'wedding-theme non-responsive-scaling'
                : 'non-responsive-scaling bg-background',
        ]"
    >
        <Head :title="title">
            <!-- Basic Meta Tags -->
            <meta name="description" :content="description" />
            <meta name="keywords" :content="keywords" />
            <meta name="author" :content="author" />
            <meta
                name="viewport"
                content="width=1440, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"
            />
            <meta
                name="robots"
                content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1"
            />
            <meta name="language" content="English" />
            <meta name="revisit-after" content="7 days" />

            <!-- Open Graph Meta Tags -->
            <meta property="og:title" :content="title" />
            <meta property="og:description" :content="description" />
            <meta property="og:image" :content="imageUrl" />
            <meta
                property="og:image:alt"
                content="James & Dannica Wedding Celebration"
            />
            <meta property="og:image:width" content="1200" />
            <meta property="og:image:height" content="630" />
            <meta property="og:url" :content="url" />
            <meta property="og:type" content="website" />
            <meta property="og:site_name" content="James & Dannica" />
            <meta property="og:locale" content="en_US" />

            <!-- Twitter Card Meta Tags -->
            <meta name="twitter:card" content="summary_large_image" />
            <meta name="twitter:title" :content="title" />
            <meta name="twitter:description" :content="description" />
            <meta name="twitter:image" :content="imageUrl" />
            <meta
                name="twitter:image:alt"
                content="James & Dannica Wedding Celebration"
            />

            <!-- Additional SEO Meta Tags -->
            <meta name="theme-color" content="#E6B8C2" />
            <meta name="msapplication-TileColor" content="#E6B8C2" />
            <meta name="application-name" content="James & Dannica" />
            <meta name="apple-mobile-web-app-title" content="J&D Wedding" />
            <meta name="apple-mobile-web-app-capable" content="yes" />
            <meta
                name="apple-mobile-web-app-status-bar-style"
                content="default"
            />

            <!-- Canonical URL -->
            <link rel="canonical" :href="url" />

            <!-- Preconnect to external domains -->
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link
                rel="preconnect"
                href="https://fonts.gstatic.com"
                crossorigin="anonymous"
            />
            <link
                href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Source+Sans+Pro:wght@300;400;600;700&family=Dancing+Script:wght@400;700&display=swap"
                rel="stylesheet"
            />
        </Head>

        <!-- Decorative Watercolor Background Effects (only when wedding theme is enabled) -->
        <div
            v-if="showWeddingTheme"
            class="pointer-events-none fixed inset-0 opacity-10"
        >
            <div
                class="bg-wedding-blush absolute top-10 left-10 h-64 w-64 rounded-full blur-3xl filter"
            ></div>
            <div
                class="bg-wedding-gold absolute top-1/3 right-20 h-96 w-96 rounded-full blur-3xl filter"
            ></div>
            <div
                class="bg-wedding-navy absolute bottom-20 left-1/4 h-80 w-80 rounded-full blur-3xl filter"
            ></div>
        </div>

        <!-- Wedding-themed Header (optional) -->
        <header
            v-if="showHeader"
            :class="[
                'relative z-10',
                showWeddingTheme
                    ? 'wedding-nav'
                    : 'border-b border-gray-200 bg-white',
            ]"
        >
            <div class="wedding-container">
                <div class="flex items-center justify-between py-4">
                    <div class="flex items-center space-x-2">
                        <div
                            v-if="showWeddingTheme"
                            class="bg-wedding-gradient-gold flex h-8 w-8 items-center justify-center rounded-full"
                        >
                            <span
                                class="text-wedding-navy font-wedding-bold text-sm"
                                >D&J</span
                            >
                        </div>
                        <h1
                            :class="
                                showWeddingTheme
                                    ? 'font-wedding-heading text-wedding-navy text-xl'
                                    : 'text-xl font-semibold text-gray-900'
                            "
                        >
                            {{ title }}
                        </h1>
                    </div>

                    <nav
                        v-if="showWeddingTheme"
                        class="hidden space-x-6 md:flex"
                    >
                        <Link
                            href="/"
                            class="font-wedding-body text-wedding-navy hover:text-wedding-gold transition-colors duration-300"
                        >
                            Home
                        </Link>
                        <Link
                            href="/rsvp"
                            class="font-wedding-body text-wedding-navy hover:text-wedding-gold transition-colors duration-300"
                        >
                            RSVP
                        </Link>
                    </nav>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="relative z-10 flex-grow py-20">
            <div :class="showWeddingTheme ? 'animate-fade-in' : ''">
                <slot />
            </div>
        </main>

        <!-- Wedding-themed Footer (optional) -->
        <footer
            v-if="showFooter"
            :class="[
                'relative z-10 mt-auto',
                showWeddingTheme
                    ? 'wedding-footer'
                    : 'border-t border-gray-200 bg-gray-100 text-gray-600',
            ]"
        >
            <div class="wedding-container">
                <div class="py-6 text-center">
                    <div v-if="showWeddingTheme" class="mb-4">
                        <div class="wedding-divider mb-4"></div>
                        <p
                            class="font-wedding-accent text-wedding-ivory mb-2 text-2xl"
                        >
                            With love and gratitude
                        </p>
                        <p class="font-wedding-body text-wedding-ivory-light">
                            Thank you for being part of our special day
                        </p>
                    </div>

                    <div
                        :class="
                            showWeddingTheme
                                ? 'text-wedding-ivory-light text-sm'
                                : 'text-sm'
                        "
                    >
                        <p>
                            &copy; {{ new Date().getFullYear() }} Wedding RSVP.
                            All rights reserved.
                        </p>
                        <p class="mt-1">Made with ❤️ for our special day</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<style scoped>
/* Additional styles for layout-specific animations */
.wedding-nav {
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.wedding-footer {
    background: linear-gradient(
        135deg,
        var(--wedding-navy) 0%,
        var(--wedding-navy-light) 100%
    );
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .wedding-nav {
        padding: 0.75rem 0;
    }

    .wedding-footer {
        padding: 2rem 0 1.5rem;
    }
}

/* Smooth transitions for theme switching */
.wedding-theme,
.bg-wedding-gradient-ivory {
    transition: all 0.3s ease;
}

/* Ensure proper layering of background effects */
.fixed.inset-0 {
    z-index: 1;
}

.relative.z-10 {
    z-index: 10;
}
</style>
