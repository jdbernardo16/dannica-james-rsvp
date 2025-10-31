<script setup lang="ts">
import { cn } from '@/lib/utils'
import { ChevronDown } from 'lucide-vue-next'
import { computed, ref, watch, type HTMLAttributes } from 'vue'

interface Option {
    value: string
    label: string
}

const props = defineProps<{
    modelValue?: string
    options: Option[]
    placeholder?: string
    class?: HTMLAttributes['class']
    required?: boolean
}>()

const emit = defineEmits<{
    'update:modelValue': [value: string]
}>()

const isOpen = ref(false)
const selectedValue = ref(props.modelValue || '')
const selectRef = ref<HTMLElement>()

// Update selected value when prop changes
watch(() => props.modelValue, (newValue) => {
    selectedValue.value = newValue || ''
})

const selectedLabel = computed(() => {
    const option = props.options.find(opt => opt.value === selectedValue.value)
    return option ? option.label : props.placeholder || 'Select an option'
})

const toggleDropdown = () => {
    isOpen.value = !isOpen.value
}

const selectOption = (value: string) => {
    selectedValue.value = value
    emit('update:modelValue', value)
    isOpen.value = false
}

const handleClickOutside = (event: MouseEvent) => {
    if (selectRef.value && !selectRef.value.contains(event.target as Node)) {
        isOpen.value = false
    }
}

// Add click outside listener
if (typeof document !== 'undefined') {
    document.addEventListener('click', handleClickOutside)
}
</script>

<template>
    <div ref="selectRef" class="relative" :class="props.class">
        <button
            type="button"
            @click="toggleDropdown"
            :class="cn(
                'flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50',
                props.class
            )"
        >
            <span class="truncate">{{ selectedLabel }}</span>
            <ChevronDown class="h-4 w-4 opacity-50 transition-transform" :class="{ 'rotate-180': isOpen }" />
        </button>
        
        <div
            v-if="isOpen"
            class="absolute top-full left-0 right-0 z-50 mt-1 max-h-60 overflow-auto rounded-md border border-input bg-popover text-popover-foreground shadow-md"
        >
            <div class="p-1">
                <button
                    v-for="option in options"
                    :key="option.value"
                    type="button"
                    @click="selectOption(option.value)"
                    :class="cn(
                        'relative flex w-full cursor-default select-none items-center rounded-sm py-1.5 pl-8 pr-2 text-sm outline-none hover:bg-accent hover:text-accent-foreground focus:bg-accent focus:text-accent-foreground',
                        selectedValue === option.value && 'bg-accent text-accent-foreground'
                    )"
                >
                    <span
                        v-if="selectedValue === option.value"
                        class="absolute left-2 flex h-3.5 w-3.5 items-center justify-center"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </span>
                    {{ option.label }}
                </button>
            </div>
        </div>
    </div>
</template>