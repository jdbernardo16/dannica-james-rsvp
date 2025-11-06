<script lang="ts" setup>
import AttireSection from '@/components/wedding/home/AttireSection.vue';
import CoupleDetails from '@/components/wedding/home/CoupleDetails.vue';
import EntourageFrame from '@/components/wedding/home/EntourageFrame.vue';
import EventTimeline from '@/components/wedding/home/EventTimeline.vue';
import GeneralTextImage from '@/components/wedding/home/GeneralTextImage.vue';
import HeroSection from '@/components/wedding/home/HeroSection.vue';
import LocationFrame from '@/components/wedding/home/LocationFrame.vue';
import OurStory from '@/components/wedding/home/OurStory.vue';
import RsvpSection from '@/components/wedding/home/RsvpSection.vue';
import SaveTheDate from '@/components/wedding/home/SaveTheDate.vue';
import VideoSection from '@/components/wedding/home/VideoSection.vue';
import WeddingLayout from '@/layouts/WeddingLayout.vue';
</script>
<template>
    <WeddingLayout
        title="James & Dannica"
        description="Mark your calendars for our special day as we celebrate love and new beginnings. Two souls with but a single thought, two hearts that beat as one. Villaluz - Tejada Nuptial"
        keywords="wedding, James, Dannica, Villaluz, Tejada, marriage, celebration, RSVP, wedding ceremony, wedding reception, love story, wedding vows, nuptial"
        wedding-date="2025-12-12T15:00:00+08:00"
        wedding-location="San Agustin Church & La Castellana, Manila, Philippines"
        image-url="/images/meta-image.png"
    >
        <HeroSection />

        <SaveTheDate />

        <VideoSection />

        <OurStory />

        <CoupleDetails />

        <GeneralTextImage />

        <EventTimeline />

        <LocationFrame />

        <AttireSection />

        <EntourageFrame />

        <RsvpSection />
    </WeddingLayout>
</template>
