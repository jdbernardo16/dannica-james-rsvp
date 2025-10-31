<template>
    <PublicLayout
        title="RSVP - Wedding Invitation"
        description="Please fill out this form to let us know if you can attend our special day"
        :showHeader="false"
        :showFooter="false"
    >
        <div class="relative z-10 container px-4 py-8 sm:py-10 lg:py-12">
            <div class="mx-auto max-w-4xl">
                <!-- Header -->
                <div class="header mb-8 text-center sm:mb-10 lg:mb-12">
                    <h3 class="title text-3xl font-bold sm:text-4xl">
                        James & Dannica's Wedding
                    </h3>
                    <div class="divider mt-4 mb-3 sm:mt-6 sm:mb-4"></div>
                    <p class="subtitle mt-2 text-lg sm:text-xl">
                        We're so excited to celebrate with you!
                    </p>
                    <p class="mt-2 text-base sm:text-lg">
                        Please fill out this form to let us know if you can
                        attend our special day.
                    </p>
                </div>

                <!-- Progress Bar -->
                <div class="progress-container mb-8 sm:mb-10 lg:mb-12">
                    <div class="progress-bar">
                        <div
                            class="progress-fill"
                            :style="{ width: progressPercentage + '%' }"
                        ></div>
                    </div>
                    <div class="progress-steps">
                        <div
                            v-for="(step, index) in steps"
                            :key="index"
                            class="progress-step"
                            :class="{
                                active: currentStep === index,
                                completed: currentStep > index,
                            }"
                            @click="goToStep(index)"
                        >
                            <div class="progress-dot">
                                <CheckCircle
                                    v-if="currentStep > index"
                                    class="h-3 w-3 sm:h-4 sm:w-4"
                                />
                                <span v-else class="text-xs sm:text-sm">{{
                                    index + 1
                                }}</span>
                            </div>
                            <span class="progress-label text-xs sm:text-sm">
                                {{ step.title }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div
                    class="card border border-gray-200 bg-white p-6 shadow-lg sm:p-8"
                >
                    <form @submit.prevent="handleSubmit">
                        <!-- Step 1: Guest Identification -->
                        <div v-if="currentStep === 0" class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-bold">
                                    Find Your Invitation
                                </h3>
                                <div class="divider mt-4"></div>
                                <p class="mt-4 text-lg">
                                    Please enter your full name as it appears on
                                    your invitation.
                                </p>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <Label
                                        for="guest_name"
                                        class="font-semibold"
                                    >
                                        Full Name
                                    </Label>
                                    <Input
                                        id="guest_name"
                                        v-model="formData.guest_name"
                                        type="text"
                                        placeholder="Enter your full name"
                                        :disabled="isLoading"
                                        @blur="checkGuestName"
                                        required
                                        class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-gray-500 focus:outline-none"
                                        :class="{
                                            'border-red-500': errors.guest_name,
                                            'border-green-500':
                                                guestFound &&
                                                !errors.guest_name,
                                        }"
                                    />
                                    <p
                                        v-if="errors.guest_name"
                                        class="mt-1 text-sm font-medium text-red-600"
                                    >
                                        {{ errors.guest_name }}
                                    </p>
                                </div>

                                <!-- Loading state -->
                                <div
                                    v-if="isLoading"
                                    class="flex items-center justify-center py-4"
                                >
                                    <div
                                        class="h-8 w-8 animate-spin rounded-full border-b-2 border-gray-800"
                                    ></div>
                                    <span class="ml-2 font-medium"
                                        >Searching for your invitation...</span
                                    >
                                </div>

                                <!-- Guest found -->
                                <div
                                    v-if="guestFound && guestData"
                                    class="rounded-lg border-2 border-green-500 bg-green-50 p-4"
                                >
                                    <div class="flex items-start">
                                        <CheckCircle
                                            class="mt-0.5 mr-2 h-5 w-5 text-green-600"
                                        />
                                        <div>
                                            <h3
                                                class="font-semibold text-green-900"
                                            >
                                                Invitation Found!
                                            </h3>
                                            <p
                                                class="mt-1 text-sm text-green-700"
                                            >
                                                Group:
                                                {{ guestData.group?.name }}
                                            </p>
                                            <div
                                                v-if="
                                                    guestData.group_guests &&
                                                    guestData.group_guests
                                                        .length > 0
                                                "
                                                class="mt-2"
                                            >
                                                <p
                                                    class="text-sm font-medium text-green-700"
                                                >
                                                    Guests in your group:
                                                </p>
                                                <ul
                                                    class="ml-2 list-inside list-disc text-sm text-green-700"
                                                >
                                                    <li
                                                        v-for="guest in guestData.group_guests"
                                                        :key="guest"
                                                    >
                                                        {{ guest }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div
                                                v-if="guestData.group?.has_rsvp"
                                                class="mt-2 rounded border border-yellow-300 bg-yellow-100 p-2"
                                            >
                                                <p
                                                    class="text-sm font-medium text-yellow-800"
                                                >
                                                    <AlertCircle
                                                        class="mr-1 inline h-4 w-4"
                                                    />
                                                    This group has already
                                                    submitted an RSVP. Please
                                                    contact the couple if you
                                                    need to make changes.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Guest not found -->
                                <div
                                    v-if="
                                        !guestFound &&
                                        formData.guest_name &&
                                        !isLoading
                                    "
                                    class="rounded-lg border-2 border-red-200 bg-red-50 p-4"
                                >
                                    <div class="flex items-start">
                                        <XCircle
                                            class="mt-0.5 mr-2 h-5 w-5 text-red-600"
                                        />
                                        <div>
                                            <h3
                                                class="font-semibold text-red-900"
                                            >
                                                Invitation Not Found
                                            </h3>
                                            <p
                                                class="mt-1 text-sm text-red-700"
                                            >
                                                We couldn't find your
                                                invitation. Please check the
                                                spelling of your name or contact
                                                the couple for assistance.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Attendance Confirmation -->
                        <div v-if="currentStep === 1" class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-bold">
                                    Will You Be Attending?
                                </h3>
                                <div class="divider mt-4"></div>
                                <p class="mt-4 text-lg">
                                    Let us know how many people from your group
                                    will be attending the wedding.
                                </p>
                            </div>

                            <div
                                v-if="guestData"
                                class="mb-6 rounded-lg border-2 border-gray-300 bg-gray-50 p-4"
                            >
                                <p class="font-semibold">
                                    Group: {{ guestData.group?.name }}
                                </p>
                                <p class="text-sm">
                                    Maximum attendees:
                                    {{ guestData.group?.max_attendees }}
                                </p>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <Label
                                        for="attending_count"
                                        class="font-semibold"
                                    >
                                        Number of Attendees
                                    </Label>
                                    <div
                                        class="mt-4 flex items-center justify-center space-x-4 sm:space-x-6"
                                    >
                                        <button
                                            type="button"
                                            class="rounded-full bg-gray-200 p-3 transition-colors hover:bg-gray-300 disabled:bg-gray-100 disabled:text-gray-400"
                                            @click="decrementAttendees"
                                            :disabled="
                                                formData.attending_count <= 0
                                            "
                                        >
                                            <Minus
                                                class="h-4 w-4 sm:h-5 sm:w-5"
                                            />
                                        </button>
                                        <div
                                            class="w-16 text-center text-2xl font-bold sm:w-20 sm:text-3xl"
                                        >
                                            {{ formData.attending_count }}
                                        </div>
                                        <button
                                            type="button"
                                            class="rounded-full bg-gray-200 p-3 transition-colors hover:bg-gray-300 disabled:bg-gray-100 disabled:text-gray-400"
                                            @click="incrementAttendees"
                                            :disabled="
                                                formData.attending_count >=
                                                (guestData?.group
                                                    ?.max_attendees || 0)
                                            "
                                        >
                                            <Plus
                                                class="h-4 w-4 sm:h-5 sm:w-5"
                                            />
                                        </button>
                                    </div>
                                    <p
                                        class="mt-4 text-center text-base sm:text-lg"
                                    >
                                        {{
                                            formData.attending_count === 0
                                                ? "We're sorry you can't make it. We'll miss you!"
                                                : `Great! We're excited to celebrate with ${formData.attending_count} ${formData.attending_count === 1 ? 'person' : 'people'}.`
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Message to Couple -->
                        <div v-if="currentStep === 2" class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-bold">
                                    Message to the Couple
                                </h3>
                                <div class="divider mt-4"></div>
                                <p class="mt-4 text-lg">
                                    Share a special message or well wishes with
                                    us (optional).
                                </p>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <Label for="message" class="font-semibold">
                                        Your Message
                                    </Label>
                                    <Textarea
                                        id="message"
                                        v-model="formData.message"
                                        placeholder="Write your message here..."
                                        rows="5"
                                        maxlength="1000"
                                        class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-gray-500 focus:outline-none"
                                    />
                                    <p class="mt-1 text-sm">
                                        {{ formData.message?.length || 0 }}/1000
                                        characters
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Song Suggestion -->
                        <div v-if="currentStep === 3" class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-bold">
                                    Song Suggestion
                                </h3>
                                <div class="divider mt-4"></div>
                                <p class="mt-4 text-lg">
                                    Help us create the perfect playlist! Suggest
                                    a song that would make you want to dance
                                    (optional).
                                </p>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <Label
                                        for="song_suggestion"
                                        class="font-semibold"
                                    >
                                        Song Title & Artist
                                    </Label>
                                    <Input
                                        id="song_suggestion"
                                        v-model="formData.song_suggestion"
                                        type="text"
                                        placeholder="e.g., 'Perfect - Ed Sheeran'"
                                        maxlength="255"
                                        class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-gray-500 focus:outline-none"
                                    />
                                    <p class="mt-1 text-sm">
                                        {{
                                            formData.song_suggestion?.length ||
                                            0
                                        }}/255 characters
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Email Address -->
                        <div v-if="currentStep === 4" class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-bold">
                                    Email Address
                                </h3>
                                <div class="divider mt-4"></div>
                                <p class="mt-4 text-lg">
                                    Provide your email address for confirmation
                                    and updates about the wedding.
                                </p>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <Label for="email" class="font-semibold">
                                        Email Address
                                    </Label>
                                    <Input
                                        id="email"
                                        v-model="formData.email"
                                        type="email"
                                        placeholder="your.email@example.com"
                                        required
                                        class="mt-2 w-full rounded-md border border-gray-300 px-3 py-2 focus:ring-2 focus:ring-gray-500 focus:outline-none"
                                        :class="{
                                            'border-red-500': errors.email,
                                            'border-green-500':
                                                formData.email && !errors.email,
                                        }"
                                    />
                                    <p
                                        v-if="errors.email"
                                        class="mt-1 text-sm font-medium text-red-600"
                                    >
                                        {{ errors.email }}
                                    </p>
                                    <p class="mt-1 text-sm">
                                        We'll use this to send you a
                                        confirmation and any important updates.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Step 6: Confirmation -->
                        <div v-if="currentStep === 5" class="space-y-6">
                            <div>
                                <h3 class="text-2xl font-bold">
                                    Review Your RSVP
                                </h3>
                                <div class="divider mt-4"></div>
                                <p class="mt-4 text-lg">
                                    Please review your information before
                                    submitting.
                                </p>
                            </div>

                            <div
                                class="space-y-6 rounded-lg border-2 border-gray-200 bg-gray-50 p-6"
                            >
                                <div>
                                    <h3 class="text-xl font-semibold">
                                        Guest Information
                                    </h3>
                                    <p class="mt-2 text-lg">
                                        {{ formData.guest_name }}
                                    </p>
                                    <p v-if="guestData" class="mt-1 text-sm">
                                        Group:
                                        {{ guestData.group?.name }}
                                    </p>
                                </div>

                                <div class="divider"></div>

                                <div>
                                    <h3 class="text-xl font-semibold">
                                        Attendance
                                    </h3>
                                    <p class="mt-2 text-lg">
                                        {{ formData.attending_count }}
                                        {{
                                            formData.attending_count === 1
                                                ? 'person'
                                                : 'people'
                                        }}
                                        attending
                                    </p>
                                </div>

                                <div
                                    v-if="formData.message"
                                    class="divider"
                                ></div>

                                <div v-if="formData.message">
                                    <h3 class="text-xl font-semibold">
                                        Message
                                    </h3>
                                    <p class="mt-2 text-lg whitespace-pre-wrap">
                                        {{ formData.message }}
                                    </p>
                                </div>

                                <div
                                    v-if="formData.song_suggestion"
                                    class="divider"
                                ></div>

                                <div v-if="formData.song_suggestion">
                                    <h3 class="text-xl font-semibold">
                                        Song Suggestion
                                    </h3>
                                    <p class="mt-2 text-lg">
                                        {{ formData.song_suggestion }}
                                    </p>
                                </div>

                                <div class="divider"></div>

                                <div>
                                    <h3 class="text-xl font-semibold">Email</h3>
                                    <p class="mt-2 text-lg">
                                        {{ formData.email }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="rounded-lg border-2 border-green-500 bg-green-50 p-4"
                            >
                                <div class="flex items-start">
                                    <CheckCircle
                                        class="mt-0.5 mr-2 h-5 w-5 text-green-600"
                                    />
                                    <div>
                                        <h3
                                            class="font-semibold text-green-900"
                                        >
                                            Ready to Submit
                                        </h3>
                                        <p class="mt-1 text-sm text-green-700">
                                            Click the submit button below to
                                            complete your RSVP. You'll receive a
                                            confirmation email shortly.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div
                            class="mt-6 flex flex-col justify-between gap-4 sm:mt-8 sm:flex-row sm:gap-0"
                        >
                            <button
                                type="button"
                                class="order-2 flex items-center justify-center rounded-lg bg-gray-200 px-4 py-2 transition-colors hover:bg-gray-300 disabled:bg-gray-100 disabled:text-gray-400 sm:order-1"
                                @click="previousStep"
                                :disabled="currentStep === 0 || isSubmitting"
                            >
                                <ArrowLeft class="mr-2 h-4 w-4" />
                                <span class="text-sm sm:text-base"
                                    >Previous</span
                                >
                            </button>

                            <button
                                v-if="currentStep < 5"
                                type="button"
                                class="order-1 flex items-center justify-center rounded-lg bg-gray-800 px-4 py-2 text-white transition-colors hover:bg-gray-700 disabled:bg-gray-300 disabled:text-gray-500 sm:order-2"
                                @click="nextStep"
                                :disabled="!canProceed || isSubmitting"
                            >
                                <span class="text-sm sm:text-base">Next</span>
                                <ArrowRight class="ml-2 h-4 w-4" />
                            </button>

                            <button
                                v-if="currentStep === 5"
                                type="submit"
                                class="order-1 flex items-center justify-center rounded-lg bg-gray-800 px-4 py-2 text-white transition-colors hover:bg-gray-700 disabled:bg-gray-300 disabled:text-gray-500 sm:order-2"
                                :disabled="isSubmitting || !canSubmit"
                            >
                                <div
                                    v-if="isSubmitting"
                                    class="mr-2 h-4 w-4 animate-spin rounded-full border-b-2 border-white"
                                ></div>
                                {{
                                    isSubmitting
                                        ? 'Submitting...'
                                        : 'Submit RSVP'
                                }}
                                <Send class="ml-2 h-4 w-4" />
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>

<style scoped>
/* Simple black and white styles */
.container {
    font-family:
        system-ui,
        -apple-system,
        sans-serif;
    color: #1f2937;
}

.title {
    color: #111827;
}

.subtitle {
    color: #374151;
    font-weight: 500;
}

.divider {
    height: 1px;
    background: #e5e7eb;
    width: 100%;
    max-width: 200px;
    margin: 0 auto;
}

/* Progress Bar Styles */
.progress-container {
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background: #e5e7eb;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 1rem;
    position: relative;
}

.progress-fill {
    height: 100%;
    background: #374151;
    border-radius: 4px;
    transition: width 0.3s ease;
}

.progress-steps {
    display: flex;
    justify-content: space-between;
    position: relative;
}

.progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
}

.progress-step.completed {
    cursor: pointer;
}

.progress-step:not(.completed):not(.active) {
    cursor: not-allowed;
    opacity: 0.6;
}

.progress-dot {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: white;
    border: 2px solid #d1d5db;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6b7280;
    font-weight: 600;
    margin-bottom: 0.5rem;
    transition: all 0.2s ease;
    position: relative;
    z-index: 2;
}

.progress-step.active .progress-dot {
    background: #374151;
    border-color: #374151;
    color: white;
}

.progress-step.completed .progress-dot {
    background: #374151;
    border-color: #374151;
    color: white;
}

.progress-label {
    font-size: 0.75rem;
    font-weight: 500;
    color: #6b7280;
    text-align: center;
    max-width: 80px;
    line-height: 1.2;
}

.progress-step.active .progress-label {
    color: #374151;
    font-weight: 600;
}

.progress-step.completed .progress-label {
    color: #374151;
    font-weight: 600;
}

/* Mobile-specific adjustments */
@media (max-width: 639px) {
    .progress-dot {
        width: 28px;
        height: 28px;
    }

    .progress-label {
        font-size: 0.7rem;
        max-width: 60px;
    }
}

/* Tablet-specific adjustments */
@media (min-width: 640px) and (max-width: 1023px) {
    .progress-dot {
        width: 30px;
        height: 30px;
    }

    .progress-label {
        font-size: 0.725rem;
        max-width: 70px;
    }
}

/* Small mobile adjustments */
@media (max-width: 374px) {
    .progress-dot {
        width: 24px;
        height: 24px;
    }

    .progress-label {
        font-size: 0.65rem;
        max-width: 50px;
    }
}

/* Card styles */
.card {
    background: white;
    border-radius: 8px;
}

/* Form input focus styles */
input:focus,
textarea:focus {
    outline: none;
    box-shadow: 0 0 0 2px #374151;
}

/* Button hover states */
button:hover:not(:disabled) {
    transform: translateY(-1px);
}

button:disabled {
    cursor: not-allowed;
}
</style>

<script setup lang="ts">
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Textarea } from '@/components/ui/textarea';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';
import {
    AlertCircle,
    ArrowLeft,
    ArrowRight,
    CheckCircle,
    Minus,
    Plus,
    Send,
    XCircle,
} from 'lucide-vue-next';
import { computed, ref, watch } from 'vue';

interface GuestData {
    found: boolean;
    guest?: {
        id: number;
        full_name: string;
        email: string;
    };
    group?: {
        id: number;
        name: string;
        max_attendees: number;
        has_rsvp: boolean;
    };
    group_guests?: string[];
    message?: string;
}

interface FormData {
    guest_name: string;
    attending_count: number;
    message: string;
    song_suggestion: string;
    email: string;
}

const steps = [
    { title: 'Find Invitation' },
    { title: 'Attendance' },
    { title: 'Message' },
    { title: 'Song' },
    { title: 'Email' },
    { title: 'Review' },
];

const currentStep = ref(0);
const isLoading = ref(false);
const isSubmitting = ref(false);
const guestFound = ref(false);
const guestData = ref<GuestData | null>(null);
const errors = ref<Record<string, string>>({});

const formData = ref<FormData>({
    guest_name: '',
    attending_count: 0,
    message: '',
    song_suggestion: '',
    email: '',
});

// Watch for changes in guest name to reset guest found status
watch(
    () => formData.value.guest_name,
    () => {
        if (formData.value.guest_name === '') {
            guestFound.value = false;
            guestData.value = null;
            errors.value.guest_name = '';
        }
    },
);

const canProceed = computed(() => {
    switch (currentStep.value) {
        case 0:
            return (
                guestFound.value &&
                guestData.value &&
                !guestData.value.group?.has_rsvp
            );
        case 1:
            return true; // Any number of attendees is valid (including 0)
        case 2:
            return true; // Message is optional
        case 3:
            return true; // Song suggestion is optional
        case 4:
            return formData.value.email && isValidEmail(formData.value.email);
        case 5:
            return true; // Review step - all data is ready for submission
        default:
            return false;
    }
});

const canSubmit = computed(() => {
    return canProceed.value && guestFound.value && guestData.value;
});

const progressPercentage = computed(() => {
    return ((currentStep.value + 1) / steps.length) * 100;
});

const goToStep = (stepIndex: number) => {
    if (stepIndex <= currentStep.value) {
        currentStep.value = stepIndex;
    }
};

const isValidEmail = (email: string): boolean => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
};

const checkGuestName = async () => {
    if (!formData.value.guest_name.trim()) {
        errors.value.guest_name = 'Please enter your full name';
        return;
    }

    isLoading.value = true;
    errors.value.guest_name = '';

    try {
        const response = await axios.post('/rsvp/check-guest', {
            name: formData.value.guest_name,
        });

        if (response.data.found) {
            guestFound.value = true;
            guestData.value = response.data;

            if (response.data.group?.has_rsvp) {
                errors.value.guest_name =
                    'This group has already submitted an RSVP. Please contact couple if you need to make changes.';
            }
        } else {
            guestFound.value = false;
            guestData.value = null;
            errors.value.guest_name =
                response.data.message || 'Guest not found';
        }
    } catch (error) {
        console.error('Error checking guest:', error);
        errors.value.guest_name =
            'An error occurred while checking your name. Please try again.';
        guestFound.value = false;
        guestData.value = null;
    } finally {
        isLoading.value = false;
    }
};

const incrementAttendees = () => {
    const max = guestData.value?.group?.max_attendees || 0;
    if (formData.value.attending_count < max) {
        formData.value.attending_count++;
    }
};

const decrementAttendees = () => {
    if (formData.value.attending_count > 0) {
        formData.value.attending_count--;
    }
};

const nextStep = () => {
    if (canProceed.value) {
        currentStep.value++;
    }
};

const previousStep = () => {
    if (currentStep.value > 0) {
        currentStep.value--;
    }
};

const handleSubmit = () => {
    if (!canSubmit.value) return;

    isSubmitting.value = true;
    errors.value = {};

    const submitData = {
        group_name: guestData.value?.group?.name,
        guest_names: guestData.value?.group_guests || [
            formData.value.guest_name,
        ],
        email: formData.value.email,
        attending_count: formData.value.attending_count,
        message: formData.value.message,
        song_suggestion: formData.value.song_suggestion,
    };

    router.post('/rsvp/store', submitData, {
        onSuccess: () => {
            // Redirect will happen automatically
        },
        onError: (errorResponse) => {
            if (typeof errorResponse === 'object' && errorResponse !== null) {
                errors.value = Object.fromEntries(
                    Object.entries(errorResponse).map(([key, value]) => [
                        key,
                        String(value),
                    ]),
                );
            }
            currentStep.value = 0; // Go back to first step on error
        },
        onFinish: () => {
            isSubmitting.value = false;
        },
    });
};
</script>
