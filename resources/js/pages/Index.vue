<script lang="ts" setup>
import NonResponsiveWrapper from '@/components/NonResponsiveWrapper.vue';
import { Bell, Gift } from 'lucide-vue-next';
</script>
<template>
    <NonResponsiveWrapper>
        <section
            class="relative h-screen w-full overflow-hidden bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/f1-bg.png')"
        >
            <div class="grid h-full w-full place-items-center px-10 py-20">
                <div class="relative m-auto mb-6 w-fit">
                    <div
                        class="absolute -top-16 left-1/2 w-[110%] -translate-x-1/2"
                    >
                        <OptimizedImage src="/images/Paragraph.svg" alt="" class="w-full" loading="lazy" />
                    </div>
                    <p
                        class="font-wedding-heading absolute top-1/2 right-[105%] -translate-y-1/2 text-[7rem] text-white"
                    >
                        James
                    </p>
                    <div
                        class="aspect-[526/682] w-[526px] overflow-hidden rounded-t-full"
                    >
                        <OptimizedImage src="/images/frame5.webp" alt="" class="h-full w-full object-cover" loading="lazy" />
                    </div>
                    <p
                        class="font-wedding-heading absolute top-1/2 left-[105%] -translate-y-1/2 text-[6rem] text-white"
                    >
                        Dannica
                    </p>
                </div>
                <p
                    class="font-wedding-body text-center text-4xl tracking-widest text-white"
                >
                    DECEMBER 12, 2025
                </p>
            </div>
        </section>
        <section class="bg-[#ebddd7]">
            <div class="flex items-center space-x-20 py-20 pr-10 pl-20">
                <div class="w-6/12">
                    <div class="aspect-[558/714] overflow-hidden rounded-3xl">
                        <OptimizedImage src="/images/test1.webp" alt="" class="h-full w-full object-cover" loading="lazy" />
                    </div>
                </div>
                <div class="w-6/12 text-center text-[#4c0211]">
                    <p class="text-center text-3xl">
                        YOU’RE INVITED TO THE WEDDING OF
                    </p>
                    <div class="mb-10">
                        <p
                            class="font-wedding-heading text-[10rem] leading-[1]"
                        >
                            James &
                        </p>
                        <p
                            class="font-wedding-heading text-[10rem] leading-[1]"
                        >
                            Dannica
                        </p>
                    </div>
                    <p class="mb-10 text-3xl uppercase">
                        Saturday, <strong>December 12, 2025</strong>
                    </p>
                    <div class="flex w-full justify-between space-x-7">
                        <div class="w-1/4">
                            <div
                                class="mb-5 grid aspect-square place-items-center rounded-2xl border-2 border-[#4c0211] text-6xl font-bold"
                            >
                                0
                            </div>
                            <p
                                class="font-wedding-body text-2xl font-medium uppercase"
                            >
                                Days
                            </p>
                        </div>
                        <div class="w-1/4">
                            <div
                                class="mb-5 grid aspect-square place-items-center rounded-2xl border-2 border-[#4c0211] text-6xl font-bold"
                            >
                                0
                            </div>
                            <p
                                class="font-wedding-body text-2xl font-medium uppercase"
                            >
                                Hours
                            </p>
                        </div>
                        <div class="w-1/4">
                            <div
                                class="mb-5 grid aspect-square place-items-center rounded-2xl border-2 border-[#4c0211] text-6xl font-bold"
                            >
                                0
                            </div>
                            <p
                                class="font-wedding-body text-2xl font-medium uppercase"
                            >
                                Minutes
                            </p>
                        </div>
                        <div class="w-1/4">
                            <div
                                class="mb-5 grid aspect-square place-items-center rounded-2xl border-2 border-[#4c0211] text-6xl font-bold"
                            >
                                0
                            </div>
                            <p
                                class="font-wedding-body text-2xl font-medium uppercase"
                            >
                                Seconds
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <section
        class="relative min-h-screen w-full overflow-hidden bg-cover bg-center bg-no-repeat"
        style="background-image: url('/images/f1-bg.png')"
    >
        <div class="p-20 text-center text-white">
            <h1 class="font-wedding-accent text-[11rem]">Our Story</h1>
            <div>
                <p class="font-playfair text-5xl leading-[1.2]">
                    We met at work. Just two people figuring out life and
                    everything in between. What started as casual after-work
                    hangouts quickly turned into something special. We became
                    inseparable, sharing laughs, long talks, late-night
                    messages, and countless memories. Over five years, our
                    friendship grew into a bond we couldn’t ignore. <br /><br />

                    We were best friends first, and that foundation made
                    everything stronger when we finally decided to give “us” a
                    real shot. Somewhere along the way, friendship turned into
                    love.. The kind that feels easy, steady, and real.
                    <br /><br />

                    We've stood by each other through life’s highs and lows,
                    always choosing one another, always finding home in each
                    other. Now, eight years later, here we are.. writing the
                    next chapter of our story. The rest, as they say, is
                    history… and the best is still to come.
                </p>
            </div>
        </div>
    </section> -->
        <section>
            <div class="aspect-[1392/636] w-full">
                <OptimizedImage src="/images/hero.webp" alt="" class="h-full w-full object-cover" loading="lazy" />
            </div>
        </section>
        <section class="bg-[#ebddd7]">
            <div class="p-20 text-[#4c0511]">
                <p
                    class="font-wedding-accent text-center text-[8rem] tracking-widest"
                >
                    Wedding Timeline
                </p>
                <div class="mb-10 grid grid-cols-3 gap-10">
                    <div
                        class="space-y-4 rounded-2xl bg-[#4c0511] p-6 text-center text-white"
                    >
                        <div class="mx-auto w-[51px]">
                            <OptimizedImage src="/images/location.png" alt="location" class="w-full" loading="lazy" />
                        </div>
                        <p class="font-playfair text-7xl">2:00 PM</p>
                        <p class="font-playfair text-5xl">Arrival</p>
                    </div>
                    <div
                        class="space-y-4 rounded-2xl bg-[#4c0511] p-6 text-center text-white"
                    >
                        <div class="mx-auto w-[94px]">
                            <OptimizedImage src="/images/ring.png" alt="location" class="w-full" loading="lazy" />
                        </div>
                        <p class="font-playfair text-7xl">3:00 PM</p>
                        <p class="font-playfair text-5xl">Ceremony</p>
                    </div>
                    <div
                        class="space-y-4 rounded-2xl bg-[#4c0511] p-6 text-center text-white"
                    >
                        <div class="mx-auto w-[68px]">
                            <OptimizedImage src="/images/toast.png" alt="location" class="w-full" loading="lazy" />
                        </div>
                        <p class="font-playfair text-7xl">6:00 PM</p>
                        <p class="font-playfair text-5xl">Reception</p>
                    </div>
                </div>
                <div class="flex items-center justify-between space-x-10">
                    <div class="w-1/2 space-y-6">
                        <p
                            class="text-center font-playfair text-6xl tracking-widest text-[#4c0511] uppercase"
                        >
                            Ceremony
                        </p>
                        <div
                            class="mx-auto aspect-[490/580] w-fit rounded-3xl border-2 border-[#4c0511] p-5"
                        >
                            <OptimizedImage src="/images/san-agustin.jpg" alt="image" class="h-full w-full rounded-2xl object-cover" loading="lazy" />
                        </div>
                        <p class="text-center font-playfair text-5xl">
                            San Agustine Church
                        </p>
                        <div
                            class="mx-auto w-fit cursor-pointer rounded-full bg-[#4c0511] px-20 py-10 text-4xl font-bold text-white"
                        >
                            View Map
                        </div>
                    </div>
                    <div class="w-1/2 space-y-6">
                        <p
                            class="text-center font-playfair text-6xl tracking-widest text-[#4c0511] uppercase"
                        >
                            Reception
                        </p>
                        <div
                            class="mx-auto aspect-[490/580] w-fit rounded-3xl border-2 border-[#4c0511] p-5"
                        >
                            <OptimizedImage src="/images/la-castellana.jpg" alt="image" class="h-full w-full rounded-2xl object-cover" loading="lazy" />
                        </div>
                        <p class="text-center font-playfair text-5xl">
                            La Castellana
                        </p>
                        <div
                            class="mx-auto w-fit cursor-pointer rounded-full bg-[#4c0511] px-20 py-10 text-4xl font-bold text-white"
                        >
                            View Map
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="aspect-[1392/636] w-full">
                <OptimizedImage src="/images/rsvp.webp" alt="rsvp" class="h-full w-full object-cover" loading="lazy" />
            </div>
        </section>
        <section
            class="relative min-h-screen w-full overflow-hidden bg-cover bg-center bg-no-repeat"
            style="background-image: url('/images/f1-bg.png')"
        >
            <div class="p-20 text-white">
                <div>
                    <p
                        class="font-wedding-accent text-center text-[8rem] tracking-widest"
                    >
                        Tejada - Villaluz
                    </p>
                    <p
                        class="font-wedding-accent text-center text-[8rem] tracking-widest"
                    >
                        The Entourage
                    </p>
                </div>

                <!-- Parents -->
                <div class="mb-20 grid grid-cols-2 gap-20">
                    <div class="space-y-4 text-right font-primary">
                        <p class="text-3xl font-bold uppercase">
                            Parents of the Bride
                        </p>
                        <div class="space-y-3">
                            <p class="text-3xl">Mr. Danilo R. Tejada</p>
                            <p class="text-3xl">Mrs. Elona L. Tejada</p>
                        </div>
                    </div>
                    <div class="space-y-4 font-primary">
                        <p class="text-3xl font-bold uppercase">
                            Parents of the Groom
                        </p>
                        <div class="space-y-3">
                            <p class="text-3xl">Mr. Jesus R. Villaluz</p>
                            <p class="text-3xl">Mrs. Imelda D. Villaluz</p>
                        </div>
                    </div>
                </div>

                <!-- Principal Sponsors -->
                <div class="mb-16">
                    <p
                        class="font-wedding-accent mb-10 text-center text-[5rem] tracking-widest"
                    >
                        Principal Sponsors
                    </p>
                    <div class="grid grid-cols-2 gap-x-20 gap-y-4 text-3xl">
                        <p class="text-right">Mr. Teddy R. Vinzon</p>
                        <p>Mrs. Carmela C. Vinzon</p>
                        <p class="text-right">Mr. Erick J. Santos</p>
                        <p>Mrs. Jasmin D. Sarmiento</p>
                        <p class="text-right">Mr. Salvador R. Tejada Jr.</p>
                        <p>Mrs. Consuelo B. Bernardo</p>
                        <p class="text-right">Mr. Danilo C. Teofilo</p>
                        <p>Mrs. Ma. Leticia D. Teofilo</p>
                        <p class="text-right">Mr. Enrico Simon</p>
                        <p>Mrs. Elisa G. Simon</p>
                        <p class="text-right">Mr. Cristino Cuanang</p>
                        <p>Mrs. May Quimba</p>
                        <p class="text-right">Mr. Remilo Eguico</p>
                        <p>Mrs. Eway V. Castillo</p>
                        <p class="text-right">Mr. Michael Dingco</p>
                        <p>Mrs. Analyn P. Navarro</p>
                        <p class="text-right">Mr. Aries Torreleiza</p>
                        <p>Mrs. Cristina Torreleiza</p>
                        <p class="text-right">Chief Engr. Jaime Roncales</p>
                        <p>Mrs. Angelina Lamis</p>
                    </div>
                </div>

                <!-- Secondary Sponsors -->
                <div class="mb-16">
                    <p
                        class="font-wedding-accent mb-10 text-center text-[4rem] tracking-widest"
                    >
                        Secondary Sponsors
                    </p>
                    <div class="mb-16 grid grid-cols-2 gap-x-20">
                        <div>
                            <p
                                class="font-wedding-accent mb-4 text-right text-[4rem] tracking-widest"
                            >
                                Best Man
                            </p>
                            <div class="space-y-4 text-right text-3xl">
                                <p>Jemuel Christian D. Villaluz</p>
                            </div>
                        </div>
                        <div>
                            <p
                                class="font-wedding-accent mb-4 text-left text-[4rem] tracking-widest"
                            >
                                Matron of Honor
                            </p>
                            <div class="space-y-4 text-3xl">
                                <p>Ona Elledan Tejada-Bernardo</p>
                            </div>
                        </div>
                    </div>
                    <p
                        class="font-wedding-accent mb-6 text-center text-[3rem] tracking-widest"
                    >
                        <span class="text-[4rem]">T</span>o
                        <span class="text-[4rem]">L</span>ight
                        <span class="text-[4rem]">O</span>ur
                        <span class="text-[4rem]">P</span>ath
                    </p>
                    <div
                        class="mb-6 grid grid-cols-2 gap-x-20 gap-y-4 text-3xl"
                    >
                        <p class="text-right">Einar Jedrek D. Santos</p>
                        <p>Marion Joyce D. Sarmiento</p>
                    </div>
                    <p
                        class="font-wedding-accent mb-6 text-center text-[3rem] tracking-widest"
                    >
                        <span class="text-[4rem]">T</span>o
                        <span class="text-[4rem]">C</span>lothe
                        <span class="text-[4rem]">U</span>s
                        <span class="text-[4rem]">A</span>s
                        <span class="text-[4rem]">O</span>ne
                    </p>
                    <div
                        class="mb-6 grid grid-cols-2 gap-x-20 gap-y-4 text-3xl"
                    >
                        <p class="text-right">Einar Jedrek D. Santos</p>
                        <p>Marion Joyce D. Sarmiento</p>
                    </div>
                    <p
                        class="font-wedding-accent mb-6 text-center text-[3rem] tracking-widest"
                    >
                        <span class="text-[4rem]">T</span>o
                        <span class="text-[4rem]">B</span>ind
                        <span class="text-[4rem]">U</span>s
                        <span class="text-[4rem]">T</span>ogether
                    </p>
                    <div
                        class="mb-6 grid grid-cols-2 gap-x-20 gap-y-4 text-3xl"
                    >
                        <p class="text-right">John Dennis B. Bernardo</p>
                        <p>Jona Jane T. Gran</p>
                    </div>
                </div>

                <!-- Groomsmen and Bridesmaids -->
                <div class="mb-16">
                    <div class="grid grid-cols-2 gap-20">
                        <div>
                            <p
                                class="font-wedding-accent mb-10 text-right text-[4rem] tracking-widest"
                            >
                                Groomsmen
                            </p>
                            <div class="space-y-4 text-right text-3xl">
                                <p class="mt-4">Jerico N. Villaluz</p>
                                <p class="mt-4">Brian Paolo Rañeses</p>
                            </div>
                        </div>
                        <div>
                            <p
                                class="font-wedding-accent mb-10 text-[4rem] tracking-widest"
                            >
                                Bridesmaids
                            </p>
                            <div class="space-y-4 text-3xl">
                                <p class="mt-4">Ericka Jayne D. Santos</p>
                                <p class="mt-4">Eisha Eurice F. Valencia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bearers and Flower Girls -->
                <div>
                    <div class="grid grid-cols-3 gap-10 text-center">
                        <div>
                            <p
                                class="font-wedding-accent mb-6 text-[3rem] tracking-widest"
                            >
                                Coin Bearer
                            </p>
                            <p class="text-3xl">Emmanuel D. Aguilar</p>
                        </div>
                        <div>
                            <p
                                class="font-wedding-accent mb-6 text-[3rem] tracking-widest"
                            >
                                Bible Bearer
                            </p>
                            <p class="text-3xl">Kyle Dame F. Villaspin</p>
                        </div>
                        <div>
                            <p
                                class="font-wedding-accent mb-6 text-[3rem] tracking-widest"
                            >
                                Ring Bearer
                            </p>
                            <p class="text-3xl">Zeke Nikolai S. Sarmiento</p>
                        </div>
                    </div>

                    <div class="mt-16">
                        <p
                            class="font-wedding-accent mb-10 text-center text-[4rem] tracking-widest"
                        >
                            Flower Girls
                        </p>
                        <div class="grid grid-cols-2 gap-x-20 gap-y-4 text-3xl">
                            <p class="text-right">Julia Dennise T. Bernardo</p>
                            <p>Elliyah Jhay D. Santos</p>
                            <p class="text-right text-2xl">Little Bride</p>
                            <p class="text-2xl">Flower Lady</p>
                            <p class="text-right">Eiryn Jessy D. Santos</p>
                            <p>Meiryne Joie D. Sarmiento</p>
                            <p class="text-right text-2xl">Flower Lady</p>
                            <p class="text-2xl">Flower Lady</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-[#e6cabf]">
            <div class="grid grid-cols-2 gap-10 p-20">
                <div class="aspect-[612/790] overflow-hidden rounded-xl">
                    <OptimizedImage src="/images/frame5.webp" alt="" class="h-full w-full object-cover" loading="lazy" />
                </div>
                <div class="aspect-[612/790] overflow-hidden rounded-xl">
                    <OptimizedImage src="/images/hero.webp" alt="" class="h-full w-full object-cover" loading="lazy" />
                </div>
                <div class="aspect-[612/790] overflow-hidden rounded-xl">
                    <OptimizedImage src="/images/element2.png" alt="" class="h-full w-full object-cover" loading="lazy" />
                </div>
                <div class="aspect-[612/790] overflow-hidden rounded-xl">
                    <OptimizedImage src="/images/test1.webp" alt="" class="h-full w-full object-cover" loading="lazy" />
                </div>
            </div>
        </section>
        <section class="bg-[#ebddd7]">
            <div class="m-auto max-w-[1000px] p-20 text-center text-[#4c0211]">
                <p class="font-wedding-accent text-[9rem]">Dress Motif</p>
                <p
                    class="mb-10 text-justify font-playfair text-3xl leading-[1.5] uppercase"
                >
                    As the <strong>bride will only be the one in white</strong>,
                    we encourage you to dress according to our wedding color
                </p>
                <p class="font-wedding-accent text-[5rem]">
                    Principal Sponsors
                </p>
                <div class="m-auto w-[400px]">
                    <OptimizedImage src="/images/color-pallete.png" alt="" class="" loading="lazy" />
                </div>
                <div
                    class="m-auto mb-16 flex w-fit -translate-x-7 items-center justify-between space-x-24 text-2xl"
                >
                    <p>Champagne</p>
                    <p>Gold</p>
                </div>

                <p class="font-wedding-accent mb-10 text-[5rem]">Guest</p>
                <div class="rounded-5 mb-16 grid grid-cols-4 gap-10">
                    <div>
                        <div
                            class="mb-4 aspect-square rounded-full border-2 border-[#4c0211] bg-[#f6d7d7]"
                        ></div>
                        <p class="text-2xl">Dusty Rose</p>
                    </div>
                    <div>
                        <div
                            class="mb-4 aspect-square rounded-full border-2 border-[#4c0211] bg-[#e8b7b0]"
                        ></div>
                        <p class="text-2xl">Coral</p>
                    </div>
                    <div>
                        <div
                            class="mb-4 aspect-square rounded-full border-2 border-[#4c0211] bg-[#d89a92]"
                        ></div>
                        <p class="text-2xl">Terracotta</p>
                    </div>
                    <div>
                        <div
                            class="mb-4 aspect-square rounded-full border-2 border-[#4c0211] bg-[#c77a6f]"
                        ></div>
                        <p class="text-2xl">Burnt Sienna</p>
                    </div>
                </div>
                <p class="font-wedding-accent mb-10 text-[5rem]">Dress Code</p>
                <div class="mb- flex items-center space-x-6">
                    <div class="w-1/2">
                        <OptimizedImage src="/images/barong1.png" alt="" class="mx-auto h-[50vh]" loading="lazy" />
                        <p class="text-3xl">Gentlemen</p>
                        <p class="text-xl">Barong and Black pants</p>
                    </div>
                    <div class="w-1/2">
                        <OptimizedImage src="/images/dress1.png" alt="" class="mx-auto h-[50vh]" loading="lazy" />
                        <p class="text-3xl">Ladies</p>
                        <p class="text-xl">Filipiniana or Butterfly dress</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-[#ebddd7]">
            <div class="p-20 pt-0">
                <div class="grid grid-cols-3 gap-10">
                    <div
                        class="col-span-1 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <Gift class="m-auto mb-5 h-20 w-20" />
                        <p class="uppercase">Gift Note</p>
                    </div>
                    <div
                        class="col-span-2 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <p>
                            With all that we have, we've been truly blessed.
                            Your presence and prayers are all that we request.
                            But if you desire to give nonetheless, Monetary gift
                            is one we suggest.
                        </p>
                    </div>
                    <div
                        class="col-span-1 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <Bell class="m-auto mb-5 h-20 w-20" />
                        <p class="uppercase">RSVP<br />REMINDERS</p>
                    </div>
                    <div
                        class="col-span-2 grid place-items-center rounded-3xl bg-[#4c0211] p-6 text-center text-4xl text-white"
                    >
                        <p class="font-bold tracking-widest uppercase">
                            ADULTS ONLY
                        </p>
                        <p>
                            To allow all guests an evening of fun and
                            relaxation, we chose our wedding to be an adult only
                            affair.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-[#ebddd7]">
            <div class="m-auto max-w-[1000px] p-20 text-center text-[#4c0211]">
                <p class="font-wedding-accent text-[9rem]">RSVP</p>
                <p
                    class="mb-10 text-center font-playfair text-3xl leading-[1.5]"
                >
                    Your presence is the greatest gift you could give us on our
                    special day. Please let us know if you can join us in
                    celebrating our love story.
                </p>
                <div class="m-auto w-fit">
                    <a
                        href="/rsvp"
                        class="inline-block cursor-pointer rounded-full bg-[#4c0211] px-20 py-10 text-4xl font-bold text-white transition-all duration-300 hover:scale-105 hover:bg-[#3a010d]"
                    >
                        RSVP Now
                    </a>
                </div>
                <p class="mt-10 font-playfair text-2xl italic">
                    Kindly respond until November 25, 2025
                    <br />
                    Person to contact for response:
                    <br />Dannica Tejada
                    <br />
                    <a href="">09665898647</a>
                </p>
            </div>
        </section>
    </NonResponsiveWrapper>
</template>
<style></style>
