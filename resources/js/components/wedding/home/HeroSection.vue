<script setup lang="ts">
import OptimizedImage from '@/components/OptimizedImage.vue';
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
    <section id="home">
        <div class="relative h-[60vh] overflow-hidden md:h-screen">
            <div
                ref="heroImage"
                class="absolute inset-0 h-full w-full will-change-transform"
            >
                <OptimizedImage
                    src="/images/hero.webp"
                    alt="Dannica & James"
                    class="h-full w-full object-cover object-right md:object-center"
                    loading="eager"
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
                    <div class="mx-auto mb-8 max-w-2xl md:mx-0 md:text-lg">
                        <p
                            class="text-normalleading-relaxed font-light text-white/90 italic"
                        >
                            Love is patient, love is kind. It does not envy, it
                            does not boast, it is not proud. It does not
                            dishonor others, it is not self-seeking, it is not
                            easily angered, it keeps no record of wrongs. Love
                            does not delight in evil but rejoices with the
                            truth. It always protects, always trusts, always
                            hopes, always perseveres. Love never fails.
                        </p>
                        <div class="flex w-full justify-end text-white">
                            <p class="text-sm">~ 1 Corinthians 13:4-7</p>
                        </div>
                    </div>
                    <div class="mt-6 text-center md:text-left">
                        <a
                            href="/rsvp"
                            class="btn-wedding-accent group wedding-touch-target-lg animate-fade-in-up inline-flex w-fit items-center"
                        >
                            RSVP Now
                            <svg
                                class="ml-2 h-5 w-5 transition-transform duration-300 group-hover:translate-x-1"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"
                                ></path>
                            </svg>
                        </a>
                    </div>
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
