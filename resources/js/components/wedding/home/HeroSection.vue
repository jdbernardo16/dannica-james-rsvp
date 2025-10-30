<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';

const heroImage = ref<HTMLElement | null>(null);
const scrollY = ref(0);

const handleScroll = () => {
    scrollY.value = window.scrollY;
    if (heroImage.value) {
        heroImage.value.style.transform = `translateY(${
            scrollY.value * 0.5
        }px) scale(1.1)`;
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>
<template>
    <section>
        <div class="relative h-[60vh] overflow-hidden md:h-screen">
            <div
                ref="heroImage"
                class="absolute inset-0 h-full w-full will-change-transform"
            >
                <img
                    class="h-full w-full object-cover object-right md:object-center"
                    src="/images/DSC09755.JPG"
                    alt="Dannica & James"
                />
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-amber-900/80 via-amber-900/40 to-transparent"
            ></div>
            <div
                class="absolute top-1/2 right-0 left-0 max-w-4xl -translate-y-1/2 px-8 md:right-auto md:left-20 md:px-0"
            >
                <div class="text-center md:text-left">
                    <h1
                        class="animate-fade-in-up mb-6 font-secondary text-5xl font-light tracking-wide text-white md:text-8xl"
                    >
                        <span
                            class="inline-block transform transition-transform duration-300 hover:scale-105"
                        >
                            James
                        </span>
                        <span
                            class="mx-2 inline-block animate-pulse font-normal text-rose-200 md:mx-3"
                        >
                            &
                        </span>
                        <span
                            class="inline-block transform transition-transform duration-300 hover:scale-105"
                        >
                            Dannica
                        </span>
                    </h1>
                    <p
                        class="text-normal mx-auto mb-8 max-w-2xl leading-relaxed font-light text-white/90 md:mx-0 md:text-lg"
                    >
                        Two hearts, one beautiful journey. Join us as we
                        celebrate the beginning of our forever together,
                        surrounded by the love and laughter of those who mean
                        the most.
                    </p>
                </div>
            </div>
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2">
                <div class="animate-bounce">
                    <svg
                        class="h-6 w-6 text-white/70"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3"
                        ></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>
</template>
