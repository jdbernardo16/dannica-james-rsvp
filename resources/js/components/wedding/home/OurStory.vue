<script lang="ts" setup>
import { onMounted, ref } from 'vue';

const milestones = ref([
    {
        id: 1,
        title: 'First Met',
        date: 'January 15, 2019',
        story: 'Two strangers crossed paths at a coffee shop, unaware that a beautiful journey was about to begin.',
        icon: 'heart',
        visible: false,
    },
    {
        id: 2,
        title: 'Became a Couple',
        date: 'September 08, 2020',
        story: 'After months of laughter, deep conversations, and stolen glances, we officially became one.',
        icon: 'heart',
        visible: false,
    },
    {
        id: 3,
        title: 'The Proposal',
        date: 'March 22, 2024',
        story: 'Under a starlit sky, with trembling hands and a full heart, the question was asked. She said yes!',
        icon: 'ring',
        visible: false,
    },
    {
        id: 4,
        title: 'The Wedding',
        date: 'December 15, 2025',
        story: "The day we've been dreaming of - where two become one, surrounded by love and cherished memories.",
        icon: 'toast',
        visible: false,
    },
]);

const handleScroll = () => {
    const elements = document.querySelectorAll('.story-card');
    const windowHeight = window.innerHeight;

    elements.forEach((el, index) => {
        const rect = el.getBoundingClientRect();
        const elementMiddle = rect.top + rect.height / 2;

        if (
            elementMiddle < windowHeight * 0.8 &&
            elementMiddle > 0 &&
            milestones.value[index]
        ) {
            milestones.value[index].visible = true;
        }
    });
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Initial check

    // Trigger first milestone after mount
    setTimeout(() => {
        if (milestones.value[0]) {
            milestones.value[0].visible = true;
        }
    }, 300);
});
</script>

<template>
    <section
        id="story"
        class="relative overflow-hidden bg-gradient-to-b from-rose-50/30 via-white to-rose-50/30 py-16 md:py-24"
    >
        <!-- Background decorative elements -->
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute top-40 right-10 h-40 w-40 opacity-5">
                <svg
                    viewBox="0 0 100 100"
                    class="animate-spin-slow text-rose-400"
                >
                    <circle cx="50" cy="50" r="2" fill="currentColor">
                        <animate
                            attributeName="r"
                            values="2;40;2"
                            dur="4s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="1;0.3;1"
                            dur="4s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
            <div class="absolute bottom-40 left-10 h-32 w-32 opacity-5">
                <svg
                    viewBox="0 0 100 100"
                    class="animate-spin-slow-reverse text-amber-400"
                >
                    <circle cx="50" cy="50" r="2" fill="currentColor">
                        <animate
                            attributeName="r"
                            values="2;35;2"
                            dur="5s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="1;0.2;1"
                            dur="5s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
        </div>

        <div class="mx-auto max-w-[1440px] px-4 sm:px-8 md:px-12 lg:px-20">
            <!-- Header Section with Image -->
            <div
                class="mb-20 flex flex-col md:mb-28 lg:flex-row lg:items-center lg:space-x-16 xl:space-x-24"
            >
                <!-- Image Section -->
                <div
                    class="relative mb-12 flex w-full justify-center lg:mb-0 lg:w-5/12 lg:justify-start"
                >
                    <div
                        class="hover:shadow-3xl relative z-[1] max-w-md rounded-t-full bg-gradient-to-br from-amber-100 to-rose-100 p-4 shadow-2xl transition-all duration-500 hover:scale-105 sm:p-5"
                    >
                        <div class="w-full overflow-hidden rounded-t-full">
                            <img
                                class="w-full transform transition-transform duration-700 hover:scale-110"
                                src="/images/img3.png"
                                alt="couple"
                            />
                        </div>
                    </div>
                    <div
                        class="absolute top-0 -right-[100px] z-0 w-[200px] rotate-45 opacity-60 sm:-right-[125px] sm:w-[250px] lg:-right-[150px] lg:w-[300px]"
                    >
                        <img src="/images/decor1.png" alt="decor" />
                    </div>
                </div>

                <!-- Title Section -->
                <div class="w-full text-center lg:w-7/12 lg:text-left">
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
                        class="mb-6 font-secondary text-4xl leading-tight text-gray-800 sm:text-5xl md:text-6xl lg:text-7xl"
                    >
                        A Love Story
                    </h2>
                    <p
                        class="mx-auto max-w-2xl text-lg leading-relaxed font-light text-gray-600 md:text-xl lg:mx-0"
                    >
                        Every great love story has a beginning. Here's ours - a
                        journey of laughter, growth, and endless moments that
                        led us to forever.
                    </p>
                </div>
            </div>

            <!-- Story Cards Section -->
            <div class="mx-auto max-w-6xl">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <div
                        v-for="(milestone, index) in milestones"
                        :key="milestone.id"
                        class="story-card"
                        :class="[
                            milestone.visible
                                ? 'translate-y-0 scale-100 opacity-100'
                                : 'translate-y-12 scale-95 opacity-0',
                            index % 2 === 0 ? 'lg:-mt-12' : 'lg:mt-12',
                        ]"
                    >
                        <div
                            class="group relative h-fit overflow-hidden rounded-2xl border border-rose-100 bg-white p-8 shadow-lg transition-all duration-700 ease-out hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <!-- Icon -->
                            <div
                                class="absolute -top-4 -right-4 h-20 w-20 rotate-12 transform opacity-10 transition-transform duration-500 group-hover:rotate-45"
                            >
                                <img
                                    :src="`/images/${milestone.icon}.png`"
                                    :alt="milestone.icon"
                                    class="h-full w-full object-contain"
                                />
                            </div>

                            <div class="relative z-10">
                                <!-- Icon and Title Row -->
                                <div class="mb-6 flex items-center">
                                    <div
                                        class="mr-4 flex h-16 w-16 transform items-center justify-center rounded-full bg-gradient-to-br from-rose-400 to-amber-400 shadow-lg transition-transform duration-300 group-hover:scale-110"
                                    >
                                        <img
                                            :src="`/images/${milestone.icon}.png`"
                                            :alt="milestone.icon"
                                            class="h-8 w-8 object-contain"
                                        />
                                    </div>
                                    <div>
                                        <h3
                                            class="mb-1 font-playfair text-2xl text-gray-800 transition-colors duration-300 group-hover:text-rose-600 md:text-3xl"
                                        >
                                            {{ milestone.title }}
                                        </h3>
                                        <p
                                            class="text-sm font-medium tracking-widest text-rose-500 uppercase"
                                        >
                                            {{ milestone.date }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Story Content -->
                                <p
                                    class="text-lg leading-relaxed font-light text-gray-600"
                                >
                                    {{ milestone.story }}
                                </p>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute bottom-0 left-0 h-20 w-20 opacity-5"
                            >
                                <svg
                                    viewBox="0 0 100 100"
                                    class="text-rose-400"
                                >
                                    <path
                                        d="M0,100 L100,100 L0,0 Z"
                                        fill="currentColor"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom decorative element -->
            <div class="mt-20 text-center">
                <div class="inline-flex items-center space-x-4">
                    <div
                        class="h-px w-24 bg-gradient-to-r from-transparent via-rose-300 to-transparent"
                    ></div>
                    <p class="font-light text-gray-500 italic">
                        And the adventure continues...
                    </p>
                    <div
                        class="h-px w-24 bg-gradient-to-l from-transparent via-rose-300 to-transparent"
                    ></div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
@keyframes spin-slow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

@keyframes spin-slow-reverse {
    from {
        transform: rotate(360deg);
    }
    to {
        transform: rotate(0deg);
    }
}

@keyframes spin-very-slow {
    from {
        transform: rotate(45deg);
    }
    to {
        transform: rotate(405deg);
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

.animate-spin-slow {
    animation: spin-slow 20s linear infinite;
}

.animate-spin-slow-reverse {
    animation: spin-slow-reverse 25s linear infinite;
}

.animate-spin-very-slow {
    animation: spin-very-slow 60s linear infinite;
}

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

/* Custom shadow */
.shadow-3xl {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

/* Enhanced smooth animations for cards */
.story-card {
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transform-origin: center bottom;
}

.story-card:nth-child(1) {
    transition-delay: 0ms;
}

.story-card:nth-child(2) {
    transition-delay: 150ms;
}

.story-card:nth-child(3) {
    transition-delay: 300ms;
}

.story-card:nth-child(4) {
    transition-delay: 450ms;
}

/* Add subtle entrance animation for card content */
.story-card .group {
    transition: all 0.6s ease-out;
}

.story-card:not(.visible) .group {
    transform: translateY(20px);
    opacity: 0.8;
}

.story-card.visible .group {
    transform: translateY(0);
    opacity: 1;
}

/* Enhanced hover effects */
.story-card:hover {
    transform: translateY(-8px) scale(1.02);
    z-index: 10;
}

.story-card:hover .group {
    transform: translateY(-4px);
}
</style>
