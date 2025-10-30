<script lang="ts" setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';

const weddingDate = new Date('2025-12-15T00:00:00');
const timeLeft = ref({
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0,
});

const isVisible = ref(false);

const calculateTimeLeft = () => {
    const now = new Date().getTime();
    const distance = weddingDate.getTime() - now;

    if (distance > 0) {
        timeLeft.value = {
            days: Math.floor(distance / (1000 * 60 * 60 * 24)),
            hours: Math.floor(
                (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60),
            ),
            minutes: Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)),
            seconds: Math.floor((distance % (1000 * 60)) / 1000),
        };
    } else {
        timeLeft.value = { days: 0, hours: 0, minutes: 0, seconds: 0 };
    }
};

let interval: number;

onMounted(() => {
    calculateTimeLeft();
    interval = setInterval(calculateTimeLeft, 1000);
    setTimeout(() => {
        isVisible.value = true;
    }, 100);
});

onUnmounted(() => {
    if (interval) clearInterval(interval);
});

const formattedDate = computed(() => {
    return weddingDate.toLocaleDateString('en-US', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    });
});

const countdownItems = computed(() => [
    { value: timeLeft.value.days, label: 'Days' },
    { value: timeLeft.value.hours, label: 'Hours' },
    { value: timeLeft.value.minutes, label: 'Minutes' },
    { value: timeLeft.value.seconds, label: 'Seconds' },
]);
</script>

<template>
    <section
        class="relative overflow-hidden bg-gradient-to-b from-white via-rose-50/30 to-white py-24 md:py-32"
    >
        <!-- Floating decorative elements -->
        <div class="pointer-events-none absolute inset-0 overflow-hidden">
            <div
                class="animate-float absolute top-20 left-10 h-32 w-32 opacity-10"
            >
                <svg viewBox="0 0 100 100" class="text-rose-300">
                    <circle cx="50" cy="50" r="40" fill="currentColor" />
                </svg>
            </div>
            <div
                class="animate-float-delayed absolute right-16 bottom-32 h-24 w-24 opacity-10"
            >
                <svg viewBox="0 0 100 100" class="text-amber-300">
                    <circle cx="50" cy="50" r="35" fill="currentColor" />
                </svg>
            </div>
        </div>

        <div class="relative z-10 container mx-auto px-6">
            <!-- Decorative header image -->
            <div
                class="mx-auto mb-12 max-w-[500px] transition-all duration-1000 ease-out"
                :class="
                    isVisible
                        ? 'translate-y-0 opacity-80'
                        : '-translate-y-4 opacity-0'
                "
            >
                <img class="w-full" src="/images/element1.png" alt="element" />
            </div>

            <!-- Header section -->
            <div
                class="mb-20 text-center transition-all delay-200 duration-1000 ease-out"
                :class="
                    isVisible
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-4 opacity-0'
                "
            >
                <div class="mb-6 inline-block">
                    <div class="flex items-center space-x-3">
                        <div
                            class="h-px w-12 bg-gradient-to-r from-transparent to-rose-300"
                        ></div>
                        <svg
                            class="h-6 w-6 text-rose-400"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                            />
                        </svg>
                        <div
                            class="h-px w-12 bg-gradient-to-l from-transparent to-rose-300"
                        ></div>
                    </div>
                </div>

                <h2
                    class="font-secondary mb-6 text-6xl font-light tracking-wide text-gray-800 md:text-7xl"
                >
                    Save the Date
                </h2>

                <!-- Date and Location with enhanced styling -->
                <div
                    class="font-playfair mb-6 flex flex-col items-center justify-center space-y-2 text-center text-2xl font-light md:flex-row md:space-y-0 md:space-x-4 md:text-3xl"
                >
                    <p class="text-rose-600">December 15, 2025</p>
                    <span class="hidden text-gray-400 md:inline">•</span>
                    <p class="text-gray-700">Intramuros Manila</p>
                </div>

                <p
                    class="mx-auto max-w-2xl text-xl leading-relaxed font-light text-gray-600"
                >
                    Mark your calendars for our special day as we celebrate love
                    and new beginnings
                </p>
            </div>

            <div class="mx-auto max-w-6xl">
                <!-- Enhanced Countdown Timer -->
                <div
                    class="mb-20 transition-all delay-500 duration-1000 ease-out"
                    :class="
                        isVisible
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <div
                        class="flex flex-wrap items-start justify-center gap-3 md:gap-6"
                    >
                        <template
                            v-for="(item, index) in countdownItems"
                            :key="item.label"
                        >
                            <!-- Countdown card -->
                            <div
                                class="countdown-card group cursor-default"
                                :style="{ animationDelay: `${index * 100}ms` }"
                            >
                                <div
                                    class="min-w-[100px] rounded-2xl border border-rose-100 bg-white p-6 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-200 hover:shadow-2xl md:min-w-[140px] md:p-8"
                                >
                                    <div
                                        class="mb-3 bg-gradient-to-br from-rose-500 to-amber-500 bg-clip-text text-5xl leading-none font-light text-transparent transition-transform duration-500 group-hover:scale-110 md:text-7xl"
                                    >
                                        {{
                                            String(item.value).padStart(2, '0')
                                        }}
                                    </div>
                                    <div
                                        class="text-xs font-medium tracking-[0.2em] text-gray-500 uppercase md:text-sm"
                                    >
                                        {{ item.label }}
                                    </div>
                                </div>
                            </div>

                            <!-- Separator -->
                            <div
                                v-if="index < countdownItems.length - 1"
                                class="mt-6 hidden items-center text-4xl font-light text-rose-300 opacity-50 md:flex md:text-5xl"
                            >
                                •
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Decorative footer -->
                <div
                    class="text-center transition-all delay-700 duration-1000 ease-out"
                    :class="
                        isVisible
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-4 opacity-0'
                    "
                >
                    <div class="inline-flex flex-col items-center space-y-6">
                        <!-- Quote or message -->
                        <p
                            class="max-w-md text-lg font-light text-gray-500 italic"
                        >
                            "Two souls with but a single thought, two hearts
                            that beat as one"
                        </p>

                        <!-- Decorative divider -->
                        <div class="flex items-center space-x-4">
                            <div
                                class="h-px w-20 bg-gradient-to-r from-transparent via-rose-300 to-transparent"
                            ></div>
                            <div class="relative">
                                <svg
                                    class="animate-pulse-slow h-10 w-10 text-rose-400"
                                    fill="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                    />
                                </svg>
                            </div>
                            <div
                                class="h-px w-20 bg-gradient-to-l from-transparent via-rose-300 to-transparent"
                            ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes float {
    0%,
    100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
}

@keyframes float-delayed {
    0%,
    100% {
        transform: translateY(0px) translateX(0px);
    }
    50% {
        transform: translateY(-15px) translateX(10px);
    }
}

@keyframes pulse-slow {
    0%,
    100% {
        opacity: 1;
        transform: scale(1);
    }
    50% {
        opacity: 0.8;
        transform: scale(1.05);
    }
}

.animate-float {
    animation: float 6s ease-in-out infinite;
}

.animate-float-delayed {
    animation: float-delayed 8s ease-in-out infinite;
}

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

.countdown-card {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
