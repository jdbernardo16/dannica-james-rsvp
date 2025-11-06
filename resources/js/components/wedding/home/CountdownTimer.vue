<script lang="ts" setup>
import { onMounted, onUnmounted, ref } from 'vue';

interface Props {
    targetDate: Date;
}

const props = defineProps<Props>();

const days = ref(0);
const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);

let intervalId: number | null = null;

const updateCountdown = () => {
    const now = new Date().getTime();
    const target = props.targetDate.getTime();
    const difference = target - now;

    if (difference > 0) {
        days.value = Math.floor(difference / (1000 * 60 * 60 * 24));
        hours.value = Math.floor(
            (difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60),
        );
        minutes.value = Math.floor(
            (difference % (1000 * 60 * 60)) / (1000 * 60),
        );
        seconds.value = Math.floor((difference % (1000 * 60)) / 1000);
    } else {
        days.value = 0;
        hours.value = 0;
        minutes.value = 0;
        seconds.value = 0;
        if (intervalId) {
            clearInterval(intervalId);
            intervalId = null;
        }
    }
};

onMounted(() => {
    updateCountdown();
    intervalId = setInterval(updateCountdown, 1000);
});

onUnmounted(() => {
    if (intervalId) {
        clearInterval(intervalId);
    }
});
</script>

<template>
    <div class="flex w-full justify-between space-x-7">
        <div class="w-1/4">
            <div
                class="mb-5 grid aspect-square place-items-center rounded-2xl border-2 border-[#4c0211] text-6xl font-bold"
            >
                {{ days }}
            </div>
            <p class="font-wedding-body text-2xl font-medium uppercase">Days</p>
        </div>
        <div class="w-1/4">
            <div
                class="mb-5 grid aspect-square place-items-center rounded-2xl border-2 border-[#4c0211] text-6xl font-bold"
            >
                {{ hours }}
            </div>
            <p class="font-wedding-body text-2xl font-medium uppercase">
                Hours
            </p>
        </div>
        <div class="w-1/4">
            <div
                class="mb-5 grid aspect-square place-items-center rounded-2xl border-2 border-[#4c0211] text-6xl font-bold"
            >
                {{ minutes }}
            </div>
            <p class="font-wedding-body text-2xl font-medium uppercase">
                Minutes
            </p>
        </div>
        <div class="w-1/4">
            <div
                class="mb-5 grid aspect-square place-items-center rounded-2xl border-2 border-[#4c0211] text-6xl font-bold"
            >
                {{ seconds }}
            </div>
            <p class="font-wedding-body text-2xl font-medium uppercase">
                Seconds
            </p>
        </div>
    </div>
</template>
