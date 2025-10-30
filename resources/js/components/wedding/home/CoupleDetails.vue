<script lang="ts" setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';

// Types
interface Category {
    id: string;
    title: string;
    items: string[];
}

// Composable for hover state management
const useHoverState = () => {
    const hoveredCategory = ref<string | null>(null);
    const hoveredItem = ref<string | null>(null);

    const setHoveredCategory = (id: string | null) => {
        hoveredCategory.value = id;
    };

    const setHoveredItem = (id: string | null) => {
        hoveredItem.value = id;
    };

    return {
        hoveredCategory,
        hoveredItem,
        setHoveredCategory,
        setHoveredItem,
    };
};

// Composable for intersection observer
const useIntersectionObserver = () => {
    const isVisible = ref(false);
    const sectionRef = ref<HTMLElement | null>(null);

    onMounted(() => {
        if (!sectionRef.value) return;

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        isVisible.value = true;
                        observer.disconnect();
                    }
                });
            },
            { threshold: 0.1 },
        );

        observer.observe(sectionRef.value);

        onUnmounted(() => {
            observer.disconnect();
        });
    });

    return { isVisible, sectionRef };
};

// Component state
const { hoveredCategory, hoveredItem, setHoveredCategory, setHoveredItem } =
    useHoverState();
const { isVisible, sectionRef } = useIntersectionObserver();

// Data
const categories: Category[] = [
    {
        id: 'he',
        title: 'He Likes',
        items: ['Sports', 'Chocolates', 'Singing', 'Shoes', 'Nature'],
    },
    {
        id: 'she',
        title: 'She Likes',
        items: [
            'K-Drama',
            'Fruits',
            'Singing',
            'Perfume & Mist',
            'Photography',
            'Beach & Mountains',
        ],
    },
    {
        id: 'they',
        title: 'They Like',
        items: [
            'Watching Movies Together',
            'Going on Road Trips',
            'Praying & Singing Praises',
            'Exploring Scents',
            'Trying Out New Food',
            'Doing Tiktok Trends',
            'Taking Photos & Videos',
        ],
    },
];

// Image parallax effect
const mouseX = ref(0);
const mouseY = ref(0);
const imageTransform = computed(() => {
    const x = (mouseX.value - 0.5) * 10;
    const y = (mouseY.value - 0.5) * 10;
    return `perspective(1000px) rotateY(${x}deg) rotateX(${-y}deg)`;
});

const handleMouseMove = (event: MouseEvent) => {
    const target = event.currentTarget as HTMLElement;
    const rect = target.getBoundingClientRect();
    mouseX.value = (event.clientX - rect.left) / rect.width;
    mouseY.value = (event.clientY - rect.top) / rect.height;
};

const handleMouseLeave = () => {
    mouseX.value = 0.5;
    mouseY.value = 0.5;
};

// Image loading
const imageLoaded = ref(false);
</script>

<template>
    <section
        ref="sectionRef"
        class="interests-section"
        role="region"
        aria-label="Couple's interests and hobbies"
    >
        <!-- Optimized background -->
        <div class="background-layer">
            <div class="gradient-base"></div>
            <svg class="decorative-pattern" aria-hidden="true">
                <defs>
                    <pattern
                        id="dots"
                        x="0"
                        y="0"
                        width="60"
                        height="60"
                        patternUnits="userSpaceOnUse"
                    >
                        <circle
                            cx="20"
                            cy="20"
                            r="1.5"
                            fill="currentColor"
                            opacity="0.1"
                        />
                        <circle
                            cx="50"
                            cy="45"
                            r="1"
                            fill="currentColor"
                            opacity="0.08"
                        />
                        <circle
                            cx="35"
                            cy="55"
                            r="1.2"
                            fill="currentColor"
                            opacity="0.09"
                        />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#dots)" />
            </svg>
        </div>

        <!-- Content Container -->
        <div class="content-wrapper">
            <div class="content-grid">
                <!-- Categories Section -->
                <div class="categories-container">
                    <div
                        v-for="(category, categoryIndex) in categories"
                        :key="category.id"
                        :class="[
                            'category-card',
                            category.id === 'they' ? 'category-full' : '',
                            { 'is-visible': isVisible },
                        ]"
                        :style="{ '--delay': `${categoryIndex * 150}ms` }"
                        @mouseenter="setHoveredCategory(category.id)"
                        @mouseleave="setHoveredCategory(null)"
                    >
                        <div class="category-glow" aria-hidden="true"></div>

                        <h3 class="category-title">
                            <span class="title-text">
                                {{ category.title.toUpperCase() }}
                            </span>
                        </h3>

                        <ul class="items-list" role="list">
                            <li
                                v-for="(item, itemIndex) in category.items"
                                :key="item"
                                :class="[
                                    'list-item',
                                    { 'is-visible': isVisible },
                                ]"
                                :style="{
                                    '--item-delay': `${
                                        categoryIndex * 150 + itemIndex * 50
                                    }ms`,
                                }"
                                @mouseenter="
                                    setHoveredItem(
                                        `${category.id}-${itemIndex}`,
                                    )
                                "
                                @mouseleave="setHoveredItem(null)"
                            >
                                <span class="item-text">{{ item }}</span>
                                <span
                                    class="item-underline"
                                    aria-hidden="true"
                                ></span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Image Section -->
                <div class="image-container">
                    <div
                        class="image-wrapper"
                        :class="{ 'is-visible': isVisible }"
                        @mousemove="handleMouseMove"
                        @mouseleave="handleMouseLeave"
                    >
                        <!-- Loading skeleton -->
                        <div
                            v-if="!imageLoaded"
                            class="image-skeleton"
                            aria-hidden="true"
                        >
                            <div class="skeleton-shimmer"></div>
                        </div>

                        <div
                            class="image-frame"
                            :style="{ transform: imageTransform }"
                        >
                            <img
                                class="couple-image"
                                src="/images/img2.JPG"
                                alt="Couple portrait"
                                loading="lazy"
                                @load="imageLoaded = true"
                            />
                            <div class="image-overlay" aria-hidden="true"></div>
                        </div>

                        <!-- Decorative accent -->
                        <svg
                            class="decorative-accent"
                            viewBox="0 0 200 200"
                            aria-hidden="true"
                        >
                            <defs>
                                <linearGradient
                                    id="accent-gradient"
                                    x1="0%"
                                    y1="0%"
                                    x2="100%"
                                    y2="100%"
                                >
                                    <stop
                                        offset="0%"
                                        style="
                                            stop-color: rgba(
                                                255,
                                                255,
                                                255,
                                                0.15
                                            );
                                        "
                                    />
                                    <stop
                                        offset="100%"
                                        style="
                                            stop-color: rgba(
                                                255,
                                                255,
                                                255,
                                                0.05
                                            );
                                        "
                                    />
                                </linearGradient>
                            </defs>
                            <circle
                                cx="100"
                                cy="100"
                                r="80"
                                fill="none"
                                stroke="url(#accent-gradient)"
                                stroke-width="1"
                                opacity="0.3"
                            />
                            <circle
                                cx="100"
                                cy="100"
                                r="60"
                                fill="none"
                                stroke="url(#accent-gradient)"
                                stroke-width="0.5"
                                opacity="0.2"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
:root {
    --color-primary: #92400e;
    --color-primary-dark: #78350f;
    --color-accent: #f59e0b;
    --color-bg-start: rgba(120, 53, 15, 0.95);
    --color-bg-mid: rgba(146, 64, 14, 0.85);
    --color-bg-end: rgba(194, 65, 12, 0.9);
    --ease-smooth: cubic-bezier(0.4, 0, 0.2, 1);
    --ease-bounce: cubic-bezier(0.68, -0.55, 0.265, 1.55);
}

.interests-section {
    position: relative;
    overflow: hidden;
    min-height: 100vh;
    display: flex;
    align-items: center;
}

/* Background Layer */
.background-layer {
    position: absolute;
    inset: 0;
    z-index: 0;
}

.gradient-base {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        var(--color-bg-start) 0%,
        var(--color-bg-mid) 50%,
        var(--color-bg-end) 100%
    );
}

.decorative-pattern {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    color: white;
    pointer-events: none;
}

/* Content Wrapper */
.content-wrapper {
    position: relative;
    z-index: 10;
    width: 100%;
    max-width: 1440px;
    margin: 0 auto;
    padding: clamp(3rem, 8vw, 5rem) clamp(1rem, 5vw, 5rem);
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: clamp(3rem, 6vw, 5rem);
    align-items: center;
}

@media (min-width: 1024px) {
    .content-grid {
        grid-template-columns: 1.4fr 1fr;
    }
}

/* Categories Container */
.categories-container {
    display: grid;
    grid-template-columns: 1fr;
    gap: clamp(2.5rem, 5vw, 4rem);
    color: white;
}

@media (min-width: 640px) {
    .categories-container {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Category Card */
.category-card {
    position: relative;
    padding: clamp(1.5rem, 3vw, 2rem);
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s var(--ease-smooth);
    transition-delay: var(--delay);
}

.category-card.is-visible {
    opacity: 1;
    transform: translateY(0);
}

.category-full {
    grid-column: 1 / -1;
    text-align: center;
}

.category-glow {
    position: absolute;
    inset: -2px;
    background: radial-gradient(
        circle at center,
        rgba(255, 255, 255, 0.08) 0%,
        transparent 70%
    );
    border-radius: 1rem;
    opacity: 0;
    transition: opacity 0.4s var(--ease-smooth);
    pointer-events: none;
}

.category-card:hover .category-glow {
    opacity: 1;
}

/* Category Title */
.category-title {
    margin: 0 0 clamp(1rem, 2vw, 1.5rem) 0;
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 400;
    letter-spacing: 0.05em;
}

.title-text {
    display: inline-block;
    position: relative;
    transition: transform 0.3s var(--ease-smooth);
}

.category-card:hover .title-text {
    transform: scale(1.05);
}

.title-text::after {
    content: '';
    position: absolute;
    bottom: -0.25rem;
    left: 50%;
    transform: translateX(-50%) scaleX(0);
    width: 80%;
    height: 2px;
    background: linear-gradient(90deg, transparent, currentColor, transparent);
    transition: transform 0.4s var(--ease-smooth);
}

.category-card:hover .title-text::after {
    transform: translateX(-50%) scaleX(1);
}

/* Items List */
.items-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: clamp(0.5rem, 1vw, 0.75rem);
}

.list-item {
    position: relative;
    font-size: clamp(1rem, 2vw, 1.25rem);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    opacity: 0;
    transform: translateX(-20px);
    transition: all 0.5s var(--ease-smooth);
    transition-delay: var(--item-delay);
    cursor: default;
}

.list-item.is-visible {
    opacity: 1;
    transform: translateX(0);
}

.item-text {
    display: inline-block;
    position: relative;
    transition:
        transform 0.3s var(--ease-smooth),
        color 0.3s var(--ease-smooth);
}

.list-item:hover .item-text {
    transform: translateX(4px);
    color: rgba(255, 255, 255, 0.9);
}

.item-underline {
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1px;
    background: linear-gradient(
        90deg,
        var(--color-accent),
        rgba(255, 255, 255, 0.6)
    );
    transition: width 0.4s var(--ease-smooth);
}

.list-item:hover .item-underline {
    width: 100%;
}

/* Image Container */
.image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    perspective: 1000px;
}

.image-wrapper {
    position: relative;
    width: 100%;
    max-width: 28rem;
    opacity: 0;
    transform: scale(0.9);
    transition: all 0.8s var(--ease-smooth);
    transition-delay: 300ms;
}

.image-wrapper.is-visible {
    opacity: 1;
    transform: scale(1);
}

.image-skeleton {
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50% 50% 0 0;
    overflow: hidden;
}

.skeleton-shimmer {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        90deg,
        transparent 0%,
        rgba(255, 255, 255, 0.1) 50%,
        transparent 100%
    );
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

.image-frame {
    position: relative;
    padding: clamp(1rem, 2vw, 1.5rem);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(8px);
    transition: transform 0.3s var(--ease-smooth);
    transform-style: preserve-3d;
}

.couple-image {
    display: block;
    width: 100%;
    aspect-ratio: 0.7;
    object-fit: cover;
    transition: transform 0.5s var(--ease-smooth);
}

.image-wrapper:hover .couple-image {
    transform: scale(1.05);
}

.image-overlay {
    position: absolute;
    inset: clamp(1rem, 2vw, 1.5rem);
    border-radius: 50% 50% 0 0;
    background: linear-gradient(
        180deg,
        transparent 0%,
        rgba(0, 0, 0, 0.2) 100%
    );
    opacity: 0;
    transition: opacity 0.4s var(--ease-smooth);
    pointer-events: none;
}

.image-wrapper:hover .image-overlay {
    opacity: 1;
}

/* Decorative Accent */
.decorative-accent {
    position: absolute;
    top: -20%;
    left: -20%;
    width: 60%;
    height: auto;
    pointer-events: none;
    opacity: 0.4;
    animation: rotate-slow 30s linear infinite;
}

@keyframes rotate-slow {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Focus visible states for accessibility */
.list-item:focus-visible {
    outline: 2px solid var(--color-accent);
    outline-offset: 4px;
    border-radius: 4px;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
