<script lang="ts" setup>
import AttireSection from '@/components/wedding/home/AttireSection.vue';
import EntourageFrame from '@/components/wedding/home/EntourageFrame.vue';
import EventTimeline from '@/components/wedding/home/EventTimeline.vue';
import GeneralTextImage from '@/components/wedding/home/GeneralTextImage.vue';
import GiftGuide from '@/components/wedding/home/GiftGuide.vue';
import HeroSection from '@/components/wedding/home/HeroSection.vue';
import LocationFrame from '@/components/wedding/home/LocationFrame.vue';
import OurStory from '@/components/wedding/home/OurStory.vue';
import RsvpSection from '@/components/wedding/home/RsvpSection.vue';
import SaveTheDate from '@/components/wedding/home/SaveTheDate.vue';
import VideoSection from '@/components/wedding/home/VideoSection.vue';
import WeddingLayout from '@/layouts/WeddingLayout.vue';

// SEO-optimized props for the wedding website
const seoProps = {
    title: 'Dannica & James - Wedding Celebration | RSVP & Event Details',
    description:
        'Join Dannica and James on their special wedding day. Find complete event details, timeline, venue information, dress code, gift registry, and RSVP form. Celebrate love with us!',
    keywords:
        'Dannica James wedding, wedding RSVP, wedding celebration, marriage ceremony, wedding reception, love story, wedding vows, wedding venue, wedding gifts, entourage, wedding timeline',
    author: 'Dannica & James',
    imageUrl: '/images/banner.webp',
    url: '/',
    weddingDate: '2025-12-12',
    weddingLocation: 'Manila, Philippines',
};
</script>
<template>
    <WeddingLayout v-bind="seoProps">
        <!-- Hero Section with main wedding announcement -->
        <section id="hero" aria-labelledby="hero-heading">
            <HeroSection />
        </section>

        <!-- Save the Date announcement -->
        <section id="save-the-date" aria-labelledby="save-date-heading">
            <SaveTheDate />
        </section>

        <!-- Wedding Video Section -->
        <section id="video" aria-labelledby="video-heading">
            <VideoSection />
        </section>

        <!-- Our Love Story -->
        <section id="story" aria-labelledby="story-heading">
            <OurStory />
        </section>

        <!-- General Content with Images -->
        <section id="gallery" aria-labelledby="gallery-heading">
            <GeneralTextImage />
        </section>

        <!-- Wedding Event Timeline -->
        <section id="schedule" aria-labelledby="schedule-heading">
            <EventTimeline />
        </section>

        <!-- Wedding Location Information -->
        <section id="location" aria-labelledby="location-heading">
            <LocationFrame />
        </section>

        <!-- Wedding Attire Guidelines -->
        <section id="attire" aria-labelledby="attire-heading">
            <AttireSection />
        </section>

        <!-- Gift Registry Information -->
        <section id="gifts" aria-labelledby="gifts-heading">
            <GiftGuide />
        </section>

        <!-- Wedding Entourage -->
        <section id="entourage" aria-labelledby="entourage-heading">
            <EntourageFrame />
        </section>

        <!-- RSVP Form Section -->
        <section id="rsvp" aria-labelledby="rsvp-heading">
            <RsvpSection />
        </section>
    </WeddingLayout>
</template>
