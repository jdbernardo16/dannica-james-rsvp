<script setup lang="ts">
import { ref } from 'vue';
import OptimizedImage from './OptimizedImage.vue';

interface GalleryImage {
    src: string;
    alt: string;
}

const props = defineProps<{
    images: GalleryImage[];
    backgroundColor?: string;
    padding?: string;
}>();

const isLightboxOpen = ref(false);
const currentImageIndex = ref(0);

const openLightbox = (index: number) => {
    currentImageIndex.value = index;
    isLightboxOpen.value = true;
    document.body.style.overflow = 'hidden';
};

const closeLightbox = () => {
    isLightboxOpen.value = false;
    document.body.style.overflow = 'auto';
};

const nextImage = () => {
    currentImageIndex.value =
        (currentImageIndex.value + 1) % props.images.length;
};

const prevImage = () => {
    currentImageIndex.value =
        (currentImageIndex.value - 1 + props.images.length) %
        props.images.length;
};

const handleKeydown = (event: KeyboardEvent) => {
    if (!isLightboxOpen.value) return;

    if (event.key === 'Escape') closeLightbox();
    if (event.key === 'ArrowRight') nextImage();
    if (event.key === 'ArrowLeft') prevImage();
};

// Add keyboard event listener
import { onMounted, onUnmounted } from 'vue';

onMounted(() => {
    document.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
    document.removeEventListener('keydown', handleKeydown);
    document.body.style.overflow = 'auto';
});
</script>

<template>
    <section :class="backgroundColor || 'bg-[#e6cabf]'">
        <div :class="['grid grid-cols-3 gap-10', padding || 'p-20']">
            <div
                v-for="(image, index) in images"
                :key="index"
                class="aspect-square transform cursor-pointer overflow-hidden rounded-xl transition-transform duration-300 hover:scale-105"
                @click="openLightbox(index)"
            >
                <OptimizedImage
                    :src="image.src"
                    :alt="image.alt"
                    class="h-full w-full object-cover"
                    loading="lazy"
                />
            </div>
        </div>
    </section>

    <!-- Custom Lightbox -->
    <Teleport to="body">
        <div
            v-if="isLightboxOpen"
            class="bg-opacity-90 fixed inset-0 z-50 flex items-center justify-center bg-black"
            @click="closeLightbox"
        >
            <div class="relative max-h-screen max-w-7xl p-4" @click.stop>
                <!-- Close button -->
                <button
                    @click="closeLightbox"
                    class="bg-opacity-20 hover:bg-opacity-30 absolute top-4 right-4 z-10 rounded-full bg-white p-2 text-white transition-all"
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </button>

                <!-- Image -->
                <img
                    :src="images[currentImageIndex].src"
                    :alt="images[currentImageIndex].alt"
                    class="max-h-full max-w-full object-contain"
                />

                <!-- Navigation buttons -->
                <button
                    v-if="images.length > 1"
                    @click="prevImage"
                    class="bg-opacity-20 hover:bg-opacity-30 absolute top-1/2 left-4 -translate-y-1/2 rounded-full bg-white p-2 text-white transition-all"
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7 7"
                        />
                    </svg>
                </button>

                <button
                    v-if="images.length > 1"
                    @click="nextImage"
                    class="bg-opacity-20 hover:bg-opacity-30 absolute top-1/2 right-4 -translate-y-1/2 rounded-full bg-white p-2 text-white transition-all"
                >
                    <svg
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>
                </button>

                <!-- Image counter -->
                <div
                    v-if="images.length > 1"
                    class="bg-opacity-20 absolute bottom-4 left-1/2 -translate-x-1/2 rounded-full bg-white px-3 py-1 text-sm text-white"
                >
                    {{ currentImageIndex + 1 }} / {{ images.length }}
                </div>
            </div>
        </div>
    </Teleport>
</template>

<style scoped>
/* Custom lightbox styles */
.fixed {
    position: fixed;
}

.inset-0 {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
}

.z-50 {
    z-index: 50;
}

.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.justify-center {
    justify-content: center;
}

.bg-black {
    background-color: rgb(0, 0, 0);
}

.bg-opacity-90 {
    background-color: rgba(0, 0, 0, 0.9);
}

.relative {
    position: relative;
}

.max-w-7xl {
    max-width: 80rem;
}

.max-h-screen {
    max-height: 100vh;
}

.p-4 {
    padding: 1rem;
}

.absolute {
    position: absolute;
}

.top-4 {
    top: 1rem;
}

.right-4 {
    right: 1rem;
}

.left-4 {
    left: 1rem;
}

.z-10 {
    z-index: 10;
}

.rounded-full {
    border-radius: 9999px;
}

.bg-white {
    background-color: rgb(255, 255, 255);
}

.bg-opacity-20 {
    background-color: rgba(255, 255, 255, 0.2);
}

.hover\:bg-opacity-30:hover {
    background-color: rgba(255, 255, 255, 0.3);
}

.p-2 {
    padding: 0.5rem;
}

.text-white {
    color: rgb(255, 255, 255);
}

.transition-all {
    transition-property: all;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 150ms;
}

.h-6 {
    height: 1.5rem;
}

.w-6 {
    width: 1.5rem;
}

.top-1\/2 {
    top: 50%;
}

.-translate-y-1\/2 {
    transform: translateY(-50%);
}

.bottom-4 {
    bottom: 1rem;
}

.left-1\/2 {
    left: 50%;
}

.-translate-x-1\/2 {
    transform: translateX(-50%);
}

.px-3 {
    padding-left: 0.75rem;
    padding-right: 0.75rem;
}

.py-1 {
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}

.text-sm {
    font-size: 0.875rem;
    line-height: 1.25rem;
}

.max-w-full {
    max-width: 100%;
}

.max-h-full {
    max-height: 100%;
}

.object-contain {
    object-fit: contain;
}
</style>
