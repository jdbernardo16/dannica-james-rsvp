<template>
    <PublicLayout
        title="RSVP - Wedding Invitation"
        description="Please fill out this form to let us know if you can attend our special day"
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

        <div
            class="wedding-smooth-scroll wedding-container relative z-10 px-4 py-8 sm:py-10 lg:py-12"
        >
            <div class="mx-auto max-w-4xl">
                <!-- Header -->
                <div
                    class="wedding-header wedding-animate-bounce-in mb-8 text-center sm:mb-10 lg:mb-12"
                >
                    <h1
                        class="wedding-title text-wedding-4xl sm:text-wedding-5xl font-wedding-black wedding-navy wedding-hover-glow"
                    >
                        Wedding RSVP
                    </h1>
                    <div
                        class="wedding-divider wedding-animate-gold-shimmer mt-4 mb-3 sm:mt-6 sm:mb-4"
                    ></div>
                    <p
                        class="wedding-subtitle font-wedding-accent text-wedding-lg sm:text-wedding-xl wedding-animate-fade-in-up"
                        style="animation-delay: 0.3s"
                    >
                        We're so excited to celebrate with you!
                    </p>
                    <p
                        class="text-wedding-base sm:text-wedding-lg font-wedding-body wedding-navy wedding-animate-fade-in-up mt-2"
                        style="animation-delay: 0.5s"
                    >
                        Please fill out this form to let us know if you can
                        attend our special day.
                    </p>
                </div>

                <!-- Wedding-themed Step Indicator -->
                <div class="wedding-animate-slide-up mb-8 sm:mb-10 lg:mb-12">
                    <div class="wedding-step-indicator">
                        <div
                            v-for="(step, index) in steps"
                            :key="index"
                            class="wedding-step"
                            :class="{
                                active: currentStep === index,
                                completed: currentStep > index,
                            }"
                        >
                            <div
                                class="wedding-step-circle wedding-touch-target"
                            >
                                <CheckCircle
                                    v-if="currentStep > index"
                                    class="h-4 w-4 sm:h-5 sm:w-5"
                                />
                                <span v-else class="text-sm sm:text-base">{{
                                    index + 1
                                }}</span>
                            </div>
                            <span
                                class="wedding-step-label text-xs sm:text-sm"
                                >{{ step.title }}</span
                            >
                            <div
                                v-if="index < steps.length - 1"
                                class="wedding-step-connector"
                                :class="{ completed: currentStep > index }"
                            ></div>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div
                    class="card-wedding-elegant wedding-animate-scale-in shadow-wedding-xl wedding-hover-lift"
                    style="animation-delay: 0.2s"
                >
                    <CardContent class="p-6 sm:p-8">
                        <form @submit.prevent="handleSubmit">
                            <!-- Step 1: Guest Identification -->
                            <div
                                v-if="currentStep === 0"
                                class="wedding-animate-page-transition space-y-6"
                            >
                                <div>
                                    <h2
                                        class="wedding-title text-wedding-3xl font-wedding-bold wedding-navy"
                                    >
                                        Find Your Invitation
                                    </h2>
                                    <div
                                        class="wedding-divider-blush mt-4"
                                    ></div>
                                    <p
                                        class="text-wedding-lg font-wedding-body wedding-navy mt-4"
                                    >
                                        Please enter your full name as it
                                        appears on your invitation.
                                    </p>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <Label
                                            for="guest_name"
                                            class="font-wedding-semibold wedding-navy wedding-animate-fade-in-left"
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
                                            class="input-wedding wedding-transition-slow mt-2"
                                            :class="{
                                                error: errors.guest_name,
                                                success:
                                                    guestFound &&
                                                    !errors.guest_name,
                                            }"
                                        />
                                        <p
                                            v-if="errors.guest_name"
                                            class="font-wedding-medium mt-1 text-sm text-red-600"
                                        >
                                            {{ errors.guest_name }}
                                        </p>
                                    </div>

                                    <!-- Loading state -->
                                    <div
                                        v-if="isLoading"
                                        class="wedding-animate-fade-in flex items-center justify-center py-4"
                                    >
                                        <div
                                            class="wedding-loading border-wedding-gold h-8 w-8 rounded-full border-b-2"
                                        ></div>
                                        <span
                                            class="wedding-navy font-wedding-medium wedding-animate-pulse ml-2"
                                            >Searching for your
                                            invitation...</span
                                        >
                                    </div>

                                    <!-- Guest found -->
                                    <div
                                        v-if="guestFound && guestData"
                                        class="rounded-wedding-lg border-wedding-gold bg-wedding-ivory-bg shadow-wedding-soft wedding-animate-bounce-in wedding-success-animation border-2 p-4"
                                    >
                                        <div class="flex items-start">
                                            <CheckCircle
                                                class="mt-0.5 mr-2 h-5 w-5 text-green-600"
                                            />
                                            <div>
                                                <h3
                                                    class="font-wedding-semibold text-green-900"
                                                >
                                                    Invitation Found!
                                                </h3>
                                                <p
                                                    class="font-wedding-body mt-1 text-sm text-green-700"
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
                                                        class="font-wedding-medium text-sm text-green-700"
                                                    >
                                                        Guests in your group:
                                                    </p>
                                                    <ul
                                                        class="font-wedding-body ml-2 list-inside list-disc text-sm text-green-700"
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
                                                    v-if="
                                                        guestData.group
                                                            ?.has_rsvp
                                                    "
                                                    class="rounded-wedding mt-2 border border-yellow-300 bg-yellow-100 p-2"
                                                >
                                                    <p
                                                        class="font-wedding-medium text-sm text-yellow-800"
                                                    >
                                                        <AlertCircle
                                                            class="mr-1 inline h-4 w-4"
                                                        />
                                                        This group has already
                                                        submitted an RSVP.
                                                        Please contact the
                                                        couple if you need to
                                                        make changes.
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
                                        class="rounded-wedding-lg border-2 border-red-200 bg-red-50 p-4"
                                    >
                                        <div class="flex items-start">
                                            <XCircle
                                                class="mt-0.5 mr-2 h-5 w-5 text-red-600"
                                            />
                                            <div>
                                                <h3
                                                    class="font-wedding-semibold text-red-900"
                                                >
                                                    Invitation Not Found
                                                </h3>
                                                <p
                                                    class="font-wedding-body mt-1 text-sm text-red-700"
                                                >
                                                    We couldn't find your
                                                    invitation. Please check the
                                                    spelling of your name or
                                                    contact the couple for
                                                    assistance.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Attendance Confirmation -->
                            <div
                                v-if="currentStep === 1"
                                class="wedding-animate-page-transition space-y-6"
                            >
                                <div>
                                    <h2
                                        class="wedding-title text-wedding-3xl font-wedding-bold wedding-navy"
                                    >
                                        Will You Be Attending?
                                    </h2>
                                    <div
                                        class="wedding-divider-blush mt-4"
                                    ></div>
                                    <p
                                        class="text-wedding-lg font-wedding-body wedding-navy mt-4"
                                    >
                                        Let us know how many people from your
                                        group will be attending the wedding.
                                    </p>
                                </div>

                                <div
                                    v-if="guestData"
                                    class="rounded-wedding-lg border-wedding-blush bg-wedding-blush-light-bg shadow-wedding-soft mb-6 border-2 p-4"
                                >
                                    <p
                                        class="font-wedding-semibold wedding-navy"
                                    >
                                        Group: {{ guestData.group?.name }}
                                    </p>
                                    <p
                                        class="wedding-navy font-wedding-body text-sm"
                                    >
                                        Maximum attendees:
                                        {{ guestData.group?.max_attendees }}
                                    </p>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <Label
                                            for="attending_count"
                                            class="font-wedding-semibold wedding-navy"
                                        >
                                            Number of Attendees
                                        </Label>
                                        <div
                                            class="mt-4 flex items-center justify-center space-x-4 sm:space-x-6"
                                        >
                                            <button
                                                type="button"
                                                class="btn-wedding-secondary wedding-hover-scale wedding-touch-target-lg"
                                                @click="decrementAttendees"
                                                :disabled="
                                                    formData.attending_count <=
                                                    0
                                                "
                                            >
                                                <Minus
                                                    class="h-4 w-4 sm:h-5 sm:w-5"
                                                />
                                            </button>
                                            <div
                                                class="font-wedding-bold wedding-navy wedding-animate-scale-in w-16 text-center text-2xl sm:w-20 sm:text-3xl"
                                            >
                                                {{ formData.attending_count }}
                                            </div>
                                            <button
                                                type="button"
                                                class="btn-wedding-secondary wedding-hover-scale wedding-touch-target-lg"
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
                                            class="text-wedding-base sm:text-wedding-lg font-wedding-body wedding-navy mt-4 text-center"
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
                            <div
                                v-if="currentStep === 2"
                                class="wedding-animate-page-transition space-y-6"
                            >
                                <div>
                                    <h2
                                        class="wedding-title text-wedding-3xl font-wedding-bold wedding-navy"
                                    >
                                        Message to the Couple
                                    </h2>
                                    <div
                                        class="wedding-divider-blush mt-4"
                                    ></div>
                                    <p
                                        class="text-wedding-lg font-wedding-body wedding-navy mt-4"
                                    >
                                        Share a special message or well wishes
                                        with us (optional).
                                    </p>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <Label
                                            for="message"
                                            class="font-wedding-semibold wedding-navy"
                                        >
                                            Your Message
                                        </Label>
                                        <Textarea
                                            id="message"
                                            v-model="formData.message"
                                            placeholder="Write your message here..."
                                            rows="5"
                                            maxlength="1000"
                                            class="input-wedding wedding-transition-slow textarea-wedding mt-2"
                                        />
                                        <p
                                            class="wedding-navy font-wedding-body mt-1 text-sm"
                                        >
                                            {{
                                                formData.message?.length || 0
                                            }}/1000 characters
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4: Song Suggestion -->
                            <div
                                v-if="currentStep === 3"
                                class="wedding-animate-page-transition space-y-6"
                            >
                                <div>
                                    <h2
                                        class="wedding-title text-wedding-3xl font-wedding-bold wedding-navy"
                                    >
                                        Song Suggestion
                                    </h2>
                                    <div
                                        class="wedding-divider-blush mt-4"
                                    ></div>
                                    <p
                                        class="text-wedding-lg font-wedding-body wedding-navy mt-4"
                                    >
                                        Help us create the perfect playlist!
                                        Suggest a song that would make you want
                                        to dance (optional).
                                    </p>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <Label
                                            for="song_suggestion"
                                            class="font-wedding-semibold wedding-navy"
                                        >
                                            Song Title & Artist
                                        </Label>
                                        <Input
                                            id="song_suggestion"
                                            v-model="formData.song_suggestion"
                                            type="text"
                                            placeholder="e.g., 'Perfect - Ed Sheeran'"
                                            maxlength="255"
                                            class="input-wedding wedding-transition-slow mt-2"
                                        />
                                        <p
                                            class="wedding-navy font-wedding-body mt-1 text-sm"
                                        >
                                            {{
                                                formData.song_suggestion
                                                    ?.length || 0
                                            }}/255 characters
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 5: Email Address -->
                            <div
                                v-if="currentStep === 4"
                                class="wedding-animate-page-transition space-y-6"
                            >
                                <div>
                                    <h2
                                        class="wedding-title text-wedding-3xl font-wedding-bold wedding-navy"
                                    >
                                        Email Address
                                    </h2>
                                    <div
                                        class="wedding-divider-blush mt-4"
                                    ></div>
                                    <p
                                        class="text-wedding-lg font-wedding-body wedding-navy mt-4"
                                    >
                                        Provide your email address for
                                        confirmation and updates about the
                                        wedding.
                                    </p>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <Label
                                            for="email"
                                            class="font-wedding-semibold wedding-navy"
                                        >
                                            Email Address
                                        </Label>
                                        <Input
                                            id="email"
                                            v-model="formData.email"
                                            type="email"
                                            placeholder="your.email@example.com"
                                            required
                                            class="input-wedding wedding-transition-slow mt-2"
                                            :class="{
                                                error: errors.email,
                                                success:
                                                    formData.email &&
                                                    !errors.email,
                                            }"
                                        />
                                        <p
                                            v-if="errors.email"
                                            class="font-wedding-medium mt-1 text-sm text-red-600"
                                        >
                                            {{ errors.email }}
                                        </p>
                                        <p
                                            class="wedding-navy font-wedding-body mt-1 text-sm"
                                        >
                                            We'll use this to send you a
                                            confirmation and any important
                                            updates.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 6: Confirmation -->
                            <div
                                v-if="currentStep === 5"
                                class="wedding-animate-page-transition space-y-6"
                            >
                                <div>
                                    <h2
                                        class="wedding-title text-wedding-3xl font-wedding-bold wedding-navy"
                                    >
                                        Review Your RSVP
                                    </h2>
                                    <div
                                        class="wedding-divider-blush mt-4"
                                    ></div>
                                    <p
                                        class="text-wedding-lg font-wedding-body wedding-navy mt-4"
                                    >
                                        Please review your information before
                                        submitting.
                                    </p>
                                </div>

                                <div
                                    class="rounded-wedding-lg bg-wedding-ivory-bg border-wedding-blush-light space-y-6 border-2 p-6"
                                >
                                    <div>
                                        <h3
                                            class="font-wedding-semibold wedding-navy text-wedding-xl"
                                        >
                                            Guest Information
                                        </h3>
                                        <p
                                            class="wedding-navy font-wedding-body text-wedding-lg mt-2"
                                        >
                                            {{ formData.guest_name }}
                                        </p>
                                        <p
                                            v-if="guestData"
                                            class="wedding-navy font-wedding-body mt-1 text-sm"
                                        >
                                            Group:
                                            {{ guestData.group?.name }}
                                        </p>
                                    </div>

                                    <div class="wedding-divider"></div>

                                    <div>
                                        <h3
                                            class="font-wedding-semibold wedding-navy text-wedding-xl"
                                        >
                                            Attendance
                                        </h3>
                                        <p
                                            class="wedding-navy font-wedding-body text-wedding-lg mt-2"
                                        >
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
                                        class="wedding-divider"
                                    ></div>

                                    <div v-if="formData.message">
                                        <h3
                                            class="font-wedding-semibold wedding-navy text-wedding-xl"
                                        >
                                            Message
                                        </h3>
                                        <p
                                            class="wedding-navy font-wedding-body text-wedding-lg mt-2 whitespace-pre-wrap"
                                        >
                                            {{ formData.message }}
                                        </p>
                                    </div>

                                    <div
                                        v-if="formData.song_suggestion"
                                        class="wedding-divider"
                                    ></div>

                                    <div v-if="formData.song_suggestion">
                                        <h3
                                            class="font-wedding-semibold wedding-navy text-wedding-xl"
                                        >
                                            Song Suggestion
                                        </h3>
                                        <p
                                            class="wedding-navy font-wedding-body text-wedding-lg mt-2"
                                        >
                                            {{ formData.song_suggestion }}
                                        </p>
                                    </div>

                                    <div class="wedding-divider"></div>

                                    <div>
                                        <h3
                                            class="font-wedding-semibold wedding-navy text-wedding-xl"
                                        >
                                            Email
                                        </h3>
                                        <p
                                            class="wedding-navy font-wedding-body text-wedding-lg mt-2"
                                        >
                                            {{ formData.email }}
                                        </p>
                                    </div>
                                </div>

                                <div
                                    class="rounded-wedding-lg border-wedding-gold bg-wedding-ivory-bg shadow-wedding-gold border-2 p-4"
                                >
                                    <div class="flex items-start">
                                        <CheckCircle
                                            class="mt-0.5 mr-2 h-5 w-5 text-green-600"
                                        />
                                        <div>
                                            <h3
                                                class="font-wedding-semibold text-green-900"
                                            >
                                                Ready to Submit
                                            </h3>
                                            <p
                                                class="font-wedding-body mt-1 text-sm text-green-700"
                                            >
                                                Click the submit button below to
                                                complete your RSVP. You'll
                                                receive a confirmation email
                                                shortly.
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
                                    class="btn-wedding-secondary wedding-hover-lift wedding-touch-target-lg order-2 sm:order-1"
                                    @click="previousStep"
                                    :disabled="
                                        currentStep === 0 || isSubmitting
                                    "
                                >
                                    <ArrowLeft class="mr-2 h-4 w-4" />
                                    <span class="text-sm sm:text-base"
                                        >Previous</span
                                    >
                                </button>

                                <button
                                    v-if="currentStep < 5"
                                    type="button"
                                    class="btn-wedding-primary wedding-hover-lift wedding-touch-target-lg order-1 sm:order-2"
                                    @click="nextStep"
                                    :disabled="!canProceed || isSubmitting"
                                >
                                    <span class="text-sm sm:text-base"
                                        >Next</span
                                    >
                                    <ArrowRight class="ml-2 h-4 w-4" />
                                </button>

                                <button
                                    v-if="currentStep === 5"
                                    type="submit"
                                    class="btn-wedding-accent wedding-hover-lift wedding-touch-target-lg order-1 sm:order-2"
                                    :disabled="isSubmitting || !canSubmit"
                                >
                                    <div
                                        v-if="isSubmitting"
                                        class="wedding-loading border-wedding-navy mr-2 h-4 w-4 rounded-full border-b-2"
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
                    </CardContent>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>

<style scoped>
/* Component-specific styles that enhance the wedding theme */
.wedding-step-indicator {
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

/* Mobile-specific adjustments that complement the wedding theme */
@media (max-width: 639px) {
    .wedding-step:not(:last-child)::after {
        content: '';
        position: absolute;
        top: 24px;
        left: 20px;
        width: 2px;
        height: 20px;
        background: var(--wedding-blush-light);
        z-index: 1;
    }

    .wedding-step.completed::after {
        background: var(--wedding-gold);
    }
}

/* Tablet-specific adjustments */
@media (min-width: 640px) and (max-width: 1023px) {
    .wedding-step-circle {
        width: 56px;
        height: 56px;
        font-size: 1.125rem;
    }

    .wedding-step-label {
        max-width: 90px;
        font-size: 0.8rem;
    }
}

/* Desktop-specific adjustments */
@media (min-width: 1024px) {
    .wedding-step-circle {
        width: 64px;
        height: 64px;
        font-size: 1.25rem;
    }

    .wedding-step-label {
        max-width: 120px;
        font-size: 0.9rem;
    }
}

/* Small mobile adjustments */
@media (max-width: 374px) {
    .wedding-step-circle {
        width: 40px;
        height: 40px;
        font-size: 0.875rem;
    }

    .wedding-step-label {
        font-size: 0.75rem;
        margin-left: 0.75rem;
    }
}

/* Enhanced Loading Animation */
.wedding-loading {
    position: relative;
    pointer-events: none;
    opacity: 0.7;
}

.wedding-loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid var(--wedding-gold);
    border-radius: 50%;
    border-top-color: transparent;
    animation: wedding-pulse-ring 1.5s ease-out infinite;
}

/* Enhanced Form Validation States */
.input-wedding.error,
.textarea-wedding.error {
    animation: wedding-shake 0.5s ease-in-out;
    border-color: var(--wedding-blush-dark);
    background: rgba(232, 180, 184, 0.1);
}

.input-wedding.success,
.textarea-wedding.success {
    animation: wedding-success-glow 2s ease-in-out;
    border-color: var(--wedding-gold);
    background: rgba(212, 175, 55, 0.05);
}

/* Enhanced Focus States */
.input-wedding:focus,
.textarea-wedding:focus {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(212, 175, 55, 0.2);
    animation: wedding-focus-pulse 2s ease-in-out infinite;
}

/* Enhanced Hover Effects */
.btn-wedding-primary:hover,
.btn-wedding-secondary:hover,
.btn-wedding-accent:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.wedding-hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(212, 175, 55, 0.3);
}

.wedding-hover-scale:hover {
    transform: scale(1.05);
}

.wedding-hover-glow:hover {
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3);
}

/* Animation Delays for Staggered Effects */
.wedding-animate-fade-in-up[style*='animation-delay: 0.2s'],
.wedding-animate-fade-in-down[style*='animation-delay: 0.2s'],
.wedding-animate-scale-in[style*='animation-delay: 0.2s'] {
    animation-delay: 0.2s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.3s'],
.wedding-animate-fade-in-down[style*='animation-delay: 0.3s'],
.wedding-animate-scale-in[style*='animation-delay: 0.3s'] {
    animation-delay: 0.3s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.4s'],
.wedding-animate-fade-in-down[style*='animation-delay: 0.4s'],
.wedding-animate-scale-in[style*='animation-delay: 0.4s'] {
    animation-delay: 0.4s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.5s'],
.wedding-animate-fade-in-down[style*='animation-delay: 0.5s'],
.wedding-animate-scale-in[style*='animation-delay: 0.5s'] {
    animation-delay: 0.5s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.6s'],
.wedding-animate-fade-in-down[style*='animation-delay: 0.6s'],
.wedding-animate-scale-in[style*='animation-delay: 0.6s'] {
    animation-delay: 0.6s !important;
}

.wedding-animate-fade-in-up[style*='animation-delay: 0.8s'],
.wedding-animate-fade-in-down[style*='animation-delay: 0.8s'],
.wedding-animate-scale-in[style*='animation-delay: 0.8s'] {
    animation-delay: 0.8s !important;
}
</style>

<script setup lang="ts">
import { CardContent } from '@/components/ui/card';
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
                    'This group has already submitted an RSVP. Please contact the couple if you need to make changes.';
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
