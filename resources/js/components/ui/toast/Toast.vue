<script setup lang="ts">
import { AlertCircle, CheckCircle, X } from 'lucide-vue-next';
import { computed } from 'vue';

interface Props {
    message: string;
    type?: 'success' | 'error';
    show: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    type: 'success',
});

const emit = defineEmits<{
    close: [];
}>();

const iconClass = computed(() => {
    return props.type === 'success' ? 'text-green-600' : 'text-red-600';
});

const bgClass = computed(() => {
    return props.type === 'success' 
        ? 'bg-green-50 border-green-200 text-green-800' 
        : 'bg-red-50 border-red-200 text-red-800';
});

const icon = computed(() => {
    return props.type === 'success' ? CheckCircle : AlertCircle;
});
</script>

<template>
    <Transition
        enter-active-class="transition ease-out duration-300"
        enter-from-class="opacity-0 translate-y-2"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 translate-y-2"
    >
        <div
            v-if="show"
            :class="bgClass"
            class="fixed top-4 right-4 z-50 flex items-center gap-3 rounded-lg border p-4 shadow-lg max-w-sm"
        >
            <component :is="icon" :class="iconClass" class="h-5 w-5 flex-shrink-0" />
            <p class="text-sm font-medium">{{ message }}</p>
            <button
                @click="emit('close')"
                class="ml-auto rounded-md p-1 hover:bg-black/5 transition-colors"
            >
                <X class="h-4 w-4" />
            </button>
        </div>
    </Transition>
</template>