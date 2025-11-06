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
                    <OptimizedImage
                        src="/images/cursor-text.svg"
                        alt="Cursor"
                        class="animate-spin-slow"
                        loading="lazy"
                    />
                    <OptimizedImage
                        src="/images/play.svg"
                        alt="play"
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                        loading="lazy"
                    />
                </div>
            </div>
        </div>
    </section>
</template>

<script setup lang="ts">
import OptimizedImage from '@/components/OptimizedImage.vue';
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

const container = ref<HTMLElement | null>(null);
const customCursor = ref<HTMLElement | null>(null);
const videoElement = ref<HTMLVideoElement | null>(null);
const isFullscreen = ref(false);

// Get the scale factor from NonResponsiveWrapper
const getScaleFactor = () => {
    const wrapper = document.querySelector('.non-responsive-wrapper');
    if (wrapper) {
        const transform = window.getComputedStyle(wrapper).transform;
        if (transform && transform !== 'none') {
            const matrix = transform.match(/matrix\(([^)]+)\)/);
            if (matrix) {
                const values = matrix[1].split(',').map(parseFloat);
                // For uniform scaling, scaleX and scaleY should be the same
                return values[0]; // scaleX value
            }
        }
    }
    return 1; // Default scale if no transformation is found
};

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
        const scaleFactor = getScaleFactor();

        // Adjust coordinates to account for the scaling
        const x = (e.clientX - rect.left) / scaleFactor;
        const y = (e.clientY - rect.top) / scaleFactor;

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

// Add touch event handler for mobile devices
const onTouchStart = (e: TouchEvent) => {
    if (!videoElement.value || e.touches.length === 0) return;

    const rect = container.value?.getBoundingClientRect();
    if (!rect) return;

    const scaleFactor = getScaleFactor();
    const touch = e.touches[0];

    // Adjust touch coordinates to account for scaling
    const x = (touch.clientX - rect.left) / scaleFactor;
    const y = (touch.clientY - rect.top) / scaleFactor;

    // Check if touch is within video bounds
    if (
        x >= 0 &&
        x <= rect.width / scaleFactor &&
        y >= 0 &&
        y <= rect.height / scaleFactor
    ) {
        e.preventDefault();
        toggleFullscreen();
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
        // Add touch event listener for mobile devices
        container.value.addEventListener('touchstart', onTouchStart, {
            passive: false,
        });
    }

    // Listen for fullscreen changes
    document.addEventListener('fullscreenchange', handleFullscreenChange);
});

onBeforeUnmount(() => {
    if (container.value) {
        container.value.removeEventListener('mousemove', onMouseMove);
        container.value.removeEventListener('touchstart', onTouchStart);
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
