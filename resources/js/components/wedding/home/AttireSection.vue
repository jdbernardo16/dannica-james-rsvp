<script setup lang="ts">
import OptimizedImage from '@/components/OptimizedImage.vue';
import { onMounted, onUnmounted, ref } from 'vue';

const elementsVisible = ref({
    title: false,
    principalSponsors: false,
    guests: false,
    colorSwatches: false,
});

const handleScroll = () => {
    const titleEl = document.querySelector('.attire-title');
    const principalSponsorsEl = document.querySelector('.principal-sponsors');
    const guestsEl = document.querySelector('.guests-section');
    const colorSwatchesEl = document.querySelector('.color-swatches');

    const windowHeight = window.innerHeight;

    if (titleEl) {
        const rect = titleEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.title = true;
        }
    }

    if (principalSponsorsEl) {
        const rect = principalSponsorsEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.principalSponsors = true;
        }
    }

    if (guestsEl) {
        const rect = guestsEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.guests = true;
        }
    }

    if (colorSwatchesEl) {
        const rect = colorSwatchesEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            elementsVisible.value.colorSwatches = true;
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
        id="attire"
        class="relative overflow-hidden bg-gradient-to-b from-amber-50/30 via-white to-rose-50/30 py-16 md:py-24"
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

        <div class="relative z-10 mx-auto max-w-6xl px-6 sm:px-8 lg:px-12">
            <!-- Section Title -->
            <div class="mb-16 text-center md:mb-20">
                <h2
                    class="attire-title mb-6 font-secondary text-4xl leading-tight font-light text-gray-800 transition-all duration-1000 ease-out sm:text-5xl md:text-6xl lg:text-7xl"
                    :class="
                        elementsVisible.title
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    Attire
                </h2>
                <p
                    class="mx-auto max-w-2xl text-lg leading-relaxed font-light text-gray-600 transition-all delay-200 duration-1000 ease-out md:text-xl"
                    :class="
                        elementsVisible.title
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    Join us in celebrating our special day with these suggested
                    attire guidelines
                </p>
            </div>

            <!-- Principal Sponsors Section -->
            <div
                class="principal-sponsors mb-20 transition-all delay-300 duration-1000 ease-out md:mb-24"
                :class="
                    elementsVisible.principalSponsors
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <div class="mb-12 text-center">
                    <h3
                        class="mb-4 font-secondary text-3xl font-light text-gray-800 sm:text-4xl md:text-5xl"
                    >
                        Principal Sponsors
                    </h3>
                    <div
                        class="mx-auto h-1 w-24 bg-gradient-to-r from-amber-400 to-rose-400"
                    ></div>
                </div>

                <div class="grid gap-8 md:grid-cols-2">
                    <!-- Gentlemen Attire -->
                    <div
                        class="group overflow-hidden rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 p-6 shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl md:p-8"
                    >
                        <div class="mb-6">
                            <h4
                                class="mb-3 font-secondary text-2xl font-light text-gray-800 transition-colors duration-300 group-hover:text-amber-700 sm:text-3xl"
                            >
                                Gentlemen
                            </h4>
                            <div class="flex items-center space-x-2">
                                <div class="h-0.5 w-8 bg-amber-400"></div>
                                <span
                                    class="text-sm font-medium tracking-wider text-amber-600 uppercase"
                                    >Formal</span
                                >
                                <div class="h-0.5 flex-1 bg-amber-400"></div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div
                                class="relative aspect-[4/5] w-full overflow-hidden rounded-xl bg-amber-50"
                            >
                                <!-- Placeholder for attire image -->
                                <OptimizedImage
                                    src="/images/barong.png"
                                    alt=""
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <p class="text-lg font-light text-gray-700">
                                Barong Tagalog
                            </p>
                            <p class="text-lg font-light text-gray-700">
                                Black pants
                            </p>
                        </div>
                    </div>

                    <!-- Ladies Attire -->
                    <div
                        class="group overflow-hidden rounded-2xl bg-gradient-to-br from-rose-50 to-rose-100 p-6 shadow-lg transition-all duration-500 hover:scale-[1.02] hover:shadow-2xl md:p-8"
                    >
                        <div class="mb-6">
                            <h4
                                class="mb-3 font-secondary text-2xl font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-700 sm:text-3xl"
                            >
                                Ladies
                            </h4>
                            <div class="flex items-center space-x-2">
                                <div class="h-0.5 w-8 bg-rose-400"></div>
                                <span
                                    class="text-sm font-medium tracking-wider text-rose-600 uppercase"
                                    >Elegant</span
                                >
                                <div class="h-0.5 flex-1 bg-rose-400"></div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div
                                class="relative aspect-[4/5] w-full overflow-hidden rounded-xl bg-rose-50"
                            >
                                <!-- Placeholder for attire image -->
                                <OptimizedImage
                                    src="/images/filipiniana.png"
                                    alt=""
                                    class="h-full w-full object-cover"
                                    loading="lazy"
                                />
                            </div>
                        </div>

                        <div class="space-y-2">
                            <p class="text-lg font-light text-gray-700">
                                Filipiniana dress or butterfly dress
                            </p>
                            <div class="flex items-center">
                                <OptimizedImage
                                    src="/images/color-pallete.png"
                                    alt=""
                                    class="h-16"
                                    loading="lazy"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guests Section -->
            <div
                class="guests-section mb-20 transition-all delay-500 duration-1000 ease-out md:mb-24"
                :class="
                    elementsVisible.guests
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <div class="mb-12 text-center">
                    <h3
                        class="mb-4 font-secondary text-3xl font-light text-gray-800 sm:text-4xl md:text-5xl"
                    >
                        Guests
                    </h3>
                    <div
                        class="mx-auto h-1 w-24 bg-gradient-to-r from-rose-400 to-amber-400"
                    ></div>
                </div>

                <div class="mx-auto max-w-3xl text-center">
                    <div class="mb-8">
                        <div class="space-y-4">
                            <div class="rounded-xl bg-gray-50 p-6 shadow-sm">
                                <p class="text-lg font-light text-gray-700">
                                    <span class="font-medium">Gentlemen:</span>
                                    Semi-Formal - Barong or Long Sleeves
                                </p>
                            </div>
                            <div class="rounded-xl bg-purple-50 p-6 shadow-sm">
                                <p class="text-lg font-light text-gray-700">
                                    <span class="font-medium">Ladies:</span>
                                    Semi-Formal - Modern Filipiniana or Puff
                                    Sleeves
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Color Swatches Section -->
            <div
                class="color-swatches transition-all delay-700 duration-1000 ease-out"
                :class="
                    elementsVisible.colorSwatches
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <div class="mb-12 text-center">
                    <h3
                        class="mb-4 font-secondary text-3xl font-light text-gray-800 sm:text-4xl md:text-5xl"
                    >
                        Color Palette
                    </h3>
                    <div
                        class="mx-auto h-1 w-24 bg-gradient-to-r from-amber-400 via-rose-400 to-amber-600"
                    ></div>
                    <p
                        class="mt-4 text-center text-lg font-light text-gray-600"
                    >
                        Complementary colors for the celebration
                    </p>
                </div>

                <div class="flex justify-center">
                    <div class="inline-flex rounded-2xl bg-white p-2 shadow-lg">
                        <div class="grid grid-cols-4 gap-2">
                            <!-- Dusty Rose -->
                            <div class="group relative">
                                <div
                                    class="h-20 w-20 rounded-xl shadow-md transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg md:h-24 md:w-24"
                                    style="background: #f6d7d7"
                                ></div>
                                <div
                                    class="absolute right-0 bottom-0 left-0 rounded-b-xl bg-black/70 p-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                                >
                                    <p
                                        class="text-center text-xs font-medium text-white"
                                    >
                                        Dusty Rose
                                    </p>
                                </div>
                            </div>

                            <!-- Coral -->
                            <div class="group relative">
                                <div
                                    class="h-20 w-20 rounded-xl shadow-md transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg md:h-24 md:w-24"
                                    style="background: #e8b7b0"
                                ></div>
                                <div
                                    class="absolute right-0 bottom-0 left-0 rounded-b-xl bg-black/70 p-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                                >
                                    <p
                                        class="text-center text-xs font-medium text-white"
                                    >
                                        Coral
                                    </p>
                                </div>
                            </div>

                            <!-- Terracotta -->
                            <div class="group relative">
                                <div
                                    class="h-20 w-20 rounded-xl shadow-md transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg md:h-24 md:w-24"
                                    style="background: #d89a92"
                                ></div>
                                <div
                                    class="absolute right-0 bottom-0 left-0 rounded-b-xl bg-black/70 p-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                                >
                                    <p
                                        class="text-center text-xs font-medium text-white"
                                    >
                                        Terracotta
                                    </p>
                                </div>
                            </div>

                            <!-- Burnt Sienna -->
                            <div class="group relative">
                                <div
                                    class="h-20 w-20 rounded-xl shadow-md transition-all duration-300 group-hover:scale-105 group-hover:shadow-lg md:h-24 md:w-24"
                                    style="background: #c77a6f"
                                ></div>
                                <div
                                    class="absolute right-0 bottom-0 left-0 rounded-b-xl bg-black/70 p-2 opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                                >
                                    <p
                                        class="text-center text-xs font-medium text-white"
                                    >
                                        Burnt Sienna
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.animate-spin-slow {
    animation: spin 20s linear infinite;
}

.animate-spin-slow-reverse {
    animation: spin 25s linear infinite reverse;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
</style>
