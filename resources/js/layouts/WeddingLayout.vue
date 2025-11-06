<script setup lang="ts">
import AppHeader from '@/components/AppHeader.vue';
import { Head } from '@inertiajs/vue3';

interface Props {
    title?: string;
    description?: string;
    keywords?: string;
    author?: string;
    imageUrl?: string;
    url?: string;
    weddingDate?: string;
    weddingLocation?: string;
}

const props = withDefaults(defineProps<Props>(), {
    title: 'James & Dannica',
    description:
        'Mark your calendars for our special day as we celebrate love and new beginnings. Two souls with but a single thought, two hearts that beat as one. Villaluz - Tejada Nuptial',
    keywords:
        'wedding, James, Dannica, Villaluz, Tejada, marriage, celebration, RSVP, wedding ceremony, wedding reception, love story, wedding vows, nuptial',
    author: 'James & Dannica',
    imageUrl: '/images/meta-image.png',
    url: 'https://www.jamesdannica.site/',
    weddingDate: '2024-12-15',
    weddingLocation: 'Manila, Philippines',
});

// Structured data for wedding event
const structuredData = {
    '@context': 'https://schema.org',
    '@type': 'Wedding',
    name: 'James & Dannica Wedding',
    description: props.description,
    startDate: props.weddingDate,
    location: {
        '@type': 'Place',
        name: props.weddingLocation,
        address: {
            '@type': 'PostalAddress',
            addressLocality: 'Manila',
            addressCountry: 'Philippines',
        },
    },
    bride: {
        '@type': 'Person',
        name: 'Dannica',
    },
    groom: {
        '@type': 'Person',
        name: 'James',
    },
    url: props.url,
    image: props.imageUrl,
    offers: {
        '@type': 'Offer',
        url: `${props.url}rsvp`,
        description: 'RSVP for James and Dannica wedding',
        availability: 'https://schema.org/InStock',
    },
};
</script>

<template>
    <div class="min-h-screen">
        <Head :title="title">
            <!-- Basic Meta Tags -->
            <meta name="description" :content="description" />
            <meta name="keywords" :content="keywords" />
            <meta name="author" :content="author" />
            <meta
                name="viewport"
                content="width=device-width, initial-scale=1"
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
                content="Dannica & James Wedding Celebration"
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
                content="Dannica & James Wedding Celebration"
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

            <!-- Structured Data -->
            <script
                type="application/ld+json"
                v-html="JSON.stringify(structuredData)"
            ></script>
        </Head>

        <!-- AppHeader Component with landmark role -->
        <header role="banner">
            <AppHeader />
        </header>

        <!-- Main Content with landmark role -->
        <main class="relative z-10" role="main">
            <!-- Add padding top to account for fixed header -->
            <div class="pt-17">
                <slot />
            </div>
        </main>

        <!-- Wedding-themed Footer with landmark role -->
        <footer class="wedding-footer relative z-10 mt-auto" role="contentinfo">
            <div class="wedding-container">
                <div class="py-6 text-center">
                    <div class="mb-4">
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

                    <div class="text-wedding-ivory-light text-sm">
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
.wedding-footer {
    background: linear-gradient(
        135deg,
        var(--wedding-navy) 0%,
        var(--wedding-navy-light) 100%
    );
}

/* Responsive adjustments */
@media (max-width: 768px) {
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
