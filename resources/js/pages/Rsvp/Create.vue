<template>
    <PublicLayout
        title="RSVP - James & Dannica's Wedding"
        description="Please fill out this form to let us know if you can attend our special day"
        :showHeader="false"
        :showFooter="false"
    >
        <!-- Decorative Floral Corners with Enhanced Animations -->

        <div
            class="relative min-h-screen w-full overflow-hidden bg-cover bg-center bg-no-repeat py-20"
            style="background-image: url('/images/f1-bg.png')"
        >
            <div
                class="wedding-smooth-scroll wedding-container relative z-10 px-4 py-8 text-white sm:py-10 lg:py-12"
            >
                <div class="mx-auto max-w-4xl">
                    <!-- Header -->
                    <div
                        class="wedding-header wedding-animate-bounce-in mb-8 text-center sm:mb-10 lg:mb-12"
                    >
                        <h3
                            class="font-wedding-accent animateUp text-center text-[6rem] tracking-widest sm:text-[8rem]"
                        >
                            James & Dannica's Wedding
                        </h3>
                        <div
                            class="wedding-divider wedding-animate-gold-shimmer mt-4 mb-3 sm:mt-6 sm:mb-4"
                        ></div>
                        <p
                            class="animateUp mt-6 font-playfair text-3xl sm:text-4xl"
                            style="animation-delay: 0.3s"
                        >
                            We're so excited to celebrate with you!
                        </p>
                        <p
                            class="animateUp mt-4 font-playfair text-2xl sm:text-3xl"
                            style="animation-delay: 0.5s"
                        >
                            Please fill out this form to let us know if you can
                            attend our special day.
                        </p>
                    </div>

                    <!-- Wedding-themed Progress Bar -->
                    <div
                        class="wedding-animate-slide-up mb-8 sm:mb-10 lg:mb-12"
                    >
                        <div class="wedding-progress-container">
                            <div class="wedding-progress-bar">
                                <div
                                    class="wedding-progress-fill"
                                    :style="{ width: progressPercentage + '%' }"
                                ></div>
                            </div>
                            <div class="wedding-progress-steps">
                                <div
                                    v-for="(step, index) in steps"
                                    :key="index"
                                    class="wedding-progress-step"
                                    :class="{
                                        active: currentStep === index,
                                        completed: currentStep > index,
                                    }"
                                    @click="goToStep(index)"
                                >
                                    <div class="wedding-progress-dot">
                                        <CheckCircle
                                            v-if="currentStep > index"
                                            class="h-3 w-3 sm:h-4 sm:w-4"
                                        />
                                        <span
                                            v-else
                                            class="text-xs sm:text-sm"
                                            >{{ index + 1 }}</span
                                        >
                                    </div>
                                    <span
                                        class="wedding-progress-label text-xs sm:text-sm"
                                    >
                                        {{ step.title }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <div
                        class="animateUp rounded-3xl bg-[#ebddd7] p-6 shadow-2xl sm:p-8"
                        style="animation-delay: 0.2s"
                    >
                        <CardContent class="p-0 sm:p-8">
                            <form @submit.prevent="handleSubmit">
                                <!-- Step 1: Guest Identification -->
                                <div
                                    v-if="currentStep === 0"
                                    class="wedding-animate-page-transition space-y-6"
                                >
                                    <div class="text-center">
                                        <h3
                                            class="font-wedding-accent animateUp text-center text-[4rem] text-[#4c0511] sm:text-[5rem]"
                                        >
                                            Find My Invitation
                                        </h3>
                                        <div
                                            class="animateUp mx-auto mt-4 h-1 w-20 rounded bg-[#4c0511]"
                                        ></div>
                                        <p
                                            class="animateUp mt-4 font-playfair text-xl text-[#4c0511] sm:text-2xl"
                                        >
                                            Kindly enter your full name to find
                                            your invitation and RSVP
                                        </p>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <div
                                                class="relative flex flex-col items-center space-y-7"
                                            >
                                                <Input
                                                    id="guest_name"
                                                    v-model="
                                                        formData.guest_name
                                                    "
                                                    type="text"
                                                    placeholder="Enter your full name"
                                                    :disabled="isLoading"
                                                    required
                                                    class="mt-2 w-full rounded-lg border-2 border-[#4c0511] bg-white/90 px-4 py-3 pr-12 text-[#4c0511] transition-all duration-300 focus:ring-2 focus:ring-[#4c0511] focus:outline-none"
                                                    :class="{
                                                        error: errors.guest_name,
                                                        success:
                                                            guestFound &&
                                                            !errors.guest_name,
                                                    }"
                                                />
                                                <button
                                                    v-if="
                                                        !guestFound &&
                                                        !guestData
                                                    "
                                                    type="button"
                                                    @click="checkGuestName"
                                                    class="wedding-touch-target-lg rounded-full bg-[#4c0511] px-6 py-3 font-bold text-white transition-all duration-300 hover:scale-105 hover:bg-[#3a010d]"
                                                    :disabled="
                                                        isLoading ||
                                                        !formData.guest_name.trim()
                                                    "
                                                    title="Find My Invitation"
                                                >
                                                    Search
                                                </button>
                                            </div>
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
                                                class="wedding-loading h-8 w-8 rounded-full border-b-2 border-[#4c0511]"
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
                                            class="rounded-wedding-lg bg-wedding-ivory-bg shadow-wedding-soft wedding-animate-bounce-in wedding-success-animation border-2 border-[#4c0511] bg-white p-4"
                                        >
                                            <div
                                                class="flex flex-col items-center space-y-4"
                                            >
                                                <CheckCircle
                                                    class="mt-0.5 mr-2 h-7 w-7 text-[#4c0511]"
                                                />
                                                <div>
                                                    <h4
                                                        class="font-wedding-semibold text-normal text-center text-[#4c0511] lg:text-2xl"
                                                    >
                                                        Welcome,
                                                        {{
                                                            formData.guest_name
                                                        }}!
                                                        <br />
                                                        You have
                                                        {{
                                                            guestData?.group
                                                                ?.max_attendees
                                                        }}
                                                        reserved seat in your
                                                        name.
                                                    </h4>
                                                    <!-- <p
                                                    class="font-wedding-body mt-1 text-sm text-green-700"
                                                >
                                                    Group:
                                                    {{ guestData.group?.name }}
                                                </p> -->
                                                    <!-- <div
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
                                                </div> -->
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
                                                            This invitation has
                                                            already submitted an
                                                            RSVP. Please contact
                                                            the couple if you
                                                            need to make
                                                            changes.
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
                                                !isLoading &&
                                                errors.guest_name
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
                                                        invitation. Please check
                                                        the spelling of your
                                                        name or contact the
                                                        couple for assistance.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Attendance Confirmation -->
                                <div
                                    v-if="currentStep === 1"
                                    class="wedding-animate-page-transition space-y-6 text-center"
                                >
                                    <div>
                                        <h3
                                            class="font-wedding-accent animateUp text-center text-[4rem] text-[#4c0511] sm:text-[5rem]"
                                        >
                                            Will You Be Attending?
                                        </h3>
                                        <div
                                            class="animateUp mx-auto mt-4 h-1 w-20 rounded bg-[#4c0511]"
                                        ></div>
                                        <p
                                            class="animateUp mt-4 font-playfair text-xl text-[#4c0511] sm:text-2xl"
                                        >
                                            Let us know how many people from
                                            your group will be attending the
                                            wedding.
                                        </p>
                                    </div>

                                    <div
                                        v-if="guestData"
                                        class="mb-6 rounded-2xl border-2 border-[#4c0511] bg-white/90 p-4"
                                    >
                                        <!-- <p
                                        class="font-wedding-semibold wedding-navy"
                                    >
                                        Group: {{ guestData.group?.name }}
                                    </p> -->
                                        <p
                                            class="wedding-navy font-wedding-body"
                                        >
                                            Maximum attendees:
                                            {{ guestData.group?.max_attendees }}
                                        </p>
                                    </div>

                                    <div class="space-y-4 text-center">
                                        <div>
                                            <p
                                                for="attending_count"
                                                class="m-auto text-center font-bold text-[#4c0511]"
                                            >
                                                Number of Attendees
                                            </p>
                                            <div
                                                class="mt-4 flex items-center justify-center space-x-4 sm:space-x-6"
                                            >
                                                <button
                                                    type="button"
                                                    class="wedding-hover-scale wedding-touch-target-lg rounded-full bg-[#4c0511] px-4 py-2 text-white transition-all duration-300 hover:scale-105 hover:bg-[#3a010d]"
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
                                                    class="animateUp w-16 text-center text-2xl font-bold text-[#4c0511] sm:w-20 sm:text-3xl"
                                                >
                                                    {{
                                                        formData.attending_count
                                                    }}
                                                </div>
                                                <button
                                                    type="button"
                                                    class="wedding-hover-scale wedding-touch-target-lg rounded-full bg-[#4c0511] px-4 py-2 text-white transition-all duration-300 hover:scale-105 hover:bg-[#3a010d]"
                                                    @click="incrementAttendees"
                                                    :disabled="
                                                        formData.attending_count >=
                                                        (guestData?.group
                                                            ?.max_attendees ||
                                                            0)
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
                                                    formData.attending_count ===
                                                    0
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
                                        <h3
                                            class="font-wedding-accent animateUp text-center text-[4rem] text-[#4c0511] sm:text-[5rem]"
                                        >
                                            Message to the Couple
                                        </h3>
                                        <div
                                            class="animateUp mx-auto mt-4 h-1 w-20 rounded bg-[#4c0511]"
                                        ></div>
                                        <p
                                            class="animateUp mt-4 font-playfair text-xl text-[#4c0511] sm:text-2xl"
                                        >
                                            Share a special message or well
                                            wishes with us (optional).
                                        </p>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <Label
                                                for="message"
                                                class="font-bold text-[#4c0511]"
                                            >
                                                Your Message
                                            </Label>
                                            <Textarea
                                                id="message"
                                                v-model="formData.message"
                                                placeholder="Write your message here..."
                                                rows="5"
                                                maxlength="1000"
                                                class="mt-2 w-full rounded-lg border-2 border-[#4c0511] bg-white/90 px-4 py-3 text-[#4c0511] transition-all duration-300 focus:ring-2 focus:ring-[#4c0511] focus:outline-none"
                                            />
                                            <p
                                                class="mt-1 text-sm text-[#4c0511]"
                                            >
                                                {{
                                                    formData.message?.length ||
                                                    0
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
                                        <h3
                                            class="font-wedding-accent animateUp text-center text-[4rem] text-[#4c0511] sm:text-[5rem]"
                                        >
                                            Song Suggestion
                                        </h3>
                                        <div
                                            class="animateUp mx-auto mt-4 h-1 w-20 rounded bg-[#4c0511]"
                                        ></div>
                                        <p
                                            class="animateUp mt-4 font-playfair text-xl text-[#4c0511] sm:text-2xl"
                                        >
                                            Help us create the perfect playlist!
                                            Suggest a song that would make you
                                            want to dance (optional).
                                        </p>
                                    </div>

                                    <div class="space-y-4">
                                        <div>
                                            <Label
                                                for="song_suggestion"
                                                class="font-bold text-[#4c0511]"
                                            >
                                                Song Title & Artist
                                            </Label>
                                            <Input
                                                id="song_suggestion"
                                                v-model="
                                                    formData.song_suggestion
                                                "
                                                type="text"
                                                placeholder="e.g., 'Perfect - Ed Sheeran'"
                                                maxlength="255"
                                                class="mt-2 w-full rounded-lg border-2 border-[#4c0511] bg-white/90 px-4 py-3 text-[#4c0511] transition-all duration-300 focus:ring-2 focus:ring-[#4c0511] focus:outline-none"
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
                                        <h3
                                            class="font-wedding-accent animateUp text-center text-[4rem] text-[#4c0511] sm:text-[5rem]"
                                        >
                                            Email Address
                                        </h3>
                                        <div
                                            class="animateUp mx-auto mt-4 h-1 w-20 rounded bg-[#4c0511]"
                                        ></div>
                                        <p
                                            class="animateUp mt-4 font-playfair text-xl text-[#4c0511] sm:text-2xl"
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
                                                class="font-bold text-[#4c0511]"
                                            >
                                                Email Address
                                            </Label>
                                            <Input
                                                id="email"
                                                v-model="formData.email"
                                                type="email"
                                                placeholder="your.email@example.com"
                                                required
                                                class="mt-2 w-full rounded-lg border-2 border-[#4c0511] bg-white/90 px-4 py-3 text-[#4c0511] transition-all duration-300 focus:ring-2 focus:ring-[#4c0511] focus:outline-none"
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
                                        <h3
                                            class="font-wedding-accent animateUp text-center text-[4rem] text-[#4c0511] sm:text-[5rem]"
                                        >
                                            Review Your RSVP
                                        </h3>
                                        <div
                                            class="animateUp mx-auto mt-4 h-1 w-20 rounded bg-[#4c0511]"
                                        ></div>
                                        <p
                                            class="animateUp mt-4 font-playfair text-xl text-[#4c0511] sm:text-2xl"
                                        >
                                            Please review your information
                                            before submitting.
                                        </p>
                                    </div>

                                    <div
                                        class="space-y-6 rounded-2xl border-2 border-[#4c0511] bg-white/90 p-3 md:p-6"
                                    >
                                        <div>
                                            <h3
                                                class="text-wedding-xl font-bold text-[#4c0511]"
                                            >
                                                Guest Information
                                            </h3>
                                            <p
                                                class="text-wedding-lg mt-2 text-[#4c0511]"
                                            >
                                                {{ formData.guest_name }}
                                            </p>
                                            <!-- <p
                                            v-if="guestData"
                                            class="wedding-navy font-wedding-body mt-1 text-sm"
                                        >
                                            Group:
                                            {{ guestData.group?.name }}
                                        </p> -->
                                        </div>

                                        <div class="wedding-divider"></div>

                                        <div>
                                            <h3
                                                class="text-wedding-xl font-bold text-[#4c0511]"
                                            >
                                                Attendance
                                            </h3>
                                            <p
                                                class="text-wedding-lg mt-2 text-[#4c0511]"
                                            >
                                                {{ formData.attending_count }}
                                                {{
                                                    formData.attending_count ===
                                                    1
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
                                                class="text-wedding-xl font-bold text-[#4c0511]"
                                            >
                                                Message
                                            </h3>
                                            <p
                                                class="text-wedding-lg mt-2 whitespace-pre-wrap text-[#4c0511]"
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
                                                class="text-wedding-xl font-bold text-[#4c0511]"
                                            >
                                                Song Suggestion
                                            </h3>
                                            <p
                                                class="text-wedding-lg mt-2 text-[#4c0511]"
                                            >
                                                {{ formData.song_suggestion }}
                                            </p>
                                        </div>

                                        <div class="wedding-divider"></div>

                                        <div>
                                            <h3
                                                class="text-wedding-xl font-bold text-[#4c0511]"
                                            >
                                                Email
                                            </h3>
                                            <p
                                                class="text-wedding-lg mt-2 text-[#4c0511]"
                                            >
                                                {{ formData.email }}
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="rounded-2xl border-2 border-[#4c0511] bg-white/90 p-4"
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
                                                    Click the submit button
                                                    below to complete your RSVP.
                                                    You'll receive a
                                                    confirmation email shortly.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <div
                                    v-if="guestFound && guestData"
                                    class="mt-6 flex justify-between gap-4 sm:mt-8 sm:flex-row sm:gap-0"
                                >
                                    <button
                                        type="button"
                                        class="wedding-touch-target-lg flex w-full items-center justify-center rounded-full bg-[#4c0511] px-4 py-3 font-bold text-white transition-all duration-300 hover:scale-105 hover:bg-[#3a010d] sm:w-1/2 sm:px-6 lg:w-auto"
                                        @click="previousStep"
                                        :disabled="
                                            currentStep === 0 || isSubmitting
                                        "
                                    >
                                        <ArrowLeft
                                            class="mr-2 h-4 w-4 sm:mr-3 sm:h-5 sm:w-5"
                                        />
                                        <span class="text-sm sm:text-base"
                                            >Previous</span
                                        >
                                    </button>

                                    <button
                                        v-if="currentStep < 5"
                                        type="button"
                                        class="wedding-touch-target-lg flex w-full items-center justify-center rounded-full bg-[#4c0511] px-4 py-3 font-bold text-white transition-all duration-300 hover:scale-105 hover:bg-[#3a010d] sm:w-1/2 sm:px-6 lg:w-auto"
                                        @click="nextStep"
                                        :disabled="!canProceed || isSubmitting"
                                    >
                                        <span class="text-sm sm:text-base"
                                            >Next</span
                                        >
                                        <ArrowRight
                                            class="ml-2 h-4 w-4 sm:ml-3 sm:h-5 sm:w-5"
                                        />
                                    </button>

                                    <button
                                        v-if="currentStep === 5"
                                        type="submit"
                                        class="wedding-touch-target-lg flex w-full items-center justify-center rounded-full bg-[#4c0511] px-4 py-3 font-bold text-white transition-all duration-300 hover:scale-105 hover:bg-[#3a010d] sm:w-1/2 sm:px-6 lg:w-auto"
                                        :disabled="isSubmitting || !canSubmit"
                                    >
                                        <div
                                            v-if="isSubmitting"
                                            class="wedding-loading mr-2 h-4 w-4 rounded-full border-b-2 border-white sm:mr-3 sm:h-5 sm:w-5"
                                        ></div>
                                        <span class="text-sm sm:text-base">
                                            {{
                                                isSubmitting
                                                    ? 'Submitting...'
                                                    : 'Submit RSVP'
                                            }}
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </CardContent>
                    </div>
                </div>
            </div>
        </div>
    </PublicLayout>
</template>

<style scoped>
/* Component-specific styles that enhance the wedding theme */
.wedding-progress-container {
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
}

.wedding-progress-bar {
    width: 100%;
    height: 8px;
    background: var(--wedding-blush-light);
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 1rem;
    position: relative;
}

.wedding-progress-fill {
    height: 100%;
    background: linear-gradient(
        90deg,
        var(--wedding-gold),
        var(--wedding-gold-dark)
    );
    border-radius: 4px;
    transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.wedding-progress-fill::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        90deg,
        transparent,
        rgba(255, 255, 255, 0.3),
        transparent
    );
    animation: wedding-progress-shimmer 2s ease-in-out infinite;
}

.wedding-progress-steps {
    display: flex;
    justify-content: space-between;
    position: relative;
}

.wedding-progress-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.wedding-progress-step.completed {
    cursor: pointer;
}

.wedding-progress-step:not(.completed):not(.active) {
    cursor: not-allowed;
    opacity: 0.7;
}

.wedding-progress-dot {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--wedding-ivory);
    border: 2px solid var(--wedding-blush-light);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--wedding-navy);
    font-weight: 600;
    margin-bottom: 0.5rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 2;
}

.wedding-progress-step.active .wedding-progress-dot {
    background: var(--wedding-gold);
    border-color: var(--wedding-gold);
    color: white;
    transform: scale(1.1);
    box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.2);
    animation: wedding-progress-active 2s ease-in-out infinite;
}

.wedding-progress-step.completed .wedding-progress-dot {
    background: var(--wedding-gold);
    border-color: var(--wedding-gold);
    color: white;
    animation: wedding-progress-complete 0.6s ease-out;
}

.wedding-progress-label {
    font-size: 0.75rem;
    font-weight: 500;
    color: white;
    text-align: center;
    max-width: 80px;
    line-height: 1.2;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.wedding-progress-step.active .wedding-progress-label {
    color: white;
    font-weight: 600;
}

.wedding-progress-step.completed .wedding-progress-label {
    color: white;
    font-weight: 600;
}

/* Mobile-specific adjustments */
@media (max-width: 639px) {
    .wedding-progress-dot {
        width: 28px;
        height: 28px;
    }

    .wedding-progress-label {
        font-size: 0.7rem;
        max-width: 60px;
    }
}

/* Tablet-specific adjustments */
@media (min-width: 640px) and (max-width: 1023px) {
    .wedding-progress-dot {
        width: 30px;
        height: 30px;
    }

    .wedding-progress-label {
        font-size: 0.725rem;
        max-width: 70px;
    }
}

/* Desktop-specific adjustments */
@media (min-width: 1024px) {
    .wedding-progress-dot {
        width: 32px;
        height: 32px;
    }

    .wedding-progress-label {
        font-size: 0.75rem;
        max-width: 80px;
    }
}

/* Small mobile adjustments */
@media (max-width: 374px) {
    .wedding-progress-dot {
        width: 24px;
        height: 24px;
    }

    .wedding-progress-label {
        font-size: 0.65rem;
        max-width: 50px;
    }
}

/* Animations */
@keyframes wedding-progress-shimmer {
    0% {
        transform: translateX(-100%);
    }
    100% {
        transform: translateX(100%);
    }
}

@keyframes wedding-progress-active {
    0%,
    100% {
        transform: scale(1.1);
        box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.2);
    }
    50% {
        transform: scale(1.15);
        box-shadow: 0 0 0 6px rgba(212, 175, 55, 0.3);
    }
}

@keyframes wedding-progress-complete {
    0% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.2);
    }
    100% {
        transform: scale(1);
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

// Watch for changes in guest name to reset guest found status only when field is empty
watch(
    () => formData.value.guest_name,
    (newValue) => {
        // Reset guest found status only when field is completely empty
        if (newValue === '') {
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
                    'This invitation has already submitted an RSVP. Please contact the couple if you need to make changes.';
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
