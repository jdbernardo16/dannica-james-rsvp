<script setup lang="ts">
import { onMounted, ref } from 'vue';

const elementsVisible = ref({
    title: false,
    text: false,
    button: false,
    decorative: false,
});

const handleScroll = () => {
    const titleEl = document.querySelector('.rsvp-title');
    const textEl = document.querySelector('.rsvp-text');
    const buttonEl = document.querySelector('.rsvp-button');
    const decorativeEl = document.querySelector('.rsvp-decorative');

    const windowHeight = window.innerHeight;

    if (titleEl) {
        const rect = titleEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.title = true;
        }
    }

    if (textEl) {
        const rect = textEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.text = true;
        }
    }

    if (buttonEl) {
        const rect = buttonEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.button = true;
        }
    }

    if (decorativeEl) {
        const rect = decorativeEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.decorative = true;
        }
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Initial check

    // Trigger animations after mount
    setTimeout(() => {
        elementsVisible.value.title = true;
    }, 300);
});
</script>

<template>
    <section id="rsvp" class="relative overflow-hidden">
        <!-- Background with gradient -->
        <div
            class="absolute inset-0 bg-gradient-to-br from-rose-50 via-amber-50 to-rose-100"
        ></div>

        <!-- Background decorative elements -->
        <div class="pointer-events-none absolute inset-0">
            <div
                class="rsvp-decorative absolute top-10 left-10 h-32 w-32 opacity-10 transition-all duration-1000 ease-out"
                :class="
                    elementsVisible.decorative
                        ? 'translate-y-0 opacity-10'
                        : 'translate-y-8 opacity-0'
                "
            >
                <svg
                    viewBox="0 0 100 100"
                    class="animate-spin-slow text-rose-400"
                >
                    <circle cx="50" cy="50" r="2" fill="currentColor">
                        <animate
                            attributeName="r"
                            values="2;30;2"
                            dur="6s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="1;0.2;1"
                            dur="6s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
            <div
                class="rsvp-decorative absolute right-10 bottom-10 h-28 w-28 opacity-10 transition-all delay-300 duration-1000 ease-out"
                :class="
                    elementsVisible.decorative
                        ? 'translate-y-0 opacity-10'
                        : 'translate-y-8 opacity-0'
                "
            >
                <svg
                    viewBox="0 0 100 100"
                    class="animate-spin-slow-reverse text-amber-400"
                >
                    <circle cx="50" cy="50" r="2" fill="currentColor">
                        <animate
                            attributeName="r"
                            values="2;25;2"
                            dur="7s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="1;0.3;1"
                            dur="7s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
        </div>

        <div
            class="relative mx-auto max-w-6xl px-4 py-20 sm:px-8 md:px-12 lg:px-20 lg:py-32"
        >
            <!-- Content Container -->
            <div class="text-center">
                <!-- Decorative divider with heart -->
                <div
                    class="mb-8 inline-block transition-all duration-1000 ease-out"
                    :class="
                        elementsVisible.title
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <div class="flex items-center space-x-3">
                        <div
                            class="h-px w-12 bg-gradient-to-r from-transparent to-rose-300"
                        ></div>
                        <svg
                            class="animate-pulse-slow h-6 w-6 text-rose-400"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                            />
                        </svg>
                        <div
                            class="h-px w-12 bg-gradient-to-l from-transparent to-rose-300"
                        ></div>
                    </div>
                </div>

                <!-- Main Title -->
                <h1
                    class="rsvp-title mb-6 font-secondary text-4xl leading-tight font-light text-gray-800 transition-all duration-1000 ease-out sm:text-5xl md:text-6xl lg:text-7xl"
                    :class="
                        elementsVisible.title
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    Will You Be There?
                </h1>

                <!-- Subtitle -->
                <h2
                    class="mb-8 text-2xl font-light text-rose-600 transition-all delay-200 duration-1000 ease-out md:text-3xl"
                    :class="
                        elementsVisible.title
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    Your Presence is Our Greatest Gift
                </h2>

                <!-- Description Text -->
                <div
                    class="rsvp-text mx-auto mb-12 max-w-3xl transition-all delay-400 duration-1000 ease-out md:mb-16"
                    :class="
                        elementsVisible.text
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-rose-100 bg-white/80 p-8 shadow-lg backdrop-blur-sm transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl md:p-10"
                    >
                        <!-- Decorative gradient overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                        ></div>

                        <div class="relative z-10">
                            <p
                                class="text-lg leading-relaxed font-light text-gray-600 md:text-xl"
                            >
                                As we prepare to begin our forever together, we
                                would be honored by your presence on our special
                                day. Your RSVP helps us ensure every detail is
                                perfect for our celebration of love. Please let
                                us know if you can join us for this joyous
                                occasion.
                            </p>
                        </div>

                        <!-- Decorative corner -->
                        <div class="absolute top-0 right-0 h-20 w-20 opacity-5">
                            <svg viewBox="0 0 100 100" class="text-rose-400">
                                <path
                                    d="M0,0 L100,0 L100,100 Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- RSVP Button -->
                <div
                    class="rsvp-button transition-all delay-600 duration-1000 ease-out"
                    :class="
                        elementsVisible.button
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <a
                        href="/rsvp"
                        class="btn-wedding-accent group wedding-touch-target-lg animate-fade-in-up m-auto inline-flex w-fit items-center"
                    >
                        RSVP Now
                        <svg
                            class="ml-2 h-5 w-5 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"
                            ></path>
                        </svg>
                    </a>
                </div>

                <!-- Additional Information -->
                <div
                    class="mt-12 transition-all delay-800 duration-1000 ease-out md:mt-16"
                    :class="
                        elementsVisible.button
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <p class="text-sm font-light text-gray-500 italic">
                        Kindly respond by October 31, 2025
                    </p>
                </div>
            </div>

            <!-- Bottom decorative element -->
            <div class="mt-20 text-center">
                <div class="inline-flex items-center space-x-4">
                    <div
                        class="h-px w-24 bg-gradient-to-r from-transparent via-rose-300 to-transparent"
                    ></div>
                    <svg
                        class="h-5 w-5 text-rose-400"
                        fill="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                        />
                    </svg>
                    <div
                        class="h-px w-24 bg-gradient-to-l from-transparent via-rose-300 to-transparent"
                    ></div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes spin-slow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@keyframes spin-slow-reverse {
    from {
        transform: rotate(360deg);
    }
    to {
        transform: rotate(0deg);
    }
}

@keyframes pulse-slow {
    0%,
    100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.8;
        transform: scale(1.05);
    }
}

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}

.animate-spin-slow-reverse {
    animation: spin-slow-reverse 25s linear infinite;
}

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}
</style>
