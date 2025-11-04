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
</script>
<template>
    <WeddingLayout>
        <HeroSection />

        <SaveTheDate />

        <VideoSection />

        <OurStory />

        <!-- <CoupleDetails /> -->

        <GeneralTextImage />

        <EventTimeline />

        <LocationFrame />

        <AttireSection />

        <GiftGuide />

        <EntourageFrame />

        <RsvpSection />
    </WeddingLayout>
</template>
