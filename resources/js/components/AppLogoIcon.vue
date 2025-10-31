<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import OptimizedImage from './OptimizedImage.vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <OptimizedImage src="/images/logo.png" alt="" />
</template>
