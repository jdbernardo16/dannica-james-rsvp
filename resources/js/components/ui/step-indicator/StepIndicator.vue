<template>
  <div class="flex items-center justify-between w-full max-w-2xl mx-auto">
    <div
      v-for="(step, index) in steps"
      :key="index"
      class="flex items-center"
      :class="{ 'flex-1': index < steps.length - 1 }"
    >
      <div class="flex items-center">
        <div
          :class="[
            'flex items-center justify-center w-10 h-10 rounded-full border-2 font-semibold text-sm transition-colors',
            getStepClass(index)
          ]"
        >
          <Check
            v-if="isCompleted(index)"
            class="w-5 h-5"
          />
          <span v-else>{{ index + 1 }}</span>
        </div>
        <span
          :class="[
            'ml-3 text-sm font-medium transition-colors',
            getStepTextClass(index)
          ]"
        >
          {{ step.title }}
        </span>
      </div>
      
      <div
        v-if="index < steps.length - 1"
        :class="[
          'flex-1 h-1 mx-4 transition-colors',
          getConnectorClass(index)
        ]"
      />
    </div>
  </div>
</template>

<script setup lang="ts">
import { Check } from 'lucide-vue-next';

interface Step {
  title: string;
}

interface Props {
  steps: Step[];
  currentStep: number;
}

const props = defineProps<Props>();

const isCompleted = (index: number): boolean => {
  return index < props.currentStep;
};

const isActive = (index: number): boolean => {
  return index === props.currentStep;
};

const getStepClass = (index: number): string => {
  if (isCompleted(index)) {
    return 'bg-primary text-primary-foreground border-primary';
  }
  if (isActive(index)) {
    return 'border-primary text-primary bg-primary/10';
  }
  return 'border-muted-foreground text-muted-foreground bg-background';
};

const getStepTextClass = (index: number): string => {
  if (isCompleted(index) || isActive(index)) {
    return 'text-foreground';
  }
  return 'text-muted-foreground';
};

const getConnectorClass = (index: number): string => {
  if (isCompleted(index)) {
    return 'bg-primary';
  }
  return 'bg-muted';
};
</script>