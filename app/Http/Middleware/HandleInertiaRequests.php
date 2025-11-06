<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the root template to be used based on request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function rootView(Request $request): string
    {
        if ($request->route()->named('home')) {
            return 'wedding';
        }

        if ($request->route()->named('home.mobile')) {
            return 'wedding';
        }

        if ($request->route()->named('legacy')) {
            return 'wedding';
        }

        if ($request->route()->named('rsvp.create')) {
            return 'wedding';
        }

        if ($request->route()->named('rsvp.confirmation')) {
            return 'wedding';
        }

        return 'app';
    }

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        [$message, $author] = str(Inspiring::quotes()->random())->explode('-');

        // Get current route name for SEO
        $currentRoute = $request->route() ? $request->route()->getName() : '';

        // Default SEO meta data
        $seoData = [
            'title' => 'James & Dannica',
            'description' => 'Mark your calendars for our special day as we celebrate love and new beginnings. Two souls with but a single thought, two hearts that beat as one. Villaluz - Tejada Nuptial',
            'keywords' => 'wedding, James, Dannica, Villaluz, Tejada, marriage, celebration, RSVP, wedding ceremony, wedding reception, love story, wedding vows, nuptial',
            'author' => 'James & Dannica',
            'image' => '/images/meta-image.png',
            'url' => config('app.url') . $request->getRequestUri(),
            'type' => 'website',
            'locale' => 'en_US',
            'site_name' => 'James & Dannica',
        ];

        // Route-specific SEO data
        switch ($currentRoute) {
            case 'home':
                $seoData['title'] = 'James & Dannica - Wedding Invitation';
                $seoData['description'] = 'Mark your calendars for our special day as we celebrate love and new beginnings. Two souls with but a single thought, two hearts that beat as one. Villaluz - Tejada Nuptial';
                break;
            case 'rsvp.create':
                $seoData['title'] = 'RSVP - James & Dannica Wedding';
                $seoData['description'] = 'RSVP for James and Dannica wedding. Let us know if you can join us on our special day, December 12, 2025.';
                break;
            case 'rsvp.confirmation':
                $seoData['title'] = 'RSVP Confirmation - James & Dannica Wedding';
                $seoData['description'] = 'Thank you for your RSVP! We have received your response for James and Dannica wedding.';
                break;
            case 'legacy':
                $seoData['title'] = 'James & Dannica - Legacy';
                $seoData['description'] = 'A glimpse into our love story and journey together.';
                break;
        }

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'quote' => ['message' => trim($message), 'author' => trim($author)],
            'auth' => [
                'user' => $request->user(),
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
            'flash' => [
                'success' => $request->session()->get('success'),
                'error' => $request->session()->get('error'),
            ],
            'seo' => $seoData,
        ];
    }
}
