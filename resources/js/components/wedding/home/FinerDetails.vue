<script lang="ts" setup>
import { onMounted, onUnmounted, ref } from 'vue';

const sections = ref({
    header: false,
    giftGuide: false,
    directionGuide: false,
    attire: false,
});

const observeSection = (entries: IntersectionObserverEntry[]) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const sectionName = entry.target.getAttribute('data-section');
            if (sectionName && sectionName in sections.value) {
                sections.value[sectionName as keyof typeof sections.value] =
                    true;
            }
        }
    });
};

let observer: IntersectionObserver | null = null;

onMounted(() => {
    observer = new IntersectionObserver(observeSection, {
        threshold: 0.1,
        rootMargin: '-10% 0px',
    });

    document.querySelectorAll('[data-section]').forEach((el) => {
        observer?.observe(el);
    });

    setTimeout(() => {
        sections.value.header = true;
    }, 200);
});

onUnmounted(() => {
    observer?.disconnect();
});
</script>

<template>
    <section
        class="relative overflow-hidden bg-gradient-to-b from-rose-50/30 via-white to-amber-50/30 py-20 md:py-32"
    >
        <!-- Decorative Elements -->
        <div class="pointer-events-none absolute inset-0 opacity-40">
            <div class="animate-float absolute top-20 right-10 h-32 w-32">
                <svg viewBox="0 0 100 100" class="text-rose-300">
                    <circle
                        cx="50"
                        cy="50"
                        r="20"
                        fill="currentColor"
                        opacity="0.3"
                    >
                        <animate
                            attributeName="r"
                            values="20;35;20"
                            dur="8s"
                            repeatCount="indefinite"
                        />
                        <animate
                            attributeName="opacity"
                            values="0.3;0.1;0.3"
                            dur="8s"
                            repeatCount="indefinite"
                        />
                    </circle>
                </svg>
            </div>
        </div>

        <div class="mx-auto max-w-6xl px-4 sm:px-8">
            <!-- Header -->
            <header
                data-section="header"
                class="mb-20 text-center transition-all duration-1000"
                :class="
                    sections.header
                        ? 'translate-y-0 opacity-100'
                        : 'translate-y-8 opacity-0'
                "
            >
                <div class="mb-6 inline-flex items-center gap-3">
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
                <h2
                    class="mb-4 font-secondary text-5xl font-light text-gray-800 md:text-6xl"
                >
                    Finer Details
                </h2>
                <p class="mx-auto max-w-2xl text-lg font-light text-gray-600">
                    Important information to make our celebration perfect
                </p>
            </header>

            <div class="grid gap-8 md:grid-cols-3">
                <!-- Gift Guide -->
                <article
                    data-section="giftGuide"
                    class="group rounded-2xl bg-gradient-to-br from-rose-50 to-amber-50 p-8 shadow-lg transition-all duration-700 hover:shadow-xl md:col-span-2"
                    :class="
                        sections.giftGuide
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <div class="mb-4 flex items-center gap-3">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-rose-600 shadow-sm transition-transform group-hover:scale-110"
                        >
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"
                                />
                            </svg>
                        </div>
                        <h3
                            class="font-secondary text-3xl font-light text-gray-800"
                        >
                            Gift Guide
                        </h3>
                    </div>
                    <p class="leading-relaxed text-gray-700">
                        With all that we have, your presence and prayers are all
                        that we request. If you desire to give, a monetary gift
                        is suggested.
                    </p>
                </article>

                <!-- Direction Guide -->
                <article
                    data-section="directionGuide"
                    class="group rounded-2xl bg-gradient-to-br from-amber-50 to-rose-50 p-8 shadow-lg transition-all duration-700 hover:shadow-xl md:col-span-2"
                    :class="
                        sections.directionGuide
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <div class="mb-6 flex items-center gap-3">
                        <div
                            class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-amber-600 shadow-sm transition-transform group-hover:scale-110"
                        >
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"
                                />
                            </svg>
                        </div>
                        <h3
                            class="font-secondary text-3xl font-light text-gray-800"
                        >
                            Direction Guide
                        </h3>
                    </div>

                    <div class="flex flex-col gap-6 sm:flex-row sm:items-start">
                        <div
                            class="group/qr relative mx-auto flex h-36 w-36 shrink-0 items-center justify-center rounded-xl bg-white p-2 shadow-md transition-all hover:scale-105 hover:shadow-lg"
                        >
                            <svg
                                viewBox="0 0 24 24"
                                class="h-24 w-24 text-rose-600"
                            >
                                <rect
                                    x="2"
                                    y="2"
                                    width="6"
                                    height="6"
                                    fill="currentColor"
                                />
                                <rect
                                    x="10"
                                    y="2"
                                    width="4"
                                    height="4"
                                    fill="currentColor"
                                />
                                <rect
                                    x="16"
                                    y="2"
                                    width="6"
                                    height="6"
                                    fill="currentColor"
                                />
                                <rect
                                    x="2"
                                    y="10"
                                    width="4"
                                    height="4"
                                    fill="currentColor"
                                />
                                <rect
                                    x="8"
                                    y="8"
                                    width="10"
                                    height="10"
                                    fill="currentColor"
                                />
                            </svg>
                            <div
                                class="absolute -right-2 -bottom-2 flex h-8 w-8 items-center justify-center rounded-full bg-rose-500 text-white shadow-lg"
                            >
                                <svg
                                    class="h-4 w-4"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                            </div>
                        </div>

                        <div class="flex-1 space-y-4">
                            <p class="text-gray-700">
                                Scan this QR code to get directions from
                                Ceremony to Reception.
                            </p>
                            <div class="rounded-lg bg-white p-4 shadow-sm">
                                <p
                                    class="mb-2 flex items-center text-sm font-semibold text-gray-800"
                                >
                                    <svg
                                        class="mr-2 h-4 w-4 text-amber-500"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"
                                        />
                                    </svg>
                                    Parking Address
                                </p>
                                <p class="text-sm text-gray-600">
                                    Villa Immaculada Parking, Cabildo cor. Anda
                                    Street, Intramuros Manila
                                </p>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Attire Guide -->
                <aside
                    data-section="attire"
                    class="rounded-2xl bg-gradient-to-br from-white to-rose-50 p-8 shadow-lg transition-all duration-700 md:col-span-1 md:row-span-2"
                    :class="
                        sections.attire
                            ? 'translate-y-0 opacity-100'
                            : 'translate-y-8 opacity-0'
                    "
                >
                    <div class="mb-8 text-center">
                        <div class="mb-4 inline-flex items-center gap-3">
                            <div
                                class="h-px w-8 bg-gradient-to-r from-transparent to-rose-300"
                            ></div>
                            <svg
                                class="h-5 w-5 text-rose-400"
                                fill="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"
                                />
                            </svg>
                            <div
                                class="h-px w-8 bg-gradient-to-l from-transparent to-rose-300"
                            ></div>
                        </div>
                        <h4
                            class="font-secondary text-3xl font-light text-gray-800"
                        >
                            Attire
                        </h4>
                    </div>

                    <div class="space-y-6">
                        <!-- Principal Sponsors -->
                        <div>
                            <p
                                class="mb-3 text-center text-sm font-semibold text-gray-700"
                            >
                                Principal Sponsors
                            </p>
                            <div class="space-y-3">
                                <div
                                    class="overflow-hidden rounded-xl bg-white shadow-sm transition-all hover:shadow-md"
                                >
                                    <div
                                        class="flex h-24 items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200"
                                    >
                                        <svg
                                            class="h-10 w-10 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                    </div>
                                    <div class="p-3">
                                        <p
                                            class="text-sm font-medium text-gray-800"
                                        >
                                            Gentlemen
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            Barong Tagalog, black pants
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="overflow-hidden rounded-xl bg-white shadow-sm transition-all hover:shadow-md"
                                >
                                    <div
                                        class="flex h-24 items-center justify-center bg-gradient-to-br from-rose-100 to-pink-200"
                                    >
                                        <svg
                                            class="h-10 w-10 text-rose-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                    </div>
                                    <div class="p-3">
                                        <p
                                            class="text-sm font-medium text-gray-800"
                                        >
                                            Ladies
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            Filipiniana or butterfly dress
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="border-t border-dashed border-rose-200"
                        ></div>

                        <!-- Guests -->
                        <div>
                            <p
                                class="mb-3 text-center text-sm font-semibold text-gray-700"
                            >
                                Guests
                            </p>
                            <div class="grid grid-cols-2 gap-3">
                                <div
                                    class="rounded-lg bg-gray-50 p-3 text-center"
                                >
                                    <div
                                        class="mb-2 flex h-12 items-center justify-center rounded bg-gradient-to-br from-gray-100 to-gray-200"
                                    >
                                        <svg
                                            class="h-6 w-6 text-gray-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                    </div>
                                    <p
                                        class="text-xs font-medium text-gray-700"
                                    >
                                        Gentlemen
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Barong or long sleeves
                                    </p>
                                </div>
                                <div
                                    class="rounded-lg bg-rose-50 p-3 text-center"
                                >
                                    <div
                                        class="mb-2 flex h-12 items-center justify-center rounded bg-gradient-to-br from-rose-100 to-pink-200"
                                    >
                                        <svg
                                            class="h-6 w-6 text-rose-400"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                                            />
                                        </svg>
                                    </div>
                                    <p
                                        class="text-xs font-medium text-gray-700"
                                    >
                                        Ladies
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        Modern Filipiniana or puff sleeves
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Color Palette -->
                        <div>
                            <p
                                class="mb-3 text-center text-sm font-medium text-gray-700"
                            >
                                Color Palette
                            </p>
                            <div class="flex justify-center gap-2">
                                <span
                                    class="h-8 w-8 rounded-full shadow-md transition-transform hover:scale-110"
                                    style="background: #f6d7d7"
                                    title="Dusty Rose"
                                ></span>
                                <span
                                    class="h-8 w-8 rounded-full shadow-md transition-transform hover:scale-110"
                                    style="background: #e8b7b0"
                                    title="Coral"
                                ></span>
                                <span
                                    class="h-8 w-8 rounded-full shadow-md transition-transform hover:scale-110"
                                    style="background: #d89a92"
                                    title="Terracotta"
                                ></span>
                                <span
                                    class="h-8 w-8 rounded-full shadow-md transition-transform hover:scale-110"
                                    style="background: #c77a6f"
                                    title="Burnt Sienna"
                                ></span>
                                <span
                                    class="h-8 w-8 rounded-full shadow-md transition-transform hover:scale-110"
                                    style="background: #9d5046"
                                    title="Deep Burgundy"
                                ></span>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
</template>

<style scoped>
.font-secondary {
    font-family: 'Dancing Script', 'Brush Script MT', 'Segoe Script', cursive;
}

.animate-float {
    animation: float 20s ease-in-out infinite;
}

.animate-pulse-slow {
    animation: pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes float {
    0%,
    100% {
        transform: translateY(0) rotate(0deg);
    }
    50% {
        transform: translateY(-20px) rotate(180deg);
    }
}

@keyframes pulse {
    0%,
    100% {
        opacity: 1;
    }
    50% {
        opacity: 0.6;
    }
}
</style>
