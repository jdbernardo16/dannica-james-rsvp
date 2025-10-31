<script lang="ts" setup>
import { ref, watch } from 'vue';

const isMenuOpen = ref(false);

const navItems = [
    { name: 'Save the Date', href: '#save-the-date' },
    { name: 'Our Story', href: '#story' },
    { name: 'Couple', href: '#couple' },
    { name: 'Invitation', href: '#invitation' },
    { name: 'Schedule', href: '#schedule' },
    { name: 'Location', href: '#location' },
    { name: 'Attire', href: '#attire' },
    { name: 'Entourage', href: '#entourage' },
    { name: 'RSVP', href: '/rsvp' },
];

const scrollToSection = (href: string) => {
    // Check if it's a route navigation (starts with /)
    if (href.startsWith('/')) {
        window.location.href = href;
        return;
    }

    // Handle anchor link scrolling
    const element = document.querySelector(href);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
    // Close mobile menu after clicking a link
    isMenuOpen.value = false;
};

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

// Prevent body scroll when mobile menu is open (only on client side)
watch(isMenuOpen, (newValue) => {
    if (typeof window !== 'undefined') {
        if (newValue) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }
});
</script>

<template>
    <header
        class="fixed top-0 right-0 left-0 z-50 bg-white/95 py-4 shadow-sm backdrop-blur-sm"
    >
        <div
            class="mx-auto flex max-w-[var(--container-default)] items-center justify-between px-4 sm:px-8"
        >
            <div @click="scrollToSection('#home')" class="text-left">
                <h1
                    class="text-brown font-secondary text-2xl font-normal tracking-wide sm:text-3xl"
                >
                    James & Dannica
                </h1>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:block">
                <ul class="flex gap-6 sm:gap-8">
                    <li v-for="item in navItems" :key="item.name">
                        <button
                            @click="scrollToSection(item.href)"
                            class="group relative font-primary text-sm text-gray-700 transition-colors duration-300 hover:text-amber-600"
                        >
                            {{ item.name }}
                            <span
                                class="absolute bottom-0 left-0 h-0.5 w-0 bg-gradient-to-r from-rose-200 to-amber-200 transition-all duration-300 group-hover:w-full"
                            ></span>
                        </button>
                    </li>
                </ul>
            </nav>

            <!-- Mobile Hamburger Menu -->
            <button
                @click="toggleMenu"
                class="flex h-10 w-10 flex-col items-center justify-center space-y-1.5 rounded-lg p-2 transition-all duration-200 hover:bg-gray-50 focus:ring-2 focus:ring-amber-200 focus:outline-none md:hidden"
                aria-label="Toggle menu"
                :class="isMenuOpen ? 'bg-amber-50' : ''"
            >
                <span
                    class="block h-0.5 w-6 transform bg-gray-700 transition-all duration-300 ease-in-out"
                    :class="isMenuOpen ? 'translate-y-2 rotate-45' : ''"
                ></span>
                <span
                    class="block h-0.5 w-6 bg-gray-700 transition-all duration-300 ease-in-out"
                    :class="isMenuOpen ? 'opacity-0' : 'opacity-100'"
                ></span>
                <span
                    class="block h-0.5 w-6 transform bg-gray-700 transition-all duration-300 ease-in-out"
                    :class="isMenuOpen ? '-translate-y-2 -rotate-45' : ''"
                ></span>
            </button>
        </div>

        <!-- Mobile Navigation Drawer -->
    </header>

    <Teleport to="body">
        <div
            class="fixed inset-0 z-40 md:hidden"
            :class="isMenuOpen ? 'pointer-events-auto' : 'pointer-events-none'"
        >
            <!-- Backdrop -->
            <div
                @click="toggleMenu"
                class="absolute inset-0 bg-black/50 backdrop-blur-sm transition-all duration-300"
                :class="isMenuOpen ? 'opacity-100' : 'opacity-0'"
            ></div>

            <!-- Menu Drawer -->
            <nav
                class="absolute top-0 right-0 h-full w-72 max-w-[85vw] transform overflow-y-auto bg-white shadow-2xl transition-all duration-300 ease-in-out sm:w-80"
                :class="
                    isMenuOpen
                        ? 'translate-x-0 opacity-100'
                        : 'translate-x-full opacity-0'
                "
            >
                <div class="flex h-full min-h-screen flex-col">
                    <!-- Header with Close Button -->
                    <div
                        class="flex items-center justify-between border-b border-gray-100 p-4 sm:p-6"
                    >
                        <div class="text-left">
                            <h2
                                class="text-brown font-secondary text-xl font-normal tracking-wide sm:text-2xl"
                            >
                                Menu
                            </h2>
                        </div>
                        <button
                            @click="toggleMenu"
                            class="rounded-full p-3 text-gray-700 transition-all duration-200 hover:bg-gray-100 hover:text-gray-900 focus:ring-2 focus:ring-amber-200 focus:outline-none"
                            aria-label="Close menu"
                        >
                            <svg
                                class="h-5 w-5 sm:h-6 sm:w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                ></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Links -->
                    <div class="flex-1 py-4 sm:py-6">
                        <ul
                            class="flex flex-col space-y-2 px-4 sm:space-y-3 sm:px-6"
                        >
                            <li v-for="item in navItems" :key="item.name">
                                <button
                                    @click="scrollToSection(item.href)"
                                    class="block w-full transform rounded-xl px-4 py-4 text-left text-base font-medium text-gray-700 transition-all duration-300 hover:scale-[1.02] hover:bg-amber-50 hover:text-amber-600 active:scale-[0.98] sm:px-5 sm:py-5 sm:text-lg"
                                >
                                    <span class="flex items-center">
                                        <span class="mr-3">
                                            <!-- Add simple icon indicators -->
                                            <svg
                                                v-if="item.name === 'Home'"
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                                ></path>
                                            </svg>
                                            <svg
                                                v-else-if="
                                                    item.name ===
                                                    'Save the Date'
                                                "
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                ></path>
                                            </svg>
                                            <svg
                                                v-else-if="
                                                    item.name === 'Our Story'
                                                "
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
                                                ></path>
                                            </svg>
                                            <svg
                                                v-else-if="
                                                    item.name === 'Couple'
                                                "
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
                                                ></path>
                                            </svg>
                                            <svg
                                                v-else-if="
                                                    item.name === 'Invitation'
                                                "
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                ></path>
                                            </svg>
                                            <svg
                                                v-else-if="
                                                    item.name === 'Schedule'
                                                "
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                                ></path>
                                            </svg>
                                            <svg
                                                v-else-if="
                                                    item.name === 'Location'
                                                "
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                                ></path>
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                                ></path>
                                            </svg>
                                            <svg
                                                v-else-if="
                                                    item.name === 'Attire'
                                                "
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"
                                                ></path>
                                            </svg>
                                            <svg
                                                v-else-if="
                                                    item.name === 'Entourage'
                                                "
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"
                                                ></path>
                                            </svg>
                                            <svg
                                                v-else-if="item.name === 'RSVP'"
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                                ></path>
                                            </svg>
                                        </span>
                                        {{ item.name }}
                                    </span>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <!-- Footer -->
                    <div class="mt-auto border-t border-gray-100 p-4 sm:p-6">
                        <div class="text-center">
                            <p class="mb-2 text-xs text-gray-500 sm:text-sm">
                                Dannica & James
                            </p>
                            <p class="text-xs text-gray-400">Wedding RSVP</p>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </Teleport>
</template>
