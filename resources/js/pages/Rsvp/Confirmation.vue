<template>
    <PublicLayout
        title="RSVP Confirmation - Wedding Invitation"
        description="Thank you for your RSVP! We're so excited to celebrate with you."
        :showHeader="false"
        :showFooter="false"
    >
        <!-- Decorative Floral Corners with Enhanced Animations -->
        <div
            class="wedding-animate-fade-in-down wedding-mobile-hidden wedding-tablet-block wedding-desktop-block pointer-events-none fixed top-0 left-0 h-24 w-24 opacity-20 sm:h-32 sm:w-32"
            style="animation-delay: 0.2s"
        >
            <svg
                viewBox="0 0 100 100"
                class="text-wedding-gold wedding-animate-heartbeat h-full w-full"
            >
                <path
                    d="M20,50 Q30,30 50,20 Q70,30 80,50 Q70,70 50,80 Q30,70 20,50"
                    fill="currentColor"
                />
                <circle cx="50" cy="50" r="5" fill="var(--wedding-blush)" />
            </svg>
        </div>
        <div
            class="wedding-animate-fade-in-down wedding-mobile-hidden wedding-tablet-block wedding-desktop-block pointer-events-none fixed top-0 right-0 h-24 w-24 rotate-90 opacity-20 sm:h-32 sm:w-32"
            style="animation-delay: 0.4s"
        >
            <svg
                viewBox="0 0 100 100"
                class="text-wedding-gold wedding-animate-heartbeat h-full w-full"
            >
                <path
                    d="M20,50 Q30,30 50,20 Q70,30 80,50 Q70,70 50,80 Q30,70 20,50"
                    fill="currentColor"
                />
                <circle cx="50" cy="50" r="5" fill="var(--wedding-blush)" />
            </svg>
        </div>
        <div
            class="wedding-animate-fade-in-up wedding-mobile-hidden wedding-tablet-block wedding-desktop-block pointer-events-none fixed bottom-0 left-0 h-24 w-24 -rotate-90 opacity-20 sm:h-32 sm:w-32"
            style="animation-delay: 0.6s"
        >
            <svg
                viewBox="0 0 100 100"
                class="text-wedding-gold wedding-animate-heartbeat h-full w-full"
            >
                <path
                    d="M20,50 Q30,30 50,20 Q70,30 80,50 Q70,70 50,80 Q30,70 20,50"
                    fill="currentColor"
                />
                <circle cx="50" cy="50" r="5" fill="var(--wedding-blush)" />
            </svg>
        </div>
        <div
            class="wedding-animate-fade-in-up wedding-mobile-hidden wedding-tablet-block wedding-desktop-block pointer-events-none fixed right-0 bottom-0 h-24 w-24 rotate-180 opacity-20 sm:h-32 sm:w-32"
            style="animation-delay: 0.8s"
        >
            <svg
                viewBox="0 0 100 100"
                class="text-wedding-gold wedding-animate-heartbeat h-full w-full"
            >
                <path
                    d="M20,50 Q30,30 50,20 Q70,30 80,50 Q70,70 50,80 Q30,70 20,50"
                    fill="currentColor"
                />
                <circle cx="50" cy="50" r="5" fill="var(--wedding-blush)" />
            </svg>
        </div>

        <!-- Celebration Confetti and Petals -->
        <div
            v-if="rsvp"
            class="pointer-events-none fixed inset-0 overflow-hidden"
        >
            <!-- Confetti Elements -->
            <div
                class="wedding-confetti"
                style="
                    left: 10%;
                    animation-delay: 0s;
                    background: var(--wedding-gold);
                "
            ></div>
            <div
                class="wedding-confetti"
                style="
                    left: 20%;
                    animation-delay: 0.5s;
                    background: var(--wedding-blush);
                "
            ></div>
            <div
                class="wedding-confetti"
                style="
                    left: 30%;
                    animation-delay: 1s;
                    background: var(--wedding-navy);
                "
            ></div>
            <div
                class="wedding-confetti"
                style="
                    left: 40%;
                    animation-delay: 1.5s;
                    background: var(--wedding-gold-light);
                "
            ></div>
            <div
                class="wedding-confetti"
                style="
                    left: 50%;
                    animation-delay: 2s;
                    background: var(--wedding-blush-dark);
                "
            ></div>
            <div
                class="wedding-confetti"
                style="
                    left: 60%;
                    animation-delay: 2.5s;
                    background: var(--wedding-gold);
                "
            ></div>
            <div
                class="wedding-confetti"
                style="
                    left: 70%;
                    animation-delay: 3s;
                    background: var(--wedding-blush);
                "
            ></div>
            <div
                class="wedding-confetti"
                style="
                    left: 80%;
                    animation-delay: 3.5s;
                    background: var(--wedding-navy-light);
                "
            ></div>
            <div
                class="wedding-confetti"
                style="
                    left: 90%;
                    animation-delay: 4s;
                    background: var(--wedding-gold-dark);
                "
            ></div>

            <!-- Petal Elements -->
            <div
                class="wedding-petal"
                style="left: 15%; animation-delay: 0.3s"
            ></div>
            <div
                class="wedding-petal"
                style="left: 25%; animation-delay: 1.2s"
            ></div>
            <div
                class="wedding-petal"
                style="left: 35%; animation-delay: 2.1s"
            ></div>
            <div
                class="wedding-petal"
                style="left: 45%; animation-delay: 3s"
            ></div>
            <div
                class="wedding-petal"
                style="left: 55%; animation-delay: 3.9s"
            ></div>
            <div
                class="wedding-petal"
                style="left: 65%; animation-delay: 4.8s"
            ></div>
            <div
                class="wedding-petal"
                style="left: 75%; animation-delay: 5.7s"
            ></div>
            <div
                class="wedding-petal"
                style="left: 85%; animation-delay: 6.6s"
            ></div>

            <!-- Sparkle Elements -->
            <div
                class="wedding-sparkle"
                style="top: 20%; left: 10%; animation-delay: 0.2s"
            ></div>
            <div
                class="wedding-sparkle"
                style="top: 30%; left: 30%; animation-delay: 0.7s"
            ></div>
            <div
                class="wedding-sparkle"
                style="top: 25%; left: 50%; animation-delay: 1.2s"
            ></div>
            <div
                class="wedding-sparkle"
                style="top: 35%; left: 70%; animation-delay: 1.7s"
            ></div>
            <div
                class="wedding-sparkle"
                style="top: 40%; left: 90%; animation-delay: 2.2s"
            ></div>
            <div
                class="wedding-sparkle"
                style="top: 60%; left: 20%; animation-delay: 2.7s"
            ></div>
            <div
                class="wedding-sparkle"
                style="top: 70%; left: 40%; animation-delay: 3.2s"
            ></div>
            <div
                class="wedding-sparkle"
                style="top: 65%; left: 60%; animation-delay: 3.7s"
            ></div>
            <div
                class="wedding-sparkle"
                style="top: 75%; left: 80%; animation-delay: 4.2s"
            ></div>
        </div>

        <div
            class="wedding-smooth-scroll wedding-container relative z-10 px-4 py-8 sm:py-10 lg:py-12"
        >
            <div class="mx-auto max-w-4xl">
                <!-- Success Message -->
                <div
                    v-if="rsvp"
                    class="wedding-header wedding-animate-bounce-in mb-8 text-center sm:mb-10 lg:mb-12"
                >
                    <div
                        class="bg-wedding-gold-light shadow-wedding-gold wedding-animate-gold-shimmer wedding-success-animation mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full sm:mb-6 sm:h-20 sm:w-20"
                    >
                        <CheckCircle
                            class="text-wedding-navy wedding-animate-scale-in h-8 w-8 sm:h-10 sm:w-10"
                        />
                    </div>
                    <h1
                        class="wedding-title text-wedding-4xl sm:text-wedding-5xl font-wedding-black wedding-navy wedding-hover-glow"
                    >
                        Thank You!
                    </h1>
                    <div
                        class="wedding-divider wedding-animate-gold-shimmer mt-4 mb-3 sm:mt-6 sm:mb-4"
                    ></div>
                    <p
                        class="wedding-subtitle font-wedding-accent text-wedding-lg sm:text-wedding-xl wedding-animate-fade-in-up"
                        style="animation-delay: 0.3s"
                    >
                        Your RSVP has been received!
                    </p>
                    <p
                        class="text-wedding-base sm:text-wedding-lg font-wedding-body wedding-navy wedding-animate-fade-in-up mt-2"
                        style="animation-delay: 0.5s"
                    >
                        We're so excited to celebrate with you on our special
                        day.
                    </p>

                    <!-- Enhanced Celebration Animation Elements -->
                    <div
                        class="mt-6 flex justify-center space-x-2 sm:mt-8 sm:space-x-4"
                    >
                        <div
                            class="wedding-animate-fade-in-up wedding-hover-scale"
                            style="animation-delay: 0.2s"
                        >
                            <span class="animate-pulse text-2xl sm:text-4xl"
                                >💐</span
                            >
                        </div>
                        <div
                            class="wedding-animate-fade-in-up wedding-hover-scale"
                            style="animation-delay: 0.4s"
                        >
                            <span class="animate-pulse text-2xl sm:text-4xl"
                                >🌸</span
                            >
                        </div>
                        <div
                            class="wedding-animate-fade-in-up wedding-hover-scale"
                            style="animation-delay: 0.6s"
                        >
                            <span class="animate-pulse text-2xl sm:text-4xl"
                                >✨</span
                            >
                        </div>
                        <div
                            class="wedding-animate-fade-in-up wedding-hover-scale"
                            style="animation-delay: 0.8s"
                        >
                            <span class="animate-pulse text-2xl sm:text-4xl"
                                >💕</span
                            >
                        </div>
                        <div
                            class="wedding-animate-fade-in-up wedding-hover-scale"
                            style="animation-delay: 1s"
                        >
                            <span class="animate-pulse text-2xl sm:text-4xl"
                                >🌹</span
                            >
                        </div>
                    </div>
                </div>

                <!-- No RSVP Data -->
                <div
                    v-else
                    class="wedding-header wedding-animate-fade-in-up mb-8 text-center sm:mb-10 lg:mb-12"
                >
                    <div
                        class="bg-wedding-blush-light wedding-animate-scale-in mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full sm:mb-6 sm:h-16 sm:w-16"
                    >
                        <Info class="text-wedding-navy h-6 w-6 sm:h-8 sm:w-8" />
                    </div>
                    <h1
                        class="wedding-title text-wedding-3xl sm:text-wedding-4xl font-wedding-bold wedding-navy"
                    >
                        RSVP Not Found
                    </h1>
                    <div class="wedding-divider-blush mt-4 mb-4"></div>
                    <p
                        class="text-wedding-base sm:text-wedding-lg font-wedding-body wedding-navy mt-2"
                    >
                        We couldn't find your RSVP confirmation. Please try
                        submitting your RSVP again.
                    </p>
                    <button
                        class="btn-wedding-primary wedding-hover-lift wedding-touch-target-lg mt-4 sm:mt-6"
                        @click="$inertia.visit('/rsvp')"
                    >
                        <ArrowLeft class="mr-2 inline h-4 w-4" />
                        <span class="text-sm sm:text-base"
                            >Back to RSVP Form</span
                        >
                    </button>
                </div>

                <!-- RSVP Details Card -->
                <Card
                    v-if="rsvp"
                    class="card-wedding-elegant wedding-animate-scale-in shadow-wedding-xl wedding-hover-lift mb-6 sm:mb-8"
                    style="animation-delay: 0.3s"
                >
                    <CardHeader class="pb-4 text-center sm:pb-6">
                        <CardTitle
                            class="wedding-title text-wedding-2xl sm:text-wedding-3xl font-wedding-bold wedding-navy"
                        >
                            RSVP Confirmation Details
                        </CardTitle>
                        <div class="wedding-divider-blush mt-4"></div>
                        <CardDescription
                            class="text-wedding-base sm:text-wedding-lg font-wedding-body wedding-navy mt-2"
                        >
                            Please review your submitted information below
                        </CardDescription>
                    </CardHeader>
                    <CardContent class="p-6 sm:p-8">
                        <div class="space-y-6">
                            <!-- Group Information -->
                            <div
                                class="card-wedding rounded-wedding-lg border-wedding-gold wedding-animate-fade-in-up wedding-hover-lift border-2 p-6"
                                style="animation-delay: 0.4s"
                            >
                                <h3
                                    class="wedding-title text-wedding-xl font-wedding-semibold wedding-navy mb-4"
                                >
                                    Group Information
                                </h3>
                                <div
                                    class="grid grid-cols-1 gap-4 sm:grid-cols-2"
                                >
                                    <div>
                                        <p
                                            class="text-wedding-sm font-wedding-medium wedding-blush"
                                        >
                                            Group Name
                                        </p>
                                        <p
                                            class="text-wedding-lg font-wedding-semibold wedding-navy"
                                        >
                                            {{ rsvp.group_name }}
                                        </p>
                                    </div>
                                    <div>
                                        <p
                                            class="text-wedding-sm font-wedding-medium wedding-blush"
                                        >
                                            Submitted
                                        </p>
                                        <p
                                            class="text-wedding-lg font-wedding-semibold wedding-navy"
                                        >
                                            {{ formatDate(rsvp.submitted_at) }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Attendance Information -->
                            <div
                                class="card-wedding rounded-wedding-lg border-wedding-blush bg-wedding-blush-light-bg wedding-animate-fade-in-up wedding-hover-lift border-2 p-6"
                                style="animation-delay: 0.6s"
                            >
                                <h3
                                    class="wedding-title text-wedding-xl font-wedding-semibold wedding-navy mb-4"
                                >
                                    Attendance
                                </h3>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p
                                            class="text-wedding-sm font-wedding-medium wedding-blush"
                                        >
                                            Number of Attendees
                                        </p>
                                        <p
                                            class="text-wedding-3xl font-wedding-bold wedding-navy"
                                        >
                                            {{ rsvp.attending_count }}
                                            {{
                                                rsvp.attending_count === 1
                                                    ? 'person'
                                                    : 'people'
                                            }}
                                        </p>
                                    </div>
                                    <div class="text-right">
                                        <p
                                            class="text-wedding-sm font-wedding-medium wedding-blush"
                                        >
                                            Status
                                        </p>
                                        <div
                                            class="mt-1 inline-flex items-center rounded-full px-4 py-2"
                                            :class="
                                                rsvp.attending_count > 0
                                                    ? 'border-2 border-green-300 bg-green-100 text-green-800'
                                                    : 'border-2 border-gray-300 bg-gray-100 text-gray-800'
                                            "
                                        >
                                            {{
                                                rsvp.attending_count > 0
                                                    ? '✨ Attending'
                                                    : 'Not Attending'
                                            }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Guest List -->
                            <div
                                v-if="
                                    rsvp.group &&
                                    rsvp.group.guests &&
                                    rsvp.group.guests.length > 0
                                "
                                class="card-wedding rounded-wedding-lg border-wedding-gold wedding-animate-fade-in-up wedding-hover-lift border-2 p-6"
                                style="animation-delay: 0.8s"
                            >
                                <h3
                                    class="wedding-title text-wedding-xl font-wedding-semibold wedding-navy mb-4"
                                >
                                    Guests in Your Group
                                </h3>
                                <div
                                    class="grid grid-cols-1 gap-3 sm:grid-cols-2"
                                >
                                    <div
                                        v-for="guest in rsvp.group.guests"
                                        :key="guest.id"
                                        class="rounded-wedding-lg bg-wedding-ivory-bg border-wedding-blush-light wedding-hover-scale wedding-transition flex items-center space-x-3 border p-3"
                                    >
                                        <div class="flex-shrink-0">
                                            <div
                                                class="bg-wedding-gold-light flex h-10 w-10 items-center justify-center rounded-full"
                                            >
                                                <User
                                                    class="text-wedding-navy h-5 w-5"
                                                />
                                            </div>
                                        </div>
                                        <div>
                                            <p
                                                class="text-wedding-base font-wedding-semibold wedding-navy"
                                            >
                                                {{ guest.full_name }}
                                            </p>
                                            <p
                                                v-if="guest.email"
                                                class="text-wedding-sm font-wedding-body wedding-blush"
                                            >
                                                {{ guest.email }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Message -->
                            <div
                                v-if="rsvp.message"
                                class="card-wedding rounded-wedding-lg border-wedding-gold wedding-animate-fade-in-up wedding-hover-lift border-2 p-6"
                                style="animation-delay: 1s"
                            >
                                <h3
                                    class="wedding-title text-wedding-xl font-wedding-semibold wedding-navy mb-4 flex items-center"
                                >
                                    <MessageSquare
                                        class="text-wedding-gold mr-2 h-6 w-6"
                                    />
                                    Message to the Couple
                                </h3>
                                <div
                                    class="rounded-wedding-lg bg-wedding-ivory-bg border-wedding-blush-light border p-4"
                                >
                                    <p
                                        class="text-wedding-base font-wedding-body wedding-navy whitespace-pre-wrap"
                                    >
                                        {{ rsvp.message }}
                                    </p>
                                </div>
                            </div>

                            <!-- Song Suggestion -->
                            <div
                                v-if="rsvp.song_suggestion"
                                class="card-wedding rounded-wedding-lg border-wedding-blush wedding-animate-fade-in-up wedding-hover-lift border-2 p-6"
                                style="animation-delay: 1.2s"
                            >
                                <h3
                                    class="wedding-title text-wedding-xl font-wedding-semibold wedding-navy mb-4 flex items-center"
                                >
                                    <Music
                                        class="text-wedding-gold mr-2 h-6 w-6"
                                    />
                                    Song Suggestion
                                </h3>
                                <div
                                    class="rounded-wedding-lg bg-wedding-ivory-bg border-wedding-blush-light border p-4"
                                >
                                    <p
                                        class="text-wedding-base font-wedding-body wedding-navy"
                                    >
                                        🎵 {{ rsvp.song_suggestion }}
                                    </p>
                                </div>
                            </div>

                            <!-- Email Information -->
                            <div
                                class="card-wedding rounded-wedding-lg border-wedding-navy wedding-animate-fade-in-up wedding-hover-lift border-2 p-6"
                                style="animation-delay: 1.4s"
                            >
                                <h3
                                    class="wedding-title text-wedding-xl font-wedding-semibold wedding-navy mb-4 flex items-center"
                                >
                                    <Mail
                                        class="text-wedding-gold mr-2 h-6 w-6"
                                    />
                                    Email Confirmation
                                </h3>
                                <div
                                    class="rounded-wedding-lg bg-wedding-ivory-bg border-wedding-blush-light border p-4"
                                >
                                    <p
                                        class="text-wedding-base font-wedding-body wedding-navy mb-2"
                                    >
                                        A confirmation email has been sent to:
                                    </p>
                                    <p
                                        class="text-wedding-lg font-wedding-semibold wedding-navy"
                                    >
                                        {{ rsvp.email }}
                                    </p>
                                    <p
                                        class="text-wedding-sm font-wedding-body wedding-blush mt-2"
                                    >
                                        Please check your inbox (and spam
                                        folder) for the confirmation email.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-8 flex flex-col gap-4 sm:flex-row">
                            <button
                                class="btn-wedding-secondary wedding-hover-lift flex-1"
                                @click="resendConfirmation"
                            >
                                <Mail class="mr-2 inline h-4 w-4" />
                                Resend Confirmation Email
                            </button>
                            <button
                                class="btn-wedding-primary wedding-hover-lift flex-1"
                                @click="$inertia.visit('/rsvp')"
                            >
                                <ArrowLeft class="mr-2 inline h-4 w-4" />
                                Submit Another RSVP
                            </button>
                        </div>
                    </CardContent>
                </Card>

                <!-- Additional Information -->
                <div
                    v-if="rsvp"
                    class="wedding-animate-fade-in-up"
                    style="animation-delay: 1.6s"
                >
                    <div
                        class="card-wedding-elegant rounded-wedding-xl shadow-wedding-soft wedding-hover-lift p-6"
                    >
                        <h3
                            class="wedding-title text-wedding-xl font-wedding-semibold wedding-navy mb-4"
                        >
                            Need to Make Changes?
                        </h3>
                        <div class="wedding-divider-blush mb-4"></div>
                        <p
                            class="text-wedding-base font-wedding-body wedding-navy mb-6"
                        >
                            If you need to update your RSVP or have any
                            questions, please contact us directly.
                        </p>
                        <div
                            class="flex flex-col justify-center gap-4 sm:flex-row"
                        >
                            <button
                                class="btn-wedding-accent wedding-hover-lift"
                            >
                                <Phone class="mr-2 inline h-4 w-4" />
                                Contact Couple
                            </button>
                            <button
                                class="btn-wedding-secondary wedding-hover-lift"
                            >
                                <Calendar class="mr-2 inline h-4 w-4" />
                                View Wedding Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>

<script setup lang="ts">
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import PublicLayout from '@/layouts/PublicLayout.vue';
import { router } from '@inertiajs/vue3';
import {
    ArrowLeft,
    Calendar,
    CheckCircle,
    Info,
    Mail,
    MessageSquare,
    Music,
    Phone,
    User,
} from 'lucide-vue-next';

interface Guest {
    id: number;
    full_name: string;
    email?: string;
}

interface Rsvp {
    id: number;
    group_name: string;
    attending_count: number;
    message?: string;
    song_suggestion?: string;
    email: string;
    submitted_at: string;
    group: {
        name: string;
        guests: Guest[];
    };
}

interface Props {
    rsvp: Rsvp | null;
}

const props = defineProps<Props>();

const formatDate = (dateString: string): string => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
    });
};

const resendConfirmation = () => {
    if (!props.rsvp) return;

    router.post(
        '/rsvp/resend-confirmation',
        { rsvp_id: props.rsvp.id },
        {
            onSuccess: () => {
                // Show success message
                alert('Confirmation email has been resent!');
            },
            onError: () => {
                // Show error message
                alert(
                    'Failed to resend confirmation email. Please try again later.',
                );
            },
        },
    );
};
</script>

<style scoped>
/* Enhanced Celebration Animations */
@keyframes float {
    0%,
    100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

@keyframes celebration-bounce {
    0%,
    20%,
    50%,
    80%,
    100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-20px);
    }
    60% {
        transform: translateY(-10px);
    }
}

@keyframes sparkle-shine {
    0%,
    100% {
        opacity: 0;
        transform: scale(0) rotate(0deg);
    }
    50% {
        opacity: 1;
        transform: scale(1) rotate(180deg);
    }
}

@keyframes petal-sway {
    0%,
    100% {
        transform: translateX(0) rotate(0deg);
    }
    25% {
        transform: translateX(-10px) rotate(-5deg);
    }
    75% {
        transform: translateX(10px) rotate(5deg);
    }
}

@keyframes success-pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.7);
    }
    70% {
        box-shadow: 0 0 0 20px rgba(212, 175, 55, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(212, 175, 55, 0);
    }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.animate-celebration-bounce {
    animation: celebration-bounce 2s ease-in-out infinite;
}

.animate-sparkle-shine {
    animation: sparkle-shine 1.5s ease-in-out infinite;
}

.animate-petal-sway {
    animation: petal-sway 4s ease-in-out infinite;
}

.animate-success-pulse {
    animation: success-pulse 2s ease-out;
}

/* Enhanced Celebration Elements */
.celebration-emoji {
    display: inline-block;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.celebration-emoji:hover {
    transform: scale(1.2) rotate(10deg);
    filter: brightness(1.2);
}

/* Enhanced Card Hover Effects */
.card-wedding-elegant {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.card-wedding-elegant::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(212, 175, 55, 0.1),
        transparent
    );
    transition: left 0.6s ease;
}

.card-wedding-elegant:hover::before {
    left: 100%;
}

.card-wedding-elegant:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(212, 175, 55, 0.3);
}

/* Enhanced Button Effects */
.btn-wedding-primary,
.btn-wedding-secondary,
.btn-wedding-accent {
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-wedding-primary::after,
.btn-wedding-secondary::after,
.btn-wedding-accent::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition:
        width 0.6s ease,
        height 0.6s ease;
}

.btn-wedding-primary:hover::after,
.btn-wedding-secondary:hover::after,
.btn-wedding-accent:hover::after {
    width: 300px;
    height: 300px;
}

/* Enhanced Success Icon Animation */
.wedding-success-animation {
    position: relative;
}

.wedding-success-animation::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120px;
    height: 120px;
    background: radial-gradient(circle, var(--wedding-gold), transparent);
    border-radius: 50%;
    animation:
        wedding-success-burst 1.5s ease-out,
        success-pulse 2s ease-out;
}

/* Enhanced Confetti and Petal Animations */
.wedding-confetti {
    position: fixed;
    width: 12px;
    height: 12px;
    border-radius: 2px;
    animation: wedding-confetti-fall 4s linear infinite;
}

.wedding-petal {
    position: fixed;
    width: 18px;
    height: 18px;
    background: var(--wedding-blush);
    border-radius: 0 100% 0 100%;
    animation:
        wedding-petal-fall 12s linear infinite,
        petal-sway 4s ease-in-out infinite;
}

.wedding-sparkle {
    position: absolute;
    width: 6px;
    height: 6px;
    background: var(--wedding-gold);
    border-radius: 50%;
    animation:
        wedding-sparkle 2s ease-in-out infinite,
        sparkle-shine 1.5s ease-in-out infinite;
}

/* Enhanced Divider Animations */
.wedding-divider {
    position: relative;
    overflow: hidden;
}

.wedding-divider::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        90deg,
        transparent,
        var(--wedding-gold),
        transparent
    );
    animation: goldShimmer 3s ease-in-out infinite;
}

/* Staggered Animation Delays for Celebration Elements */
.wedding-animate-fade-in-up[style*='animation-delay: 0.2s'],
.wedding-animate-scale-in[style*='animation-delay: 0.2s'] {
    animation-delay: 0.2s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.3s'],
.wedding-animate-scale-in[style*='animation-delay: 0.3s'] {
    animation-delay: 0.3s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.4s'],
.wedding-animate-scale-in[style*='animation-delay: 0.4s'] {
    animation-delay: 0.4s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.5s'],
.wedding-animate-scale-in[style*='animation-delay: 0.5s'] {
    animation-delay: 0.5s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.6s'],
.wedding-animate-scale-in[style*='animation-delay: 0.6s'] {
    animation-delay: 0.6s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.8s'],
.wedding-animate-scale-in[style*='animation-delay: 0.8s'] {
    animation-delay: 0.8s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 1s'],
.wedding-animate-scale-in[style*='animation-delay: 1s'] {
    animation-delay: 1s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 1.2s'],
.wedding-animate-scale-in[style*='animation-delay: 1.2s'] {
    animation-delay: 1.2s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 1.4s'],
.wedding-animate-scale-in[style*='animation-delay: 1.4s'] {
    animation-delay: 1.4s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 1.6s'],
.wedding-animate-scale-in[style*='animation-delay: 1.6s'] {
    animation-delay: 1.6s !important;
}

/* Responsive Enhancements */
@media (max-width: 768px) {
    .wedding-confetti,
    .wedding-petal {
        display: none;
    }

    .card-wedding-elegant:hover {
        transform: translateY(-4px);
    }

    .celebration-emoji:hover {
        transform: scale(1.1);
    }
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    .wedding-confetti,
    .wedding-petal,
    .wedding-sparkle {
        display: none;
    }

    .animate-float,
    .animate-celebration-bounce,
    .animate-sparkle-shine,
    .animate-petal-sway,
    .animate-success-pulse {
        animation: none;
    }

    .celebration-emoji:hover {
        transform: none;
    }

    .card-wedding-elegant:hover {
        transform: none;
    }

    .btn-wedding-primary:hover::after,
    .btn-wedding-secondary:hover::after,
    .btn-wedding-accent:hover::after {
        display: none;
    }
}
</style>
