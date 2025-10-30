# Wedding Theme CSS Usage Guide

This guide explains how to use the wedding-themed CSS foundation that extends the existing Tailwind setup with elegant color schemes, typography, and utility classes.

## Table of Contents

1. [Color Palette](#color-palette)
2. [Typography](#typography)
3. [Utility Classes](#utility-classes)
4. [Component Classes](#component-classes)
5. [Buttons](#buttons)
6. [Cards](#cards)
7. [Form Elements](#form-elements)
8. [Decorative Elements](#decorative-elements)
9. [Animations](#animations)
10. [Responsive Design](#responsive-design)

## Color Palette

The wedding theme includes a carefully curated color palette:

### Primary Colors

- **Ivory** (`#FFFFF0`) - Primary background color
- **Blush Pink** (`#E8B4B8`) - Secondary accent color
- **Gold** (`#D4AF37`) - Accent and highlight color
- **Navy** (`#1E3A5F`) - Primary text and heading color

### Color Variations

- Light Ivory: `#F5F5E6`
- Light Blush: `#F4D1D1`
- Dark Blush: `#D6989C`
- Light Gold: `#FFD700`
- Medium Gold: `#B8860B`
- Dark Gold: `#9B7E0F`
- Light Navy: `#2E4A6F`
- Lighter Navy: `#3E5A7F`

### Usage Examples

```html
<!-- Background colors -->
<div class="wedding-ivory-bg">Ivory background</div>
<div class="wedding-blush-bg">Blush background</div>
<div class="wedding-gold-bg">Gold background</div>
<div class="wedding-navy-bg">Navy background</div>

<!-- Text colors -->
<p class="wedding-ivory">Ivory text</p>
<p class="wedding-blush">Blush text</p>
<p class="wedding-gold">Gold text</p>
<p class="wedding-navy">Navy text</p>
```

## Typography

The wedding theme includes three Google Fonts:

### Font Families

- **Playfair Display** - Elegant headings
- **Source Sans Pro** - Clean body text
- **Dancing Script** - Decorative accent text

### Font Classes

```html
<!-- Font families -->
<h1 class="font-wedding-heading">Elegant Heading</h1>
<p class="font-wedding-body">Clean body text</p>
<span class="font-wedding-accent">Decorative text</span>

<!-- Text sizes -->
<p class="text-wedding-xs">Extra small text</p>
<p class="text-wedding-sm">Small text</p>
<p class="text-wedding-base">Base text</p>
<p class="text-wedding-lg">Large text</p>
<p class="text-wedding-xl">Extra large text</p>
<p class="text-wedding-2xl">2XL text</p>
<p class="text-wedding-3xl">3XL text</p>
<p class="text-wedding-4xl">4XL text</p>
<p class="text-wedding-5xl">5XL text</p>

<!-- Font weights -->
<span class="font-wedding-light">Light</span>
<span class="font-wedding-normal">Normal</span>
<span class="font-wedding-medium">Medium</span>
<span class="font-wedding-semibold">Semibold</span>
<span class="font-wedding-bold">Bold</span>
<span class="font-wedding-extrabold">Extra Bold</span>
<span class="font-wedding-black">Black</span>
```

## Utility Classes

### Shadows

```html
<div class="shadow-wedding-sm">Small shadow</div>
<div class="shadow-wedding">Regular shadow</div>
<div class="shadow-wedding-md">Medium shadow</div>
<div class="shadow-wedding-lg">Large shadow</div>
<div class="shadow-wedding-xl">Extra large shadow</div>
<div class="shadow-wedding-soft">Soft shadow</div>
<div class="shadow-wedding-gold">Gold shadow</div>
```

### Gradients

```html
<div class="bg-wedding-gradient-ivory">Ivory gradient</div>
<div class="bg-wedding-gradient-blush">Blush gradient</div>
<div class="bg-wedding-gradient-gold">Gold gradient</div>
<div class="bg-wedding-gradient-navy">Navy gradient</div>
<div class="bg-wedding-gradient-subtle">Subtle gradient</div>
```

### Borders

```html
<div class="border-wedding">Standard border</div>
<div class="border-wedding-gold">Gold border</div>
<div class="border-wedding-navy">Navy border</div>
<div class="border-wedding-2">2px border</div>
<div class="border-wedding-4">4px border</div>
<div class="border-wedding-8">8px border</div>
```

### Border Radius

```html
<div class="rounded-wedding-sm">Small radius</div>
<div class="rounded-wedding">Regular radius</div>
<div class="rounded-wedding-md">Medium radius</div>
<div class="rounded-wedding-lg">Large radius</div>
<div class="rounded-wedding-xl">Extra large radius</div>
<div class="rounded-wedding-2xl">2XL radius</div>
<div class="rounded-wedding-full">Full radius</div>
```

## Component Classes

### Wedding Container

```html
<div class="wedding-container">
    <!-- Content with max-width and centered -->
</div>
```

### Wedding Section

```html
<section class="wedding-section">
    <!-- Section with padding -->
</section>
```

### Wedding Header

```html
<header class="wedding-header">
    <h1 class="wedding-title">Wedding Title</h1>
    <p class="wedding-subtitle">Beautiful Subtitle</p>
</header>
```

### Wedding Navigation

```html
<nav class="wedding-nav">
    <!-- Navigation with blur background -->
</nav>
```

### Wedding Footer

```html
<footer class="wedding-footer">
    <!-- Footer with navy gradient background -->
</footer>
```

### Wedding Hero Section

```html
<section class="wedding-hero">
    <div class="wedding-hero-content">
        <h1 class="wedding-title">Welcome to Our Wedding</h1>
        <p class="wedding-subtitle">Join us in celebration</p>
    </div>
</section>
```

## Buttons

### Primary Button

```html
<button class="btn-wedding-primary">RSVP Now</button>
```

### Secondary Button

```html
<button class="btn-wedding-secondary">Learn More</button>
```

### Accent Button

```html
<button class="btn-wedding-accent">View Gallery</button>
```

## Cards

### Standard Wedding Card

```html
<div class="card-wedding">
    <h3 class="font-wedding-heading text-wedding-2xl">Card Title</h3>
    <p class="text-wedding-lg mt-2">
        Card content goes here with elegant styling.
    </p>
</div>
```

### Elegant Wedding Card

```html
<div class="card-wedding-elegant">
    <h3 class="font-wedding-heading text-wedding-2xl">Elegant Card</h3>
    <p class="text-wedding-lg mt-2">
        Premium card with gold accents and elegant styling.
    </p>
</div>
```

## Form Elements

### Wedding Input

```html
<input type="text" class="input-wedding" placeholder="Your Name" />
<input type="email" class="input-wedding" placeholder="Email Address" />
<textarea class="input-wedding" placeholder="Your Message"></textarea>
```

## Decorative Elements

### Dividers

```html
<div class="wedding-divider"></div>
<div class="wedding-divider-thick"></div>
<div class="wedding-divider-blush"></div>
```

### Corner Accents

```html
<div class="wedding-corner-accent border-wedding p-8">
    Content with decorative corner accents
</div>
```

### Accent Text

```html
<p class="wedding-accent-text">Special accent text in script font</p>
```

## Animations

### Fade In

```html
<div class="animate-fade-in">Content that fades in</div>
```

### Slide Up

```html
<div class="animate-slide-up">Content that slides up</div>
```

### Slide Down

```html
<div class="animate-slide-down">Content that slides down</div>
```

### Gold Shimmer

```html
<div class="animate-gold-shimmer bg-wedding-gradient-gold">
    Content with gold shimmer effect
</div>
```

## Responsive Design

The wedding theme includes responsive typography that automatically adjusts based on screen size:

- **Mobile (< 640px)**: Smaller font sizes for better readability
- **Tablet (640px - 1024px)**: Medium font sizes
- **Desktop (> 1024px)**: Larger font sizes for impact

### Example Responsive Usage

```html
<div class="wedding-theme">
    <h1 class="wedding-title">This heading will resize automatically</h1>
    <p class="text-wedding-lg">This paragraph will also adjust</p>
</div>
```

## Complete Page Example

Here's a complete example of how to use the wedding theme for a page:

```html
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Wedding RSVP</title>
    </head>
    <body class="wedding-theme">
        <!-- Navigation -->
        <nav class="wedding-nav">
            <div class="wedding-container">
                <div class="flex items-center justify-between">
                    <h2 class="font-wedding-accent text-wedding-xl">
                        Dannica & James
                    </h2>
                    <div class="space-x-6">
                        <a
                            href="#"
                            class="wedding-navy hover:wedding-gold transition-colors"
                            >Home</a
                        >
                        <a
                            href="#"
                            class="wedding-navy hover:wedding-gold transition-colors"
                            >RSVP</a
                        >
                        <a
                            href="#"
                            class="wedding-navy hover:wedding-gold transition-colors"
                            >Gallery</a
                        >
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="wedding-hero">
            <div class="wedding-hero-content">
                <div class="wedding-container">
                    <h1 class="wedding-title animate-fade-in">
                        We're Getting Married!
                    </h1>
                    <p class="wedding-subtitle animate-slide-up">
                        Join us in celebrating our love
                    </p>
                    <button class="btn-wedding-accent animate-slide-down mt-8">
                        RSVP Now
                    </button>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main class="wedding-section">
            <div class="wedding-container">
                <div class="grid gap-8 md:grid-cols-2">
                    <div class="card-wedding animate-slide-up">
                        <h3
                            class="font-wedding-heading text-wedding-2xl wedding-navy"
                        >
                            Event Details
                        </h3>
                        <div class="wedding-divider my-4"></div>
                        <p class="text-wedding-lg">
                            Join us for a beautiful ceremony and reception.
                        </p>
                        <p class="wedding-accent-text mt-4">June 15, 2024</p>
                    </div>

                    <div
                        class="card-wedding-elegant animate-slide-up"
                        style="animation-delay: 0.2s"
                    >
                        <h3
                            class="font-wedding-heading text-wedding-2xl wedding-navy"
                        >
                            RSVP
                        </h3>
                        <div class="wedding-divider-thick my-4"></div>
                        <form class="space-y-4">
                            <input
                                type="text"
                                class="input-wedding w-full"
                                placeholder="Your Name"
                            />
                            <input
                                type="email"
                                class="input-wedding w-full"
                                placeholder="Email Address"
                            />
                            <button
                                type="submit"
                                class="btn-wedding-primary w-full"
                            >
                                Submit RSVP
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="wedding-footer">
            <div class="wedding-container text-center">
                <p class="wedding-accent-text text-wedding-xl mb-4">
                    Dannica & James
                </p>
                <p class="wedding-ivory">Forever begins with us</p>
            </div>
        </footer>
    </body>
</html>
```

## Integration with Existing Components

To apply the wedding theme to existing Vue components, add the `wedding-theme` class to the root element:

```vue
<template>
    <div class="wedding-theme">
        <!-- Your existing component content -->
        <PublicLayout>
            <!-- Content will inherit wedding theme styles -->
        </PublicLayout>
    </div>
</template>
```

## CSS Variables

The wedding theme uses CSS variables that can be customized:

```css
:root {
    --wedding-ivory: #fffff0;
    --wedding-blush: #e8b4b8;
    --wedding-gold: #d4af37;
    --wedding-navy: #1e3a5f;
    /* ... other variables */
}
```

You can override these variables in your own CSS to customize the theme:

```css
:root {
    --wedding-gold: #c9a227; /* Custom gold color */
    --wedding-blush: #e6a0a4; /* Custom blush color */
}
```

## Best Practices

1. **Use semantic class names**: Prefer `wedding-theme` on the root element for consistent styling
2. **Combine with Tailwind**: Wedding theme classes work alongside existing Tailwind utilities
3. **Responsive design**: Use responsive prefixes with wedding theme classes (`md:text-wedding-xl`)
4. **Performance**: The theme is optimized with CSS layers for efficient rendering
5. **Accessibility**: All colors meet WCAG contrast requirements for readability

## Troubleshooting

### Styles Not Applying

- Ensure the wedding theme CSS is imported in `app.css`
- Add the `wedding-theme` class to your root element
- Check that Vite is running and has compiled the styles

### Font Issues

- Google Fonts are automatically imported, but check network connection
- Ensure font-family classes are applied correctly

### Responsive Issues

- Wedding theme typography is responsive by default
- Use responsive prefixes for custom breakpoints (`sm:`, `md:`, `lg:`, `xl:`)
