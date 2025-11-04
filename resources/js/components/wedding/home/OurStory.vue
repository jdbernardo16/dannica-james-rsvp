<script lang="ts" setup>
import OptimizedImage from '@/components/OptimizedImage.vue';
import { onMounted, ref } from 'vue';

const verseVisible = ref(false);

const handleScroll = () => {
    const element = document.querySelector('.bible-verse-container');
    if (!element) return;

    const rect = element.getBoundingClientRect();
    const elementMiddle = rect.top + rect.height / 2;
    const windowHeight = window.innerHeight;

    if (elementMiddle < windowHeight * 0.8 && elementMiddle > 0) {
        verseVisible.value = true;
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Initial check

    // Trigger verse animation after mount
    setTimeout(() => {
        verseVisible.value = true;
    }, 500);
});
</script>

<template>
    <section
        id="story"
        class="relative overflow-hidden bg-gradient-to-b from-rose-50/30 via-white to-rose-50/30 py-16 md:py-24"
    >
        <!-- Background decorative elements -->
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute top-40 right-10 h-40 w-40 opacity-5">
                <svg
                    viewBox="0 0 100 100"
                    class="animate-spin-slow text-rose-400"
                >
                    <circle cx="50" cy="50" r="2" fill="currentColor">
                        <animate
                            attributeName="r"
                            values="2;40;2"
                            dur="4s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="1;0.3;1"
                            dur="4s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
            <div class="absolute bottom-40 left-10 h-32 w-32 opacity-5">
                <svg
                    viewBox="0 0 100 100"
                    class="animate-spin-slow-reverse text-amber-400"
                >
                    <circle cx="50" cy="50" r="2" fill="currentColor">
                        <animate
                            attributeName="r"
                            values="2;35;2"
                            dur="5s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="1;0.2;1"
                            dur="5s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
        </div>

        <div class="mx-auto max-w-[1440px] px-4 sm:px-8 md:px-12 lg:px-20">
            <!-- Header Section with Image -->
            <div
                class="flex flex-col lg:flex-row lg:items-center lg:space-x-16 xl:space-x-24"
            >
                <!-- Image Section -->
                <div
                    class="relative mb-12 flex w-full justify-center lg:mb-0 lg:w-5/12 lg:justify-start"
                >
                    <div
                        class="hover:shadow-3xl relative z-[1] max-w-md rounded-t-full bg-gradient-to-br from-amber-100 to-rose-100 p-4 shadow-2xl transition-all duration-500 hover:scale-105 sm:p-5"
                    >
                        <div class="w-full overflow-hidden rounded-t-full">
                            <OptimizedImage
                                src="/images/img3.png"
                                alt="couple"
                                class="w-full transform transition-transform duration-700 hover:scale-110"
                                loading="lazy"
                            />
                        </div>
                    </div>
                    <div
                        class="absolute top-0 -right-[100px] z-0 w-[200px] rotate-45 opacity-60 sm:-right-[125px] sm:w-[250px] lg:-right-[150px] lg:w-[300px]"
                    >
                        <OptimizedImage
                            src="/images/decor1.png"
                            alt="decor"
                            class=""
                            loading="lazy"
                        />
                    </div>
                </div>

                <!-- Title Section -->
                <div class="w-full text-center lg:w-7/12 lg:text-left">
                    <div class="mb-6 inline-block">
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
                    <h2
                        class="mb-6 font-secondary text-4xl leading-tight text-gray-800 sm:text-5xl md:text-6xl lg:text-7xl"
                    >
                        Love Defined
                    </h2>
                    <p
                        class="mx-auto max-w-2xl text-lg leading-relaxed font-light text-gray-600 md:text-xl lg:mx-0"
                    >
                        The sacred scripture beautifully defines the love that
                        binds two hearts together in holy matrimony.
                    </p>
                </div>
            </div>

            <!-- Bible Verse Section -->
            <!-- <div class="bible-verse-container mx-auto max-w-5xl">
                <div
                    class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-rose-50 via-white to-amber-50 shadow-2xl"
                    :class="[
                        verseVisible
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-16 opacity-0',
                    ]"
                >
                    <div
                        class="h-2 bg-gradient-to-r from-rose-300 via-amber-300 to-rose-300"
                    ></div>

                    <div class="relative z-10 p-12 md:p-16">
                        <div class="mb-10 text-center">
                            <div
                                class="mb-4 inline-flex items-center space-x-4"
                            >
                                <div
                                    class="h-px w-20 bg-gradient-to-r from-transparent to-rose-300"
                                ></div>
                                <span
                                    class="font-secondary text-lg text-rose-400"
                                    >❦</span
                                >
                                <div
                                    class="h-px w-20 bg-gradient-to-l from-transparent to-rose-300"
                                ></div>
                            </div>
                            <h3
                                class="font-secondary text-3xl text-gray-800 md:text-4xl"
                            >
                                1 Corinthians 13:4-7
                            </h3>
                        </div>

                        <div class="space-y-6 text-center">
                            <div class="relative">
                                <p
                                    class="font-secondary text-2xl leading-relaxed text-gray-800 md:text-3xl"
                                >
                                    <span class="text-rose-600">❝</span>
                                    <span class="relative font-medium">
                                        Love is patient, love is kind.
                                        <span
                                            class="absolute -bottom-2 left-1/2 h-px w-16 -translate-x-1/2 bg-gradient-to-r from-transparent via-rose-400 to-transparent"
                                        ></span>
                                    </span>
                                    <span class="text-rose-600">❞</span>
                                </p>
                            </div>

                            <div class="relative">
                                <p
                                    class="text-xl leading-relaxed font-normal text-gray-700 md:text-2xl"
                                >
                                    It does not envy, it does not boast, it is
                                    not proud.
                                </p>
                            </div>

                            <div class="relative">
                                <p
                                    class="text-xl leading-relaxed font-normal text-gray-700 md:text-2xl"
                                >
                                    It does not dishonor others, it is not
                                    self-seeking,
                                    <br class="hidden md:block" />
                                    it is not easily angered, it keeps no record
                                    of wrongs.
                                </p>
                            </div>

                            <div class="relative">
                                <p
                                    class="text-xl leading-relaxed font-normal text-gray-700 md:text-2xl"
                                >
                                    Love does not delight in evil but rejoices
                                    with the truth.
                                </p>
                            </div>

                            <div class="relative">
                                <p
                                    class="font-secondary text-2xl leading-relaxed text-gray-800 md:text-3xl"
                                >
                                    <span class="relative font-medium">
                                        It always protects, always trusts,
                                        always hopes, always perseveres.
                                        <span
                                            class="absolute -bottom-2 left-1/2 h-px w-24 -translate-x-1/2 bg-gradient-to-r from-transparent via-amber-400 to-transparent"
                                        ></span>
                                    </span>
                                </p>
                            </div>
                        </div>

                        <div class="mt-12 flex justify-center space-x-8">
                            <div class="flex items-center space-x-2">
                                <div
                                    class="h-2 w-2 rounded-full bg-rose-300"
                                ></div>
                                <div
                                    class="h-2 w-2 rounded-full bg-amber-300"
                                ></div>
                                <div
                                    class="h-2 w-2 rounded-full bg-rose-300"
                                ></div>
                            </div>
                            <span class="text-sm font-light italic"
                                >Love never fails</span
                            >
                            <div class="flex items-center space-x-2">
                                <div
                                    class="h-2 w-2 rounded-full bg-rose-300"
                                ></div>
                                <div
                                    class="h-2 w-2 rounded-full bg-amber-300"
                                ></div>
                                <div
                                    class="h-2 w-2 rounded-full bg-rose-300"
                                ></div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="h-2 bg-gradient-to-r from-amber-300 via-rose-300 to-amber-300"
                    ></div>
                </div>
            </div> -->
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

@keyframes spin-very-slow {
    from {
        transform: rotate(45deg);
    }
    to {
        transform: rotate(405deg);
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

.animate-spin-very-slow {
    animation: spin-very-slow 60s linear infinite;
}

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

/* Custom shadow */
.shadow-3xl {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Enhanced smooth animations for bible verse container */
.bible-verse-container {
    transition: all 1.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transform-origin: center bottom;
}

/* Add subtle entrance animation for verse content */
.bible-verse-container .relative {
    transition: all 0.8s ease-out;
}

.bible-verse-container:not(.verse-visible) .relative {
    transform: translateY(30px);
}

.bible-verse-container.verse-visible .relative {
    transform: translateY(0);
    opacity: 1;
}

/* Enhanced hover effects for the main container */
.bible-verse-container:hover .relative {
    transform: translateY(-2px);
}

/* Add subtle animation to decorative elements */
.bible-verse-container:hover .animate-spin-very-slow {
    animation-duration: 30s;
}

/* Responsive adjustments for verse text */
@media (max-width: 768px) {
    .bible-verse-container .font-playfair {
        font-size: 1.5rem;
        line-height: 1.6;
    }

    .bible-verse-container .font-light {
        font-size: 1.125rem;
        line-height: 1.7;
    }
}
</style>
