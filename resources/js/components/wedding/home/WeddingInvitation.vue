<script lang="ts" setup>
import OptimizedImage from '@/components/OptimizedImage.vue';
import CountdownTimer from './CountdownTimer.vue';

interface Props {
    weddingDate: Date;
}

const props = defineProps<Props>();
</script>

<template>
    <section class="bg-[#ebddd7]">
        <div class="flex items-center space-x-20 py-20 pr-10 pl-20">
            <div class="fadeIn w-6/12">
                <div class="aspect-[558/714] overflow-hidden rounded-3xl">
                    <OptimizedImage
                        src="/images/dannica-james/DSC09891_14_11zon.webp"
                        alt=""
                        class="h-full w-full object-cover"
                        loading="lazy"
                    />
                </div>
            </div>
            <div class="w-6/12 text-center text-[#4c0211]">
                <p class="animateUp text-center text-3xl">
                    YOU'RE INVITED TO THE WEDDING OF
                </p>
                <div class="mb-10">
                    <p
                        class="font-wedding-heading animateUp text-[10rem] leading-[1]"
                    >
                        James &
                    </p>
                    <p
                        class="font-wedding-heading animateUp text-[10rem] leading-[1]"
                    >
                        Dannica
                    </p>
                </div>
                <p class="animateUp mb-10 text-3xl uppercase">
                    Saturday, <strong>December 12, 2025</strong>
                </p>
                <CountdownTimer class="animateUp" :target-date="weddingDate" />
            </div>
        </div>
    </section>
</template>
