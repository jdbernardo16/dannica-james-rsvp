<script setup lang="ts">
import { nextTick, onMounted, onUnmounted, ref } from 'vue';

const scale = ref(1);
const wrapperRef = ref<HTMLElement>();
const containerRef = ref<HTMLElement>();
const resizeObserver = ref<ResizeObserver | null>(null);

const updateScale = async () => {
    if (!wrapperRef.value || !containerRef.value) return;

    const viewportWidth = window.innerWidth;
    const designWidth = 1440;

    if (viewportWidth < designWidth) {
        scale.value = viewportWidth / designWidth;

        containerRef.value.style.width = `${viewportWidth}px`;
        containerRef.value.style.overflow = 'hidden';

        await nextTick();

        // Use a small delay to ensure content is fully rendered
        requestAnimationFrame(() => {
            if (!wrapperRef.value || !containerRef.value) return;

            const wrapperHeight = wrapperRef.value.scrollHeight;
            const scaledHeight = wrapperHeight * scale.value;
            containerRef.value.style.height = `${scaledHeight}px`;
        });
    } else {
        scale.value = 1;
        containerRef.value.style.width = '100%';
        containerRef.value.style.overflow = 'visible';
        containerRef.value.style.height = 'auto';
    }
};

onMounted(() => {
    updateScale();
    window.addEventListener('resize', updateScale);

    // Watch for content size changes and recalculate height
    if (wrapperRef.value) {
        resizeObserver.value = new ResizeObserver(() => {
            if (scale.value < 1) {
                requestAnimationFrame(() => {
                    if (!wrapperRef.value || !containerRef.value) return;
                    const wrapperHeight = wrapperRef.value.scrollHeight;
                    const scaledHeight = wrapperHeight * scale.value;
                    containerRef.value.style.height = `${scaledHeight}px`;
                });
            }
        });
        resizeObserver.value.observe(wrapperRef.value);
    }
});

onUnmounted(() => {
    window.removeEventListener('resize', updateScale);
    if (resizeObserver.value) {
        resizeObserver.value.disconnect();
    }
});
</script>

<template>
    <div ref="containerRef" class="non-responsive-container">
        <div
            ref="wrapperRef"
            class="non-responsive-wrapper"
            :style="{
                transform: `scale(${scale})`,
                transformOrigin: 'top left',
                width: scale < 1 ? '1440px' : '100%',
            }"
        >
            <slot />
        </div>
    </div>
</template>

<style scoped>
.non-responsive-container {
    width: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    min-height: 100vh;
}

.non-responsive-wrapper {
    transition: transform 0.3s ease-out;
    width: 1440px;
    min-width: 1440px;
    transform-origin: top left;
}

@media (min-width: 1440px) {
    .non-responsive-container {
        overflow-x: visible;
        height: auto;
    }

    .non-responsive-wrapper {
        width: 100%;
        min-width: auto;
        transform: none !important;
    }
}
</style>
