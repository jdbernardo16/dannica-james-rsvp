<template>
    <PublicLayout
        title="Layout Test"
        description="Testing the new PublicLayout with wedding theme"
        :showWeddingTheme="true"
        :showHeader="true"
        :showFooter="true"
    >
        <div class="wedding-container py-12">
            <div class="card-wedding-elegant mx-auto max-w-2xl">
                <h1 class="wedding-title text-wedding-3xl mb-6 text-center">
                    PublicLayout Test Page
                </h1>
                <div class="wedding-divider mb-6"></div>
                <p class="text-wedding-lg mb-8 text-center">
                    This page tests the new PublicLayout component with the
                    wedding theme.
                </p>

                <div class="space-y-6">
                    <div class="text-center">
                        <h2
                            class="font-wedding-semibold text-wedding-navy mb-3 text-xl"
                        >
                            Features Tested:
                        </h2>
                        <ul
                            class="font-wedding-body text-wedding-navy space-y-2"
                        >
                            <li>✅ Wedding theme integration</li>
                            <li>✅ Font imports and typography</li>
                            <li>✅ Watercolor background effects</li>
                            <li>✅ Wedding-themed header</li>
                            <li>✅ Wedding-themed footer</li>
                            <li>✅ Responsive design</li>
                            <li>✅ Semantic HTML structure</li>
                            <li>✅ Global animations</li>
                        </ul>
                    </div>

                    <div class="text-center">
                        <button class="btn-wedding-primary mr-3">
                            Primary Button
                        </button>
                        <button class="btn-wedding-secondary mr-3">
                            Secondary Button
                        </button>
                        <button class="btn-wedding-accent">
                            Accent Button
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>

<script setup lang="ts">
// Test page for the new PublicLayout
</script>
