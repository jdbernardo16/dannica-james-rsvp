<script setup lang="ts">
import { Gift, Heart, Info } from 'lucide-vue-next';
import { onMounted, onUnmounted, ref } from 'vue';

const elementsVisible = ref({
    title: false,
    giftText: false,
    noteText: false,
});

const handleScroll = () => {
    const titleEl = document.querySelector('.gift-guide-title');
    const giftTextEl = document.querySelector('.gift-text');
    const noteTextEl = document.querySelector('.note-text');

    const windowHeight = window.innerHeight;

    if (titleEl) {
        const rect = titleEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.title = true;
        }
    }

    if (giftTextEl) {
        const rect = giftTextEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.giftText = true;
        }
    }

    if (noteTextEl) {
        const rect = noteTextEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.noteText = true;
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

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <section
        id="gift-guide"
        class="relative overflow-hidden bg-gradient-to-b from-rose-50/30 via-white to-amber-50/30"
    >
        <!-- Background decorative elements -->
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute top-20 left-10 h-32 w-32 opacity-5">
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
            <div class="absolute right-10 bottom-20 h-28 w-28 opacity-5">
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
            class="m-auto max-w-[1440px] px-4 py-16 sm:px-8 md:px-12 lg:px-20 lg:py-24"
        >
            <!-- Header Section -->
            <div class="mx-auto mb-16 max-w-[900px] text-center">
                <div class="mb-8 inline-block">
                    <div class="flex items-center space-x-3">
                        <div
                            class="h-px w-12 bg-gradient-to-r from-transparent to-rose-300"
                        ></div>
                        <Heart
                            class="animate-pulse-slow h-6 w-6 text-rose-400"
                        />
                        <div
                            class="h-px w-12 bg-gradient-to-l from-transparent to-rose-300"
                        ></div>
                    </div>
                </div>
                <h2
                    class="gift-guide-title font-secondary text-4xl leading-tight text-gray-800 transition-all duration-1000 ease-out sm:text-5xl md:text-6xl lg:text-7xl"
                    :class="
                        elementsVisible.title
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    Gift Guide
                </h2>
            </div>

            <!-- Content Section -->
            <div class="mx-auto max-w-4xl">
                <!-- Gift Message -->
                <div
                    class="gift-text mb-12 transition-all delay-200 duration-1000 ease-out md:mb-16"
                    :class="
                        elementsVisible.giftText
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-8 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl md:p-12"
                    >
                        <!-- Decorative gradient overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                        ></div>

                        <div class="relative z-10 text-center">
                            <div
                                class="mb-6 inline-flex items-center justify-center"
                            >
                                <Gift class="mr-3 h-8 w-8 text-amber-400" />
                                <h3
                                    class="font-secondary text-2xl font-light text-gray-800 md:text-3xl"
                                >
                                    With all that we have, we have been truly
                                    blessed.
                                </h3>
                            </div>

                            <p
                                class="mb-4 text-lg leading-relaxed font-light text-gray-600 md:text-xl"
                            >
                                Your presence and prayers are all that we
                                request.
                            </p>
                            <p
                                class="mb-6 text-lg leading-relaxed font-light text-gray-600 md:text-xl"
                            >
                                But if you desire to give, nonetheless, monetary
                                gift is one we suggest.
                            </p>

                            <!-- Decorative divider -->
                            <div class="my-8 flex items-center justify-center">
                                <div
                                    class="h-px w-16 bg-gradient-to-r from-transparent to-rose-300"
                                ></div>
                                <Heart class="mx-4 h-5 w-5 text-rose-400" />
                                <div
                                    class="h-px w-16 bg-gradient-to-l from-transparent to-rose-300"
                                ></div>
                            </div>
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

                <!-- Important Note -->
                <div
                    class="note-text transition-all delay-400 duration-1000 ease-out"
                    :class="
                        elementsVisible.noteText
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-amber-100 bg-gradient-to-br from-amber-50/50 to-rose-50/50 p-6 shadow-md transition-all duration-500 hover:-translate-y-1 hover:shadow-lg md:p-8"
                    >
                        <!-- Decorative gradient overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-amber-100/30 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                        ></div>

                        <div
                            class="relative z-10 flex items-center justify-center"
                        >
                            <Info class="mr-3 h-6 w-6 text-amber-500" />
                            <p
                                class="text-center font-medium text-amber-700 md:text-lg"
                            >
                                <span class="font-semibold"
                                    >Important Note:</span
                                >
                                This will be an adults-only celebration. No
                                children allowed.
                            </p>
                        </div>

                        <!-- Decorative corner -->
                        <div
                            class="absolute bottom-0 left-0 h-16 w-16 opacity-5"
                        >
                            <svg viewBox="0 0 100 100" class="text-amber-400">
                                <path
                                    d="M100,100 L0,100 L0,0 Z"
                                    fill="currentColor"
                                />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom decorative element -->
            <div class="mt-16 text-center">
                <div class="inline-flex items-center space-x-4">
                    <div
                        class="h-px w-24 bg-gradient-to-r from-transparent via-rose-300 to-transparent"
                    ></div>
                    <p class="font-light text-gray-500 italic">
                        Your generosity is deeply appreciated
                    </p>
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
