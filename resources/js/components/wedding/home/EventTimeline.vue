<script lang="ts" setup>
import { onMounted, onUnmounted, ref } from 'vue';

const timelineEvents = ref([
    {
        time: '2:30 PM',
        title: 'Entourage Procession',
        description:
            'The beautiful beginning as our entourage makes their way down the aisle',
        visible: false,
    },
    {
        time: '3:00 PM',
        title: 'Wedding Ceremony',
        description: "The moment we say 'I do' and begin our forever together",
        visible: false,
    },
    {
        time: '4:30 PM',
        title: 'Cocktails & Photos',
        description:
            'Celebrate with drinks while we capture these precious moments',
        visible: false,
    },
    {
        time: '6:00 PM',
        title: 'Dinner & Photos',
        description: 'A feast to share with loved ones as evening unfolds',
        visible: false,
    },
    {
        time: '7:00 PM',
        title: 'Program & Fun',
        description: 'Games, laughter, and memories that will last a lifetime',
        visible: false,
    },
    {
        time: '7:15 PM',
        title: 'Dances & Advices',
        description:
            'First dance as husband and wife, followed by heartfelt wisdom',
        visible: false,
    },
    {
        time: '8:00 PM',
        title: 'Messages & SDE',
        description:
            'Words from the heart and a special same-day edit presentation',
        visible: false,
    },
]);

const timelineProgress = ref(0);

const handleScroll = () => {
    const elements = document.querySelectorAll('.timeline-event');
    const windowHeight = window.innerHeight;

    elements.forEach((el, index) => {
        const rect = el.getBoundingClientRect();
        const elementMiddle = rect.top + rect.height / 2;

        if (
            elementMiddle < windowHeight * 0.8 &&
            elementMiddle > 0 &&
            timelineEvents.value[index]
        ) {
            timelineEvents.value[index].visible = true;
        }
    });

    // Calculate timeline progress
    const timelineEl = document.querySelector('.timeline-container');
    if (timelineEl) {
        const rect = timelineEl.getBoundingClientRect();
        const scrolled = Math.max(0, -rect.top);
        const total = rect.height - windowHeight;
        timelineProgress.value = Math.min(100, (scrolled / total) * 100);
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Initial check

    // Trigger first event after mount
    setTimeout(() => {
        if (timelineEvents.value[0]) {
            timelineEvents.value[0].visible = true;
        }
    }, 300);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <section
        id="schedule"
        class="bg-gradient-to-b from-rose-50/20 via-white to-rose-50/20 py-20"
    >
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="mb-16 text-center">
                <div class="mb-6 inline-block">
                    <div class="flex items-center space-x-3">
                        <div
                            class="h-px w-12 bg-gradient-to-r from-transparent to-rose-300"
                        ></div>
                        <svg
                            class="animate-pulse-slow h-6 w-6 text-rose-400"
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
                    class="mb-4 font-secondary text-4xl font-light text-gray-800 sm:text-5xl md:text-6xl"
                >
                    Our Wedding Day
                </h2>
                <p
                    class="mx-auto max-w-2xl text-lg font-light text-gray-600 md:text-xl"
                >
                    A timeline of love, laughter, and happily ever after
                </p>
            </div>

            <!-- Timeline Container -->
            <div class="timeline-container mx-auto max-w-4xl">
                <div class="relative">
                    <!-- Vertical Line -->
                    <div
                        class="absolute left-1/2 hidden h-full w-0.5 -translate-x-1/2 transform bg-rose-200 md:block"
                    >
                        <!-- Animated progress line -->
                        <div
                            class="absolute top-0 left-0 w-full bg-gradient-to-b from-rose-400 to-amber-400 transition-all duration-300 ease-out"
                            :style="{ height: `${timelineProgress}%` }"
                        ></div>
                    </div>

                    <!-- Timeline Events -->
                    <div class="space-y-12 md:space-y-16">
                        <div
                            v-for="(event, index) in timelineEvents"
                            :key="index"
                            class="timeline-event relative flex items-center"
                            :class="
                                index % 2 === 0
                                    ? 'justify-start'
                                    : 'justify-end'
                            "
                        >
                            <!-- Timeline Dot -->
                            <div
                                class="absolute left-1/2 z-10 hidden h-6 w-6 -translate-x-1/2 transform items-center justify-center rounded-full border-4 border-white bg-gradient-to-br from-rose-400 to-amber-400 shadow-lg md:flex"
                            >
                                <!-- Pulsing ring -->
                                <div
                                    class="absolute inset-0 animate-ping rounded-full bg-rose-400 opacity-20"
                                ></div>
                            </div>

                            <!-- Mobile timeline dot -->
                            <div
                                class="absolute top-6 left-8 z-10 h-4 w-4 rounded-full border-4 border-white bg-rose-400 shadow-lg md:hidden"
                            ></div>
                            <div
                                class="absolute top-6 bottom-0 left-[2.4rem] w-0.5 bg-rose-200 md:hidden"
                            ></div>

                            <!-- Event Card -->
                            <div
                                class="w-full md:w-5/12"
                                :class="
                                    index % 2 === 0
                                        ? 'pr-8 md:text-right'
                                        : 'pl-8 md:text-left'
                                "
                            >
                                <div
                                    class="group relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl md:p-8"
                                    :class="[
                                        event.visible
                                            ? 'translate-y-0 opacity-100'
                                            : 'translate-y-8 opacity-0',
                                    ]"
                                >
                                    <!-- Decorative gradient overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                                    ></div>

                                    <div class="relative z-10">
                                        <div
                                            class="mb-3 font-playfair text-2xl font-light text-rose-500 transition-colors duration-300 group-hover:text-rose-600 md:text-3xl"
                                        >
                                            {{ event.time }}
                                        </div>
                                        <h3
                                            class="mb-3 font-secondary text-2xl font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 md:text-3xl"
                                        >
                                            {{ event.title }}
                                        </h3>
                                        <p
                                            class="text-base leading-relaxed font-light text-gray-600 md:text-lg"
                                        >
                                            {{ event.description }}
                                        </p>
                                    </div>

                                    <!-- Decorative corner -->
                                    <div
                                        class="absolute top-0 right-0 h-16 w-16 opacity-5"
                                        :class="
                                            index % 2 === 0
                                                ? 'left-0'
                                                : 'right-0'
                                        "
                                    >
                                        <svg
                                            viewBox="0 0 100 100"
                                            class="text-rose-400"
                                        >
                                            <path
                                                d="M0,0 L100,0 L100,100 Z"
                                                fill="currentColor"
                                            />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative Elements -->
            <div class="mt-16 text-center">
                <div class="inline-flex items-center space-x-4">
                    <div class="h-px w-16 bg-rose-300"></div>
                    <div class="text-rose-400">
                        <svg
                            class="animate-pulse-slow h-8 w-8"
                            fill="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                            />
                        </svg>
                    </div>
                    <div class="h-px w-16 bg-rose-300"></div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
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

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

/* Staggered animation delays for events */
.timeline-event:nth-child(1) .bg-white {
    transition-delay: 0.1s;
}
.timeline-event:nth-child(2) .bg-white {
    transition-delay: 0.2s;
}
.timeline-event:nth-child(3) .bg-white {
    transition-delay: 0.3s;
}
.timeline-event:nth-child(4) .bg-white {
    transition-delay: 0.4s;
}
.timeline-event:nth-child(5) .bg-white {
    transition-delay: 0.5s;
}
.timeline-event:nth-child(6) .bg-white {
    transition-delay: 0.6s;
}
.timeline-event:nth-child(7) .bg-white {
    transition-delay: 0.7s;
}

@media (max-width: 768px) {
    .relative.flex {
        justify-content: flex-start !important;
    }

    .w-5\/12 {
        width: 100%;
        padding-left: 2rem !important;
        padding-right: 0 !important;
        text-align: left !important;
    }
}
</style>
