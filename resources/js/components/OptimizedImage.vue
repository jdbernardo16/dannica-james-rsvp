<script setup lang="ts">
import { computed, ref } from 'vue';
import { useOptimizedImage } from '@/composables/useOptimizedImage';

interface Props {
    src: string;
    alt?: string;
    class?: string;
    loading?: 'lazy' | 'eager';
    width?: string | number;
    height?: string | number;
}

const props = withDefaults(defineProps<Props>(), {
    alt: '',
    class: '',
    loading: 'lazy',
});

const optimizedSrc = computed(() => useOptimizedImage(props.src));
const hasError = ref(false);
const fallbackSrc = ref(props.src);

const handleImageError = () => {
    hasError.value = true;
    fallbackSrc.value = props.src;
};
</script>

<template>
    <picture v-if="!hasError">
        <source :srcset="optimizedSrc" type="image/webp" />
        <img
            :src="fallbackSrc"
            :alt="alt"
            :class="class"
            :loading="loading"
            :width="width"
            :height="height"
            @error="handleImageError"
        />
    </picture>
    <img
        v-else
        :src="fallbackSrc"
        :alt="alt"
        :class="class"
        :loading="loading"
        :width="width"
        :height="height"
    />
</template>
