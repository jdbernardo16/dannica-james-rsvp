<script setup lang="ts">
import AppHeader from '@/components/AppHeader.vue';
import { Head } from '@inertiajs/vue3';

interface Props {
    title?: string;
    description?: string;
}

withDefaults(defineProps<Props>(), {
    title: 'Dannica & James - Wedding RSVP',
    description: 'Join us in celebrating our special day',
});
</script>

<template>
    <div class="min-h-screen">
        <Head :title="title">
            <meta name="description" :content="description" />
            <meta
                name="viewport"
                content="width=device-width, initial-scale=1"
            />
        </Head>

        <!-- AppHeader Component -->
        <AppHeader />

        <!-- Main Content -->
        <main class="relative z-10">
            <!-- Add padding top to account for fixed header -->
            <div class="pt-17">
                <slot />
            </div>
        </main>

        <!-- Wedding-themed Footer -->
        <footer class="wedding-footer relative z-10 mt-auto">
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
