<script lang="ts" setup>
import { onMounted, onUnmounted, ref } from 'vue';

const entourage = {
    parents: {
        bride: {
            father: 'Mr. Danilo R. Tejada',
            mother: 'Mrs. Elona L. Tejada',
            label: 'Parents of the Bride',
        },
        groom: {
            father: 'Mr. Jesus R. Villaluz',
            mother: 'Mrs. Imelda D. Villaluz',
            label: 'Parents of the Groom',
        },
    },
    principalSponsors: [
        // Male Sponsors
        {
            name: 'Mr. Teddy R. Vinzon',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mr. Erick J. Santos',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mr. Salvador R. Tejada Jr.',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mr. Danilo C. Teofilo',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mr. Enrico Simon',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mr. Cristino Cuanang',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mr. Remilo Eguico',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mr. Michael Dingco',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mr. Aries Torreleiza',
            role: 'Principal Sponsor',
        },
        {
            name: 'Chief Engr. Jaime Roncales',
            role: 'Principal Sponsor',
        },
        // Female Sponsors
        {
            name: 'Mrs. Carmela C. Vinzon',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mrs. Jasmin D. Sarmiento',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mrs. Consuelo B. Bernardo',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mrs. Ma. Leticia D. Teofilo',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mrs. Elisa G. Simon',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mrs. May Quimba',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mrs. Eway V. Castillo',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mrs. Analyn P. Navarro',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mrs. Cristina Torreleiza',
            role: 'Principal Sponsor',
        },
        {
            name: 'Mrs. Angelina Lamis',
            role: 'Principal Sponsor',
        },
    ],
    secondarySponsors: [
        { name: 'Einar Jedrek D. Santos', role: 'Candle Sponsor' },
        { name: 'Marion Joyce D. Sarmiento', role: 'Candle Sponsor' },
        { name: 'Jesi Valencia', role: 'Veil Sponsor' },
        { name: 'Mary Claire Vinzon-Geronimo', role: 'Veil Sponsor' },
        { name: 'John Dennis B. Bernardo', role: 'Cord Sponsor' },
        { name: 'Jona Jane T. Gran', role: 'Cord Sponsor' },
    ],
    groomsmen: [
        { name: 'Jemuel Christian D. Villaluz', role: 'Best Man' },
        { name: 'Jerico N. Villaluz', role: 'Groomsman' },
        { name: 'Brian Paolo Rañeses', role: 'Groomsman' },
    ],
    bridesmaids: [
        { name: 'Ona Elledan Tejada-Bernardo', role: 'Matron of Honor' },
        { name: 'Ericka Jayne D. Santos', role: 'Bridesmaid' },
        { name: 'Eisha Eurice F. Valencia', role: 'Bridesmaid' },
    ],
    coinBearer: { name: 'Emmanuel D. Aguilar', role: 'Coin Bearer' },
    bibleBearer: { name: 'Kyle Dame F. Villaspin', role: 'Bible Bearer' },
    ringBearer: { name: 'Zeke Nikolai S. Sarmiento', role: 'Ring Bearer' },
    flowerGirls: [
        { name: 'Julia Dennise T. Bernardo', role: 'Little Bride' },
        { name: 'Elliyah Jhay D. Santos', role: 'Flower Lady' },
        { name: 'Eiryn Jessy D. Santos', role: 'Flower Lady' },
        { name: 'Meiryne Joie D. Sarmiento', role: 'Flower Lady' },
    ],
};

// Section visibility states
const sectionsVisible = ref({
    header: false,
    parents: false,
    principalSponsors: false,
    secondarySponsors: false,
    weddingParty: false,
    littleOnes: false,
});

// Intersection observer for scroll animations
const handleScroll = () => {
    const windowHeight = window.innerHeight;

    // Check header section
    const headerEl = document.querySelector('.entourage-header');
    if (headerEl) {
        const rect = headerEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            sectionsVisible.value.header = true;
        }
    }

    // Check parents section
    const parentsEl = document.querySelector('.parents-section');
    if (parentsEl) {
        const rect = parentsEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            sectionsVisible.value.parents = true;
        }
    }

    // Check principal sponsors section
    const principalEl = document.querySelector('.principal-sponsors-section');
    if (principalEl) {
        const rect = principalEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            sectionsVisible.value.principalSponsors = true;
        }
    }

    // Check secondary sponsors section
    const secondaryEl = document.querySelector('.secondary-sponsors-section');
    if (secondaryEl) {
        const rect = secondaryEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            sectionsVisible.value.secondarySponsors = true;
        }
    }

    // Check wedding party section
    const weddingPartyEl = document.querySelector('.wedding-party-section');
    if (weddingPartyEl) {
        const rect = weddingPartyEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            sectionsVisible.value.weddingParty = true;
        }
    }

    // Check little ones section
    const littleOnesEl = document.querySelector('.little-ones-section');
    if (littleOnesEl) {
        const rect = littleOnesEl.getBoundingClientRect();
        if (rect.top < windowHeight * 0.8 && rect.top > 0) {
            sectionsVisible.value.littleOnes = true;
        }
    }
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Initial check

    // Trigger header animation after mount
    setTimeout(() => {
        sectionsVisible.value.header = true;
    }, 300);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <section
        id="entourage"
        class="relative overflow-hidden bg-gradient-to-b from-rose-50/20 via-white to-amber-50/20 py-16 md:py-24"
    >
        <!-- Background decorative elements -->
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute top-20 right-10 h-32 w-32 opacity-5">
                <svg
                    viewBox="0 0 100 100"
                    class="animate-spin-slow text-rose-400"
                >
                    <circle cx="50" cy="50" r="2" fill="currentColor">
                        <animate
                            attributeName="r"
                            values="2;30;2"
                            dur="6s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="1;0.2;1"
                            dur="6s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
            <div class="absolute bottom-20 left-10 h-28 w-28 opacity-5">
                <svg
                    viewBox="0 0 100 100"
                    class="animate-spin-slow-reverse text-amber-400"
                >
                    <circle cx="50" cy="50" r="2" fill="currentColor">
                        <animate
                            attributeName="r"
                            values="2;25;2"
                            dur="7s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="1;0.3;1"
                            dur="7s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
            <div class="absolute top-1/2 left-1/4 h-24 w-24 opacity-3">
                <svg
                    viewBox="0 0 100 100"
                    class="animate-spin-slow text-rose-300"
                >
                    <circle cx="50" cy="50" r="1.5" fill="currentColor">
                        <animate
                            attributeName="r"
                            values="1.5;20;1.5"
                            dur="8s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="0.8;0.1;0.8"
                            dur="8s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
        </div>

        <div class="mx-auto max-w-[1440px] px-4 sm:px-8 md:px-12 lg:px-20">
            <!-- Section Header -->
            <div
                class="entourage-header mb-20 text-center transition-all duration-1000 ease-out"
                :class="
                    sectionsVisible.header
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <div class="mb-8 inline-block">
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
                    Our Entourage
                </h2>
                <p
                    class="mx-auto max-w-2xl text-lg leading-relaxed font-light text-gray-600 md:text-xl"
                >
                    The cherished family and friends who will stand with us as
                    we begin our forever
                </p>
            </div>

            <!-- Parents Section -->
            <div
                class="parents-section mx-auto mb-16 max-w-4xl transition-all delay-200 duration-1000 ease-out md:mb-20"
                :class="
                    sectionsVisible.parents
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <h3
                    class="mb-8 text-center font-secondary text-2xl font-light text-gray-800 sm:text-3xl md:mb-12"
                >
                    Our Parents
                </h3>
                <div class="grid gap-6 md:grid-cols-2 md:gap-8">
                    <div class="group relative">
                        <div
                            class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl sm:p-8"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <div class="relative z-10 text-center">
                                <div class="mb-6">
                                    <div
                                        class="mx-auto mb-4 flex h-20 w-20 transform items-center justify-center rounded-full bg-gradient-to-br from-rose-400 to-amber-400 shadow-lg transition-transform duration-300 group-hover:scale-110"
                                    >
                                        <svg
                                            class="h-10 w-10 text-white"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                    </div>
                                    <h4
                                        class="mb-4 font-secondary text-xl font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-2xl"
                                    >
                                        {{ entourage.parents.bride.label }}
                                    </h4>
                                </div>
                                <div class="space-y-3">
                                    <p
                                        class="text-lg font-light text-gray-800 sm:text-xl"
                                    >
                                        {{ entourage.parents.bride.father }}
                                    </p>
                                    <p
                                        class="text-lg font-light text-gray-800 sm:text-xl"
                                    >
                                        {{ entourage.parents.bride.mother }}
                                    </p>
                                </div>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute top-0 right-0 h-20 w-20 opacity-5"
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

                    <div class="group relative">
                        <div
                            class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl sm:p-8"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <div class="relative z-10 text-center">
                                <div class="mb-6">
                                    <div
                                        class="mx-auto mb-4 flex h-20 w-20 transform items-center justify-center rounded-full bg-gradient-to-br from-rose-400 to-amber-400 shadow-lg transition-transform duration-300 group-hover:scale-110"
                                    >
                                        <svg
                                            class="h-10 w-10 text-white"
                                            fill="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                    </div>
                                    <h4
                                        class="mb-4 font-secondary text-xl font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-2xl"
                                    >
                                        {{ entourage.parents.groom.label }}
                                    </h4>
                                </div>
                                <div class="space-y-3">
                                    <p
                                        class="text-lg font-light text-gray-800 sm:text-xl"
                                    >
                                        {{ entourage.parents.groom.father }}
                                    </p>
                                    <p
                                        class="text-lg font-light text-gray-800 sm:text-xl"
                                    >
                                        {{ entourage.parents.groom.mother }}
                                    </p>
                                </div>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute top-0 right-0 h-20 w-20 opacity-5"
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

            <!-- Principal Sponsors Section -->
            <div
                class="principal-sponsors-section mx-auto mb-16 max-w-4xl transition-all delay-300 duration-1000 ease-out md:mb-20"
                :class="
                    sectionsVisible.principalSponsors
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <h3
                    class="mb-8 text-center font-secondary text-2xl font-light text-gray-800 sm:text-3xl md:mb-12"
                >
                    Principal Sponsors
                </h3>
                <div class="grid gap-4 sm:grid-cols-2 md:gap-6">
                    <div
                        v-for="(sponsor, index) in entourage.principalSponsors"
                        :key="index"
                        class="group relative"
                    >
                        <div
                            class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl"
                            :style="{ transitionDelay: `${index * 100}ms` }"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <div class="relative z-10 text-center">
                                <p
                                    class="mb-2 text-lg font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-xl"
                                >
                                    {{ sponsor.name }}
                                </p>
                                <p
                                    class="text-sm font-medium tracking-wider text-rose-500 uppercase"
                                >
                                    {{ sponsor.role }}
                                </p>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute top-0 right-0 h-16 w-16 opacity-5"
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

            <!-- Secondary Sponsors Section -->
            <div
                class="secondary-sponsors-section mx-auto mb-16 max-w-4xl transition-all delay-400 duration-1000 ease-out md:mb-20"
                :class="
                    sectionsVisible.secondarySponsors
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <h3
                    class="mb-8 text-center font-secondary text-2xl font-light text-gray-800 sm:text-3xl md:mb-12"
                >
                    Secondary Sponsors
                </h3>
                <div class="grid gap-4 sm:grid-cols-2 md:grid-cols-3 md:gap-6">
                    <div
                        v-for="(sponsor, index) in entourage.secondarySponsors"
                        :key="index"
                        class="group relative"
                    >
                        <div
                            class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 text-center shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl"
                            :style="{ transitionDelay: `${index * 100}ms` }"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <div class="relative z-10">
                                <p
                                    class="mb-2 text-lg font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-xl"
                                >
                                    {{ sponsor.name }}
                                </p>
                                <p
                                    class="text-sm font-medium tracking-wider text-rose-500 uppercase"
                                >
                                    {{ sponsor.role }}
                                </p>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute top-0 right-0 h-16 w-16 opacity-5"
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

            <!-- Wedding Party Section -->
            <div
                class="wedding-party-section mx-auto mb-16 max-w-6xl transition-all delay-500 duration-1000 ease-out md:mb-20"
                :class="
                    sectionsVisible.weddingParty
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <div class="grid gap-8 md:grid-cols-2 md:gap-12">
                    <!-- Groomsmen -->
                    <div>
                        <h3
                            class="mb-8 text-center font-secondary text-2xl font-light text-gray-800 sm:text-3xl md:mb-12"
                        >
                            Groomsmen
                        </h3>
                        <div class="space-y-4 md:space-y-6">
                            <div
                                v-for="(
                                    groomsman, index
                                ) in entourage.groomsmen"
                                :key="index"
                                class="group relative"
                            >
                                <div
                                    class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-4 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl sm:p-6"
                                    :style="{
                                        transitionDelay: `${index * 100}ms`,
                                    }"
                                >
                                    <!-- Decorative gradient overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                                    ></div>

                                    <div class="relative z-10">
                                        <p
                                            class="mb-1 text-lg font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-xl"
                                        >
                                            {{ groomsman.name }}
                                        </p>
                                        <p
                                            class="text-sm font-medium tracking-wider text-rose-500 uppercase"
                                        >
                                            {{ groomsman.role }}
                                        </p>
                                    </div>

                                    <!-- Decorative corner -->
                                    <div
                                        class="absolute top-0 right-0 h-16 w-16 opacity-5"
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

                    <!-- Bridesmaids -->
                    <div>
                        <h3
                            class="mb-8 text-center font-secondary text-2xl font-light text-gray-800 sm:text-3xl md:mb-12"
                        >
                            Bridesmaids
                        </h3>
                        <div class="space-y-4 md:space-y-6">
                            <div
                                v-for="(
                                    bridesmaid, index
                                ) in entourage.bridesmaids"
                                :key="index"
                                class="group relative"
                            >
                                <div
                                    class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-4 shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl sm:p-6"
                                    :style="{
                                        transitionDelay: `${index * 100}ms`,
                                    }"
                                >
                                    <!-- Decorative gradient overlay -->
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                                    ></div>

                                    <div class="relative z-10">
                                        <p
                                            class="mb-1 text-lg font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-xl"
                                        >
                                            {{ bridesmaid.name }}
                                        </p>
                                        <p
                                            class="text-sm font-medium tracking-wider text-rose-500 uppercase"
                                        >
                                            {{ bridesmaid.role }}
                                        </p>
                                    </div>

                                    <!-- Decorative corner -->
                                    <div
                                        class="absolute top-0 right-0 h-16 w-16 opacity-5"
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

            <!-- Little Ones Section -->
            <div
                class="little-ones-section mx-auto max-w-6xl transition-all delay-600 duration-1000 ease-out"
                :class="
                    sectionsVisible.littleOnes
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <h3
                    class="mb-8 text-center font-secondary text-2xl font-light text-gray-800 sm:text-3xl md:mb-12"
                >
                    Our Little Ones
                </h3>
                <div
                    class="mb-6 grid gap-4 sm:grid-cols-2 md:grid-cols-3 md:gap-6"
                >
                    <div class="group relative">
                        <div
                            class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 text-center shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <div class="relative z-10">
                                <p
                                    class="mb-2 text-lg font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-xl"
                                >
                                    {{ entourage.coinBearer.name }}
                                </p>
                                <p
                                    class="text-sm font-medium tracking-wider text-rose-500 uppercase"
                                >
                                    {{ entourage.coinBearer.role }}
                                </p>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute top-0 right-0 h-16 w-16 opacity-5"
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

                    <div class="group relative">
                        <div
                            class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 text-center shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <div class="relative z-10">
                                <p
                                    class="mb-2 text-lg font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-xl"
                                >
                                    {{ entourage.bibleBearer.name }}
                                </p>
                                <p
                                    class="text-sm font-medium tracking-wider text-rose-500 uppercase"
                                >
                                    {{ entourage.bibleBearer.role }}
                                </p>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute top-0 right-0 h-16 w-16 opacity-5"
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

                    <div class="group relative">
                        <div
                            class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 text-center shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <div class="relative z-10">
                                <p
                                    class="mb-2 text-lg font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-xl"
                                >
                                    {{ entourage.ringBearer.name }}
                                </p>
                                <p
                                    class="text-sm font-medium tracking-wider text-rose-500 uppercase"
                                >
                                    {{ entourage.ringBearer.role }}
                                </p>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute top-0 right-0 h-16 w-16 opacity-5"
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

                <div
                    class="mx-auto grid max-w-2xl gap-4 sm:grid-cols-2 md:grid-cols-2 md:gap-6 lg:grid-cols-2"
                >
                    <div
                        v-for="(girl, index) in entourage.flowerGirls"
                        :key="index"
                        class="group relative"
                    >
                        <div
                            class="relative overflow-hidden rounded-2xl border border-rose-100 bg-white p-6 text-center shadow-lg transition-all duration-500 hover:-translate-y-2 hover:border-rose-300 hover:shadow-2xl"
                            :style="{ transitionDelay: `${index * 100}ms` }"
                        >
                            <!-- Decorative gradient overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"
                            ></div>

                            <div class="relative z-10">
                                <p
                                    class="mb-2 text-lg font-light text-gray-800 transition-colors duration-300 group-hover:text-rose-600 sm:text-xl"
                                >
                                    {{ girl.name }}
                                </p>
                                <p
                                    class="text-sm font-medium tracking-wider text-rose-500 uppercase"
                                >
                                    {{ girl.role }}
                                </p>
                            </div>

                            <!-- Decorative corner -->
                            <div
                                class="absolute top-0 right-0 h-16 w-16 opacity-5"
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

            <!-- Bottom decorative element -->
            <div class="mt-20 text-center">
                <div class="inline-flex items-center space-x-4">
                    <div
                        class="h-px w-24 bg-gradient-to-r from-transparent via-rose-300 to-transparent"
                    ></div>
                    <p class="font-light text-gray-500 italic">
                        Blessed by the presence of our loved ones
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

.animate-pulse-slow {
    animation: pulse-slow 3s ease-in-out infinite;
}

/* Staggered animation delays for cards */
.principal-sponsors-section .group:nth-child(1) {
    transition-delay: 0.1s;
}
.principal-sponsors-section .group:nth-child(2) {
    transition-delay: 0.2s;
}
.principal-sponsors-section .group:nth-child(3) {
    transition-delay: 0.3s;
}
.principal-sponsors-section .group:nth-child(4) {
    transition-delay: 0.4s;
}

.secondary-sponsors-section .group:nth-child(1) {
    transition-delay: 0.1s;
}
.secondary-sponsors-section .group:nth-child(2) {
    transition-delay: 0.2s;
}
.secondary-sponsors-section .group:nth-child(3) {
    transition-delay: 0.3s;
}

.wedding-party-section .group:nth-child(1) {
    transition-delay: 0.1s;
}
.wedding-party-section .group:nth-child(2) {
    transition-delay: 0.2s;
}
.wedding-party-section .group:nth-child(3) {
    transition-delay: 0.3s;
}
.wedding-party-section .group:nth-child(4) {
    transition-delay: 0.4s;
}

.little-ones-section .group:nth-child(1) {
    transition-delay: 0.1s;
}
.little-ones-section .group:nth-child(2) {
    transition-delay: 0.2s;
}
.little-ones-section .group:nth-child(3) {
    transition-delay: 0.3s;
}
</style>
