<script setup lang="ts">
import { onMounted, ref } from 'vue';

const elementsVisible = ref({
    title: false,
    text: false,
    image1: false,
    image2: false,
});

const handleScroll = () => {
    const titleEl = document.querySelector('.invitation-title');
    const textEl = document.querySelector('.invitation-text');
    const image1El = document.querySelector('.image-1');
    const image2El = document.querySelector('.image-2');

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

    if (image1El) {
        const rect = image1El.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.image1 = true;
        }
    }

    if (image2El) {
        const rect = image2El.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.image2 = true;
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
    <section
        class="relative overflow-hidden bg-gradient-to-b from-rose-50/20 via-white to-amber-50/20 py-16 md:py-24"
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
                <h1
                    class="invitation-title font-secondary text-4xl leading-tight text-gray-800 transition-all duration-1000 ease-out sm:text-5xl md:text-6xl lg:text-7xl"
                    :class="
                        elementsVisible.title
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    Together with our families, we invite you to celebrate our
                    marriage
                </h1>
            </div>

            <!-- Content Section -->
            <div
                class="flex flex-col items-start space-y-12 lg:flex-row lg:space-y-0 lg:space-x-16"
            >
                <!-- Left Column - Text and Main Image -->
                <div class="lg:w-[60%]">
                    <!-- Text Content -->
                    <div
                        class="invitation-text mb-12 transition-all delay-200 duration-1000 ease-out lg:mb-20"
                        :class="
                            elementsVisible.text
                                ? 'translate-y-0 opacity-100'
                                : 'translate-y-8 opacity-0'
                        "
                    >
                        <div
                            class="group relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-8 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl md:p-10"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <div class="relative z-10">
                                <p
                                    class="max-w-none text-lg leading-relaxed font-light text-gray-600 md:text-xl"
                                >
                                    As we prepare to begin our forever together,
                                    we are filled with joy at the thought of
                                    sharing this special moment with you. Your
                                    love, support, and presence in our lives
                                    have shaped who we are today, and we cannot
                                    imagine celebrating without you by our side.
                                    Join us as we exchange vows and create
                                    memories that will last a lifetime.
                                </p>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute top-0 right-0 h-20 w-20 opacity-5"
                            >
                                <svg
                                    viewBox="0 0 100 100"
                                    class="text-rose-400"
                                >
                                    <path
                                        d="M0,0 L100,0 L100,100 Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Main Image -->
                    <div
                        class="image-1 relative transition-all delay-400 duration-1000 ease-out"
                        :class="
                            elementsVisible.image1
                                ? 'translate-y-0 opacity-100'
                                : 'translate-y-8 opacity-0'
                        "
                    >
                        <div
                            class="group overflow-hidden rounded-2xl bg-gradient-to-br from-amber-100 to-rose-100 p-4 shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl"
                        >
                            <div
                                class="relative aspect-[682/424] w-full overflow-hidden rounded-xl"
                            >
                                <img
                                    src="/images/DSC09806.JPG"
                                    alt="couple portrait"
                                    class="h-full w-full transform object-cover transition-transform duration-700 group-hover:scale-110"
                                />
                                <!-- Overlay gradient -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Side Image -->
                <div class="lg:w-[40%]">
                    <div
                        class="image-2 relative transition-all delay-600 duration-1000 ease-out"
                        :class="
                            elementsVisible.image2
                                ? 'translate-y-0 opacity-100'
                                : 'translate-y-8 opacity-0'
                        "
                    >
                        <div
                            class="group overflow-hidden rounded-2xl bg-gradient-to-br from-rose-100 to-amber-100 p-4 shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl"
                        >
                            <div
                                class="relative aspect-[443.25/591] w-full overflow-hidden rounded-xl"
                            >
                                <img
                                    src="/images/DSC09798.JPG"
                                    alt="couple candid"
                                    class="h-full w-full transform object-cover transition-transform duration-700 group-hover:scale-110"
                                />
                                <!-- Overlay gradient -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom decorative element -->
            <div class="mt-20 text-center">
                <div class="inline-flex items-center space-x-4">
                    <div
                        class="h-px w-24 bg-gradient-to-r from-transparent via-rose-300 to-transparent"
                    ></div>
                    <p class="font-light text-gray-500 italic">
                        We can't wait to share this day with you
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
