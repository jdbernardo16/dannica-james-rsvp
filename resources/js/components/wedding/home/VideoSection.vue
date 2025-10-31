<template>
    <section id="video">
        <div class="relative m-auto w-full">
            <div
                ref="container"
                class="relative aspect-[375/211] w-full cursor-none overflow-hidden md:aspect-[1440/737]"
            >
                <video
                    ref="videoElement"
                    :class="videoClasses"
                    autoplay
                    muted
                    loop
                >
                    <source src="/videos/video.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black to-transparent"
                ></div>
                <div
                    ref="customCursor"
                    class="custom-cursor absolute top-0 left-0 h-[220px] w-[220px] cursor-pointer"
                    @click="toggleFullscreen"
                >
                    <OptimizedImage src="/images/cursor-text.svg" alt="Cursor" class="animate-spin-slow" loading="lazy" />
                    <OptimizedImage src="/images/play.svg" alt="play" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" loading="lazy" />
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import OptimizedImage from '@/components/OptimizedImage.vue';

const container = ref<HTMLElement | null>(null);
const customCursor = ref<HTMLElement | null>(null);
const videoElement = ref<HTMLVideoElement | null>(null);
const isFullscreen = ref(false);

const videoClasses = computed(() => {
    if (isFullscreen.value) {
        // Default video styling for fullscreen - no custom positioning
        return 'w-full h-full object-cover';
    }
    // Normal styling with custom positioning and scaling
    return 'absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 scale-130 transition-all duration-300 w-full';
});

const onMouseMove = (e: MouseEvent) => {
    if (customCursor.value && container.value) {
        const rect = container.value.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        const cursorWidth = customCursor.value.offsetWidth;
        const cursorHeight = customCursor.value.offsetHeight;

        customCursor.value.style.transform = `translate3d(${
            x - cursorWidth / 2
        }px, ${y - cursorHeight / 2}px, 0)`;
    }
};

const toggleFullscreen = async () => {
    if (!videoElement.value) return;

    try {
        if (!document.fullscreenElement) {
            // Enter fullscreen
            await videoElement.value.requestFullscreen();
            isFullscreen.value = true;

            // Optional: Show video controls in fullscreen
            videoElement.value.controls = true;

            // Optional: Unmute video in fullscreen for better experience
            videoElement.value.muted = false;
        } else {
            // Exit fullscreen
            await document.exitFullscreen();
        }
    } catch (error) {
        console.error('Error toggling fullscreen:', error);
    }
};

const handleFullscreenChange = () => {
    isFullscreen.value = !!document.fullscreenElement;

    if (videoElement.value) {
        if (!isFullscreen.value) {
            // Reset video properties when exiting fullscreen
            videoElement.value.controls = false;
            videoElement.value.muted = true;
        }
    }
};

onMounted(() => {
    if (container.value) {
        container.value.addEventListener('mousemove', onMouseMove);
    }

    // Listen for fullscreen changes
    document.addEventListener('fullscreenchange', handleFullscreenChange);
});

onBeforeUnmount(() => {
    if (container.value) {
        container.value.removeEventListener('mousemove', onMouseMove);
    }

    // Clean up fullscreen event listener
    document.removeEventListener('fullscreenchange', handleFullscreenChange);
});
</script>

<style scoped>
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}
.animate-spin-slow {
    animation: spin 20s linear infinite;
}
.custom-cursor {
    will-change: transform; /* Performance optimization */
    transition: opacity 0.2s ease;
}

.custom-cursor:hover {
    opacity: 0.8;
}

/* Hide custom cursor when video is in fullscreen */
:fullscreen .custom-cursor {
    display: none;
}
</style>
