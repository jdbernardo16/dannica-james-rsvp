<script lang="ts" setup>
import ImageGallery from '@/components/ImageGallery.vue';
import NonResponsiveWrapper from '@/components/NonResponsiveWrapper.vue';
import OptimizedImage from '@/components/OptimizedImage.vue';
import WeddingInvitation from '@/components/wedding/home/WeddingInvitation.vue';
import { Head } from '@inertiajs/vue3';
import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { Bell, Car, Gift, Heart } from 'lucide-vue-next';

import 'swiper/css';
import 'swiper/css/pagination';
import { Autoplay, Pagination } from 'swiper/modules';
import { Swiper, SwiperSlide } from 'swiper/vue';
import { onMounted, ref } from 'vue';

gsap.registerPlugin(ScrollTrigger);

// Set the wedding date for December 12, 2025
const weddingDate = new Date('2025-12-12T00:00:00');

// Slider images data
const sliderImages = ref([
    {
        src: '/images/dannica-james/DSC09865_11_11zon.webp',
        alt: 'Wedding hero image',
    },
    {
        src: '/images/dannica-james/DSC07844_23_11zon.webp',
        alt: 'Wedding hero image',
    },
    {
        src: '/images/dannica-james/DSC07809_20_11zon.webp',
        alt: 'Wedding hero image',
    },
    {
        src: '/images/dannica-james/DSC09841_10_11zon.webp',
        alt: 'Wedding hero image',
    },
    {
        src: '/images/dannica-james/DSC09755_6_11zon.webp',
        alt: 'Wedding hero image',
    },
    {
        src: '/images/dannica-james/DSC09881_13_11zon.webp',
        alt: 'Wedding hero image',
    },
    {
        src: '/images/dannica-james/DSC07766_16_11zon.webp',
        alt: 'Wedding hero image',
    },
]);

// Gallery images data
const galleryImages = ref([
    {
        src: '/images/dannica-james/DSC09739_4_11zon.webp',
        alt: 'Wedding frame image',
    },
    {
        src: '/images/dannica-james/DSC09644_30_11zon.webp',
        alt: 'Wedding frame image',
    },
    {
        src: '/images/wed1.jpg',
        alt: 'Wedding frame image',
    },
    {
        src: '/images/wed2.jpg',
        alt: 'Wedding frame image',
    },
    {
        src: '/images/wed3.jpg',
        alt: 'Wedding frame image',
    },
    {
        src: '/images/wed4.jpg',
        alt: 'Wedding frame image',
    },
]);

// Swiper modules
const modules = [Pagination, Autoplay];

onMounted(() => {
    // fetchLayout();
    setTimeout(() => {
        const animateUp = gsap.utils.toArray('.animateUp');
        animateUp.forEach((grow) => {
            gsap.from(grow, {
                scrollTrigger: {
                    trigger: grow,
                    start: 'bottom 120%',
                },
                y: 20,
                opacity: 0,
                duration: 2,
                ease: 'Expo.easeOut',
            });
        });

        const showLeft = gsap.utils.toArray('.showLeft');
        showLeft.forEach((grow) => {
            gsap.from(grow, {
                scrollTrigger: {
                    trigger: grow,
                    start: 'bottom 120%',
                },
                x: -40,
                opacity: 0,
                duration: 2,
                ease: 'Expo.easeOut',
            });
        });

        const showRight = gsap.utils.toArray('.showRight');
        showRight.forEach((grow) => {
            gsap.from(grow, {
                scrollTrigger: {
                    trigger: grow,
                    start: 'bottom 120%',
                },
                x: 40,
                opacity: 0,
                duration: 2,
                ease: 'Expo.easeOut',
            });
        });

        const scaleUp = gsap.utils.toArray('.scaleUp');
        scaleUp.forEach((grow) => {
            gsap.from(grow, {
                scrollTrigger: {
                    trigger: grow,
                    start: 'bottom 120%',
                },
                scale: 0,
                opacity: 0,
                duration: 2,
                ease: 'Expo.easeOut',
            });
        });

        const fadeIn = gsap.utils.toArray('.fadeIn');
        fadeIn.forEach((grow) => {
            gsap.from(grow, {
                scrollTrigger: {
                    trigger: grow,
                    start: 'bottom 150%',
                },
                opacity: 0,
                duration: 2,
                ease: 'Expo.easeOut',
            });
        });
    }, 500);
});
</script>
<template>
    <Head title="James & Dannica">
        <!-- Primary Meta Tags -->
        <meta name="title" content="James & Dannica" />
        <meta
            name="description"
            content="Mark your calendars for our special day as we celebrate love and new beginnings. Two souls with but a single thought, two hearts that beat as one. Villaluz - Tejada Nuptial"
        />

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.jamesdannica.site/" />
        <meta property="og:title" content="James & Dannica" />
        <meta
            property="og:description"
            content="Mark your calendars for our special day as we celebrate love and new beginnings. Two souls with but a single thought, two hearts that beat as one. Villaluz - Tejada Nuptial"
        />
        <meta property="og:image" content="/images/meta-image.png" />

        <!-- X (Twitter) -->
        <meta property="twitter:card" content="summary_large_image" />
        <meta property="twitter:url" content="https://www.jamesdannica.site/" />
        <meta property="twitter:title" content="James & Dannica" />
        <meta
            property="twitter:description"
            content="Mark your calendars for our special day as we celebrate love and new beginnings. Two souls with but a single thought, two hearts that beat as one. Villaluz - Tejada Nuptial"
        />
        <meta property="twitter:image" content="/images/meta-image.png" />

        <!-- Meta Tags Generated with https://metatags.io -->
        <link rel="canonical" href="https://www.jamesdannica.site/" />
    </Head>
    <NonResponsiveWrapper>
        <section
            class="relative w-full overflow-hidden bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/f1-bg.png')"
        >
            <div
                class="grid h-full w-full place-items-center px-10 pt-32 pb-20"
            >
                <div class="relative m-auto mb-6 w-fit">
                    <div
                        class="absolute -top-16 left-1/2 w-[110%] -translate-x-1/2"
                    >
                        <OptimizedImage
                            src="/images/Paragraph.svg"
                            alt=""
                            class="w-full"
                            loading="lazy"
                        />
                    </div>
                    <p
                        class="font-wedding-heading showLeft absolute top-1/2 right-[105%] -translate-y-1/2 text-[7rem] text-white"
                    >
                        James
                    </p>
                    <div
                        class="animateUp aspect-[526/682] w-[526px] overflow-hidden rounded-t-full"
                    >
                        <OptimizedImage
                            src="/images/dannica-james/DSC07801_19_11zon.webp"
                            alt=""
                            class="h-full w-full object-cover"
                            loading="lazy"
                        />
                    </div>
                    <p
                        class="font-wedding-heading showRight absolute top-1/2 left-[105%] -translate-y-1/2 text-[6rem] text-white"
                    >
                        Dannica
                    </p>
                </div>
                <p
                    class="font-wedding-body animateUp text-center text-4xl tracking-widest text-white"
                >
                    DECEMBER 12, 2025
                </p>
            </div>
        </section>
        <WeddingInvitation :wedding-date="weddingDate" />
        <section
            class="relative w-full overflow-hidden bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/f1-bg.png')"
        >
            <div class="p-20 text-center text-white">
                <h1 class="font-wedding-accent animateUp text-[11rem]">
                    Our Love Story
                </h1>
                <div class="grid grid-cols-3 gap-x-10 gap-y-5">
                    <div class="animateUp">
                        <OptimizedImage
                            src="/images/hands.png"
                            alt=""
                            class="m-auto invert"
                            loading="lazy"
                        />
                    </div>
                    <div class="animateUp">
                        <OptimizedImage
                            src="/images/proposal.png"
                            alt=""
                            class="m-auto invert"
                            loading="lazy"
                        />
                    </div>
                    <div class="animateUp">
                        <OptimizedImage
                            src="/images/wedding1.png"
                            alt=""
                            class="m-auto invert"
                            loading="lazy"
                        />
                    </div>
                    <p class="animateUp font-playfair text-4xl">
                        April 18, 2013
                    </p>

                    <p class="animateUp font-playfair text-4xl">
                        November 23, 2024
                    </p>

                    <p class="animateUp font-playfair text-4xl">
                        December 12, 2025
                    </p>
                </div>
            </div>
        </section>
        <!-- <video-section /> -->
        <section class="bg-[#ebddd7]">
            <div class="p-20 text-[#4c0511]">
                <p
                    class="font-wedding-accent animateUp text-center text-[8rem] tracking-widest"
                >
                    Wedding Timeline
                </p>
                <div class="mb-10 grid grid-cols-3 gap-10">
                    <div
                        class="space-y-4 rounded-2xl bg-[#4c0511] p-6 text-center text-white"
                    >
                        <div class="animateUp mx-auto w-[51px]">
                            <OptimizedImage
                                src="/images/location.png"
                                alt="location"
                                class="w-full"
                                loading="lazy"
                            />
                        </div>
                        <p class="animateUp font-playfair text-7xl">2:30 PM</p>
                        <p class="animateUp font-playfair text-5xl">Arrival</p>
                    </div>
                    <div
                        class="space-y-4 rounded-2xl bg-[#4c0511] p-6 text-center text-white"
                    >
                        <div class="animateUp mx-auto w-[94px]">
                            <OptimizedImage
                                src="/images/ring.png"
                                alt="location"
                                class="w-full"
                                loading="lazy"
                            />
                        </div>
                        <p class="animateUp font-playfair text-7xl">3:00 PM</p>
                        <p class="animateUp font-playfair text-5xl">Ceremony</p>
                    </div>
                    <div
                        class="space-y-4 rounded-2xl bg-[#4c0511] p-6 text-center text-white"
                    >
                        <div class="animateUp mx-auto w-[68px]">
                            <OptimizedImage
                                src="/images/toast.png"
                                alt="location"
                                class="w-full"
                                loading="lazy"
                            />
                        </div>
                        <p class="animateUp font-playfair text-7xl">5:30 PM</p>
                        <p class="animateUp font-playfair text-5xl">
                            Reception
                        </p>
                    </div>
                </div>
                <div class="mb-10 flex items-center justify-between space-x-10">
                    <div class="w-1/2 space-y-6">
                        <p
                            class="animateUp text-center font-playfair text-6xl tracking-widest text-[#4c0511] uppercase"
                        >
                            Ceremony
                        </p>
                        <div
                            class="animateUp mx-auto aspect-[490/580] w-full rounded-3xl border-2 border-[#4c0511] p-5"
                        >
                            <OptimizedImage
                                src="/images/sanagustin.jpg"
                                alt="image"
                                class="h-full w-full rounded-2xl object-cover"
                                loading="lazy"
                            />
                        </div>
                        <p class="animateUp text-center font-playfair text-5xl">
                            San Agustin Church
                        </p>
                        <div class="animateUp m-auto w-fit">
                            <a
                                href="https://maps.app.goo.gl/z6BhRGKf3jQjPQBX6"
                                target="_blank"
                                class="w-fit"
                            >
                                <div
                                    class="mx-auto w-fit cursor-pointer rounded-full bg-[#4c0511] px-20 py-10 text-4xl font-bold text-white"
                                >
                                    View Map
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="w-1/2 space-y-6">
                        <p
                            class="animateUp text-center font-playfair text-6xl tracking-widest text-[#4c0511] uppercase"
                        >
                            Reception
                        </p>
                        <div
                            class="animateUp mx-auto aspect-[490/580] w-full rounded-3xl border-2 border-[#4c0511] p-5"
                        >
                            <OptimizedImage
                                src="/images/lacastellana.jpg"
                                alt="image"
                                class="h-full w-full rounded-2xl object-cover"
                                loading="lazy"
                            />
                        </div>
                        <p class="animateUp text-center font-playfair text-5xl">
                            La Castellana
                        </p>
                        <div class="animateUp m-auto w-fit">
                            <a
                                href="https://maps.app.goo.gl/2amhumtYKS1NZNwH8"
                                target="_blank"
                                class="w-fit"
                            >
                                <div
                                    class="mx-auto w-fit cursor-pointer rounded-full bg-[#4c0511] px-20 py-10 text-4xl font-bold text-white"
                                >
                                    View Map
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="relative">
                <Swiper
                    :modules="modules"
                    :pagination="{
                        clickable: true,
                        bulletClass:
                            'swiper-pagination-bullet !bg-white !opacity-70',
                        bulletActiveClass:
                            'swiper-pagination-bullet-active !bg-white !opacity-100',
                    }"
                    :autoplay="{
                        delay: 5000,
                        disableOnInteraction: false,
                    }"
                    :loop="true"
                    class="aspect-[1392/636] w-full"
                >
                    <SwiperSlide
                        v-for="(image, index) in sliderImages"
                        :key="index"
                    >
                        <div class="aspect-[1392/636] w-full">
                            <OptimizedImage
                                :src="image.src"
                                :alt="image.alt"
                                class="h-full w-full object-cover"
                                loading="lazy"
                            />
                        </div>
                    </SwiperSlide>
                </Swiper>
            </div>
        </section>
        <section
            class="relative min-h-screen w-full overflow-hidden bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/f1-bg.png')"
        >
            <div class="px-10 py-20 text-white">
                <div>
                    <p
                        class="font-wedding-accent animateUp text-center text-[8rem] tracking-widest"
                    >
                        Villaluz - Tejada Nuptial
                    </p>
                    <p
                        class="font-wedding-accent animateUp text-center text-[8rem] tracking-widest"
                    >
                        The Entourage
                    </p>
                </div>

                <!-- Parents -->
                <div class="mb-20 grid grid-cols-2 gap-20">
                    <div class="space-y-4 text-right font-primary">
                        <p class="animateUp text-3xl font-bold uppercase">
                            Parents of the Groom
                        </p>
                        <div class="space-y-3">
                            <p class="animateUp text-4xl">
                                Mr. Jesus R. Villaluz
                            </p>
                            <p class="animateUp text-4xl">
                                Mrs. Imelda D. Villaluz
                            </p>
                        </div>
                    </div>
                    <div class="space-y-4 font-primary">
                        <p class="animateUp text-3xl font-bold uppercase">
                            Parents of the Bride
                        </p>
                        <div class="space-y-3">
                            <p class="animateUp text-4xl">
                                Mr. Danilo R. Tejada
                            </p>
                            <p class="animateUp text-4xl">
                                Mrs. Elona L. Tejada
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Principal Sponsors -->
                <div class="mb-16">
                    <p
                        class="font-wedding-accent animateUp mb-10 text-center text-[5rem] tracking-widest"
                    >
                        Principal Sponsors
                    </p>
                    <div class="grid grid-cols-2 gap-x-20 gap-y-4 text-4xl">
                        <p class="animateUp text-right">Mr. Teddy R. Vinzon</p>
                        <p class="animateUp">Mrs. Carmela C. Vinzon</p>
                        <p class="animateUp text-right">Mr. Erick J. Santos</p>
                        <p class="animateUp">Mrs. Jasmin D. Sarmiento</p>
                        <p class="animateUp text-right">
                            Mr. Salvador R. Tejada Jr.
                        </p>
                        <p class="animateUp">Mrs. Consuelo B. Bernardo</p>
                        <p class="animateUp text-right">
                            Mr. Danilo C. Teofilo
                        </p>
                        <p class="animateUp">Mrs. Ma. Leticia D. Teofilo</p>
                        <p class="animateUp text-right">Mr. Enrico Simon</p>
                        <p class="animateUp">Mrs. Elisa G. Simon</p>
                        <p class="animateUp text-right">Mr. Cristino Cuanang</p>
                        <p class="animateUp">Mrs. May Quimba</p>
                        <p class="animateUp text-right">Mr. Remilo Eguico</p>
                        <p class="animateUp">Mrs. Eway V. Castillo</p>
                        <p class="animateUp text-right">Mr. Michael Dingco</p>
                        <p class="animateUp">Mrs. Analyn P. Navarro</p>
                        <p class="animateUp text-right">Mr. Aries Torreleiza</p>
                        <p class="animateUp">Mrs. Cristina Torreleiza</p>
                        <p class="animateUp text-right">
                            Chief Engr. Jaime Roncales
                        </p>
                        <p class="animateUp">Mrs. Angelina Lamis</p>
                    </div>
                </div>

                <!-- Secondary Sponsors -->
                <div class="mb-16">
                    <div class="mb-16 grid grid-cols-2 gap-x-20">
                        <div>
                            <p
                                class="font-wedding-accent animateUp mb-4 text-right text-[3rem] tracking-widest"
                            >
                                Best Man
                            </p>
                            <div class="space-y-4 text-right text-4xl">
                                <p class="animateUp">
                                    Jemuel Christian D. Villaluz
                                </p>
                            </div>
                        </div>
                        <div>
                            <p
                                class="font-wedding-accent animateUp mb-4 text-left text-[3rem] tracking-widest"
                            >
                                Matron of Honor
                            </p>
                            <div class="space-y-4 text-4xl">
                                <p class="animateUp">
                                    Ona Elledan Tejada-Bernardo
                                </p>
                            </div>
                        </div>
                    </div>
                    <p
                        class="font-wedding-accent animateUp mb-10 text-center text-[6rem] tracking-widest"
                    >
                        Secondary Sponsors
                    </p>
                    <!-- Groomsmen and Bridesmaids -->
                    <div class="mb-16">
                        <div class="grid grid-cols-2 gap-20">
                            <div>
                                <p
                                    class="font-wedding-accent animateUp mb-10 text-right text-[4rem] tracking-widest"
                                >
                                    Groomsmen
                                </p>
                                <div class="space-y-4 text-right text-4xl">
                                    <p class="animateUp mt-4">
                                        Jerico N. Villaluz
                                    </p>
                                    <p class="animateUp mt-4">
                                        Brian Paolo Rañeses
                                    </p>
                                </div>
                            </div>
                            <div>
                                <p
                                    class="font-wedding-accent animateUp mb-10 text-[4rem] tracking-widest"
                                >
                                    Bridesmaids
                                </p>
                                <div class="space-y-4 text-4xl">
                                    <p class="animateUp mt-4">
                                        Ericka Jayne D. Santos
                                    </p>
                                    <p class="animateUp mt-4">
                                        Eisha Eurice F. Valencia
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p
                        class="font-wedding-accent animateUp mb-6 text-center text-[3rem] tracking-widest"
                    >
                        <span class="text-[4rem]">T</span>o
                        <span class="text-[4rem]">L</span>ight
                        <span class="text-[4rem]">O</span>ur
                        <span class="text-[4rem]">P</span>ath
                    </p>
                    <div
                        class="mb-6 grid grid-cols-2 gap-x-20 gap-y-4 text-4xl"
                    >
                        <p class="animateUp text-right">
                            Einar Jedrek D. Santos
                        </p>
                        <p class="animateUp">Marion Joyce D. Sarmiento</p>
                    </div>
                    <p
                        class="font-wedding-accent animateUp mb-6 text-center text-[3rem] tracking-widest"
                    >
                        <span class="text-[4rem]">T</span>o
                        <span class="text-[4rem]">C</span>lothe
                        <span class="text-[4rem]">U</span>s
                        <span class="text-[4rem]">A</span>s
                        <span class="text-[4rem]">O</span>ne
                    </p>
                    <div
                        class="mb-6 grid grid-cols-2 gap-x-20 gap-y-4 text-4xl"
                    >
                        <p class="animateUp text-right">Jesi Valencia</p>
                        <p class="animateUp">Mary Claire Vinzon-Geronimo</p>
                    </div>
                    <p
                        class="font-wedding-accent animateUp mb-6 text-center text-[3rem] tracking-widest"
                    >
                        <span class="text-[4rem]">T</span>o
                        <span class="text-[4rem]">B</span>ind
                        <span class="text-[4rem]">U</span>s
                        <span class="text-[4rem]">T</span>ogether
                    </p>
                    <div
                        class="mb-6 grid grid-cols-2 gap-x-20 gap-y-4 text-4xl"
                    >
                        <p class="animateUp text-right">
                            John Dennis B. Bernardo
                        </p>
                        <p class="animateUp">Jona Jane T. Gran</p>
                    </div>
                </div>

                <!-- Bearers and Flower Girls -->
                <div>
                    <div class="mb-10 grid grid-cols-2 gap-10 text-center">
                        <div>
                            <p
                                class="font-wedding-accent animateUp mb-6 text-[3rem] tracking-widest"
                            >
                                Coin Bearer
                            </p>
                            <p class="animateUp text-4xl">
                                Emmanuel D. Aguilar
                            </p>
                        </div>
                        <div>
                            <p
                                class="font-wedding-accent animateUp mb-6 text-[3rem] tracking-widest"
                            >
                                Bible Bearer
                            </p>
                            <p class="animateUp text-4xl">
                                Kyle Dame F. Villaspin
                            </p>
                        </div>
                    </div>
                    <div class="text-center">
                        <p
                            class="font-wedding-accent animateUp mb-6 text-[3rem] tracking-widest"
                        >
                            Ring Bearer
                        </p>
                        <p class="animateUp text-4xl">
                            Zeke Nikolai S. Sarmiento
                        </p>
                    </div>

                    <div class="mt-16">
                        <p
                            class="font-wedding-accent animateUp mb-10 text-center text-[4rem] tracking-widest"
                        >
                            Flower Ladies
                        </p>
                        <div
                            class="mb-10 grid grid-cols-2 gap-x-10 gap-y-4 text-4xl"
                        >
                            <p class="animateUp text-right">
                                Elliyah Jhay D. Santos
                            </p>
                            <p class="animateUp">Eiryn Jessy D. Santos</p>
                        </div>
                        <p class="animateUp text-center text-4xl">
                            Meiryne Joie D. Sarmiento
                        </p>
                    </div>
                    <div class="mt-16">
                        <p
                            class="font-wedding-accent animateUp mb-10 text-center text-[4rem] tracking-widest"
                        >
                            Little Bride
                        </p>
                        <div class="text-center text-4xl">
                            <p class="animateUp">Julia Dennise T. Bernardo</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <ImageGallery
            :images="galleryImages"
            background-color="bg-[#e6cabf]"
            padding="p-20"
        />
        <section class="bg-[#ebddd7]">
            <div class="m-auto max-w-[1000px] p-20 text-center text-[#4c0211]">
                <p class="font-wedding-accent animateUp text-[9rem]">
                    Dress Motif
                </p>
                <p
                    class="animateUp mb-10 text-justify font-playfair text-3xl leading-[1.5] uppercase"
                >
                    As the <strong>bride will only be the one in white</strong>,
                    we encourage you to dress according to our wedding color
                </p>
                <p class="font-wedding-accent animateUp text-[5rem]">
                    Principal Sponsors
                </p>
                <p
                    class="animateUp mb-4 text-center font-playfair text-3xl uppercase"
                >
                    Ninong and Ninang
                </p>
                <div class="animateUp m-auto w-[400px]">
                    <OptimizedImage
                        src="/images/color-pallete.png"
                        alt=""
                        class=""
                        loading="lazy"
                    />
                </div>
                <div
                    class="animateUp m-auto mb-16 flex w-fit -translate-x-7 items-center justify-between space-x-24 text-2xl"
                >
                    <p>Champagne</p>
                    <p>Gold</p>
                </div>

                <p class="font-wedding-accent animateUp mb-10 text-[5rem]">
                    Dress Code
                </p>
                <div class="mb- mb-10 flex items-center space-x-6">
                    <div class="animateUp w-1/2">
                        <OptimizedImage
                            src="/images/barong1.png"
                            alt=""
                            class="mx-auto h-[50vh]"
                            loading="lazy"
                        />
                        <p class="animateUp text-3xl">Gentlemen</p>
                        <p class="animateUp text-xl">Barong and Black pants</p>
                    </div>
                    <div class="animateUp w-1/2">
                        <OptimizedImage
                            src="/images/dress1.png"
                            alt=""
                            class="mx-auto h-[50vh]"
                            loading="lazy"
                        />
                        <p class="animateUp text-3xl">Ladies</p>
                        <p class="animateUp text-xl">
                            Filipiniana or Butterfly dress
                        </p>
                    </div>
                </div>

                <p class="font-wedding-accent animateUp mb-4 text-[5rem]">
                    Guest
                </p>
                <p
                    class="animateUp mb-10 text-center font-playfair text-3xl uppercase"
                >
                    Formal/Semi Formal
                </p>
                <div class="rounded-5 animateUp mb-16 grid grid-cols-4 gap-10">
                    <div>
                        <div
                            class="mb-4 aspect-square rounded-full border-2 border-[#4c0211] bg-[#f6d7d7]"
                        ></div>
                        <p class="text-2xl">Dusty Rose</p>
                    </div>
                    <div>
                        <div
                            class="mb-4 aspect-square rounded-full border-2 border-[#4c0211] bg-[#e8b7b0]"
                        ></div>
                        <p class="text-2xl">Coral</p>
                    </div>
                    <div>
                        <div
                            class="mb-4 aspect-square rounded-full border-2 border-[#4c0211] bg-[#d89a92]"
                        ></div>
                        <p class="text-2xl">Terracotta</p>
                    </div>
                    <div>
                        <div
                            class="mb-4 aspect-square rounded-full border-2 border-[#4c0211] bg-[#c77a6f]"
                        ></div>
                        <p class="text-2xl">Burnt Sienna</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-[#ebddd7]">
            <div class="p-20 pt-0">
                <div class="animateUp grid grid-cols-3 gap-10">
                    <div
                        class="col-span-1 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <Gift class="m-auto mb-5 h-20 w-20" />
                        <p class="uppercase">Gift Note</p>
                    </div>
                    <div
                        class="col-span-2 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <p>
                            With all that we have, we've been truly blessed.
                            Your presence and prayers are all that we request.
                            But if you desire to give nonetheless, Monetary gift
                            is one we suggest.
                        </p>
                    </div>
                    <div
                        class="col-span-1 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <Bell class="m-auto mb-5 h-20 w-20" />
                        <p class="uppercase">RSVP<br />REMINDERS</p>
                    </div>
                    <div
                        class="col-span-2 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <p class="font-bold tracking-widest uppercase">
                            ADULTS ONLY
                        </p>
                        <p>
                            To allow all guests an evening of fun and
                            relaxation, we chose our wedding to be an adult only
                            affair.
                        </p>
                    </div>
                    <div
                        class="col-span-1 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <Car class="m-auto mb-5 h-20 w-20" />
                        <p class="uppercase">PARKING</p>
                    </div>
                    <div
                        class="col-span-2 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <a
                            href="https://maps.app.goo.gl/MJeGE12dxgJuiTye9"
                            target="_blank"
                            class="font-bold tracking-widest uppercase underline transition duration-300 hover:opacity-80"
                        >
                            Parking Address
                        </a>
                        <p>
                            Villa Immaculada Parking, Cabildo cor. Anda Street,
                            Intramuros, Manila
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section
            class="relative w-full overflow-hidden bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/f1-bg.png')"
        >
            <div class="p-20">
                <div class="rounded-3xl p-20 text-white">
                    <Heart class="animateUp m-auto h-20 w-20" />
                    <p
                        class="font-wedding-accent animateUp mb-6 text-center text-[5rem]"
                    >
                        With respect ...
                    </p>
                    <p
                        class="animateUp mb-4 text-justify font-playfair text-4xl uppercase"
                    >
                        Due to limited capacity at our venue, we kindly ask that
                        guests refrain from bringing a plus-one unless they are
                        specifically named on the invitation.
                    </p>
                    <hr
                        class="animateUp mb-4 border-2 border-dashed border-white"
                    />
                    <p
                        class="animateUp text-center font-playfair text-4xl uppercase"
                    >
                        Thank you for your understanding<br />we look forward to
                        celebrating with you!
                    </p>
                </div>
            </div>
        </section>
        <section class="bg-[#ebddd7]">
            <div class="m-auto max-w-[1000px] p-20 text-center text-[#4c0211]">
                <p class="font-wedding-accent animateUp text-[9rem]">RSVP</p>
                <p
                    class="animateUp mb-10 text-center font-playfair text-3xl leading-[1.5]"
                >
                    Your presence is the greatest gift you could give us on our
                    special day. Please let us know if you can join us in
                    celebrating our love story.
                </p>
                <div class="animateUp m-auto w-fit">
                    <a
                        href="/rsvp"
                        class="inline-block cursor-pointer rounded-full bg-[#4c0211] px-20 py-10 text-4xl font-bold text-white transition-all duration-300 hover:scale-105 hover:bg-[#3a010d]"
                    >
                        RSVP Now
                    </a>
                </div>
                <p class="animateUp mt-10 font-playfair text-2xl italic">
                    Kindly respond until November 25, 2025
                    <br />
                    Person to contact for response:
                    <br />Dannica Tejada
                    <br />
                    <a href="">09665898647</a>
                </p>
            </div>
        </section>
    </NonResponsiveWrapper>
</template>
<style></style>
