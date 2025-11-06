# SEO Implementation Guide for Laravel + Inertia + Vue

This guide explains how the SEO implementation works for your wedding RSVP application.

## 🎯 Problem Solved

Your Laravel + Inertia + Vue application was not rendering SEO meta tags properly because:

- Meta tags were only added client-side after JavaScript loaded
- Search engines and social media crawlers couldn't see the dynamic content
- "View Page Source" showed empty meta tags

## ✅ Solution Implemented

### 1. Server-Side Rendering (SSR) Configuration

- **SSR enabled** in `config/inertia.php`
- **SSR middleware** created at `app/Http/Middleware/HandleInertiaSSR.php`
- **SSR build script** at `resources/js/ssr.ts`
- **Auto-registered** in `bootstrap/app.php`

### 2. SEO Meta Tags in Blade Templates

- **Server-rendered meta tags** in `resources/views/wedding.blade.php`
- **Dynamic SEO data** passed from Laravel middleware
- **Route-specific SEO** for different pages
- **Complete Open Graph** and **Twitter Card** support

### 3. Enhanced Middleware

- **SEO data sharing** in `HandleInertiaRequests.php`
- **Route-specific meta tags** for home, RSVP, confirmation, and legacy pages
- **Structured data** support for wedding events

## 🚀 How to Use

### Build for Production with SSR

```bash
# Build both client and SSR assets
npm run build:ssr:full

# Or manually:
npm run build:ssr
```

### Start SSR Server

```bash
# Start the SSR rendering server
node bootstrap/ssr/ssr.mjs
```

### Start Laravel Application

```bash
# Start your Laravel app
php artisan serve
```

### Test SEO Implementation

```bash
# Test SEO meta tags rendering
npm run test:seo

# Or with custom URL
APP_URL=https://yourdomain.com npm run test:seo
```

## 📋 What's Included

### SEO Meta Tags

- ✅ **Title tags** with route-specific content
- ✅ **Meta descriptions** for each page
- ✅ **Open Graph tags** for Facebook/LinkedIn sharing
- ✅ **Twitter Card tags** for Twitter sharing
- ✅ **Canonical URLs** for SEO best practices
- ✅ **Structured data** for wedding events
- ✅ **Image meta tags** with proper dimensions

### SSR Features

- ✅ **Server-side rendering** for all public routes
- ✅ **Automatic SSR bundle** management
- ✅ **SEO-friendly HTML** output
- ✅ **Fast page loads** with pre-rendered content

## 🔧 Configuration

### Routes with SEO

- `/` - Home page with wedding invitation
- `/mobile` - Mobile-optimized version
- `/legacy` - Legacy/love story page
- `/rsvp` - RSVP form page
- `/rsvp/confirmation` - RSVP confirmation page

### SEO Data Structure

```php
'seo' => [
    'title' => 'Page Title',
    'description' => 'Page description for SEO',
    'keywords' => 'relevant,keywords,for,seo',
    'image' => '/images/meta-image.png',
    'url' => 'https://yourdomain.com/page',
    'type' => 'website',
    'locale' => 'en_US',
    'site_name' => 'James & Dannica',
]
```

## 🧪 Testing

### Automated SEO Testing

Run the automated SEO test to verify implementation:

```bash
npm run test:seo
```

This will test:

- ✅ Title tag presence
- ✅ Meta description
- ✅ Open Graph tags
- ✅ Twitter Card tags
- ✅ Canonical URL
- ✅ SSR content rendering

### Manual Testing

1. **View Page Source** - Check HTML source for meta tags
2. **Facebook Debugger** - Test Open Graph tags
3. **Twitter Card Validator** - Test Twitter cards
4. **Google Rich Results** - Test structured data
5. **Lighthouse** - Test overall SEO score

## 🎯 Expected Results

After implementation, you should see:

### Before (Client-Side Only)

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Laravel</title>
        <!-- No dynamic meta tags -->
    </head>
    <body>
        <div id="app"></div>
        <script src="/build/app.js"></script>
    </body>
</html>
```

### After (With SSR + SEO)

```html
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>James & Dannica - Wedding Invitation</title>
        <meta
            name="description"
            content="Mark your calendars for our special day..."
        />
        <meta
            property="og:title"
            content="James & Dannica - Wedding Invitation"
        />
        <meta property="og:description" content="Mark your calendars..." />
        <meta property="og:image" content="/images/meta-image.png" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta
            name="twitter:title"
            content="James & Dannica - Wedding Invitation"
        />
        <link rel="canonical" href="https://jamesdannica.site/" />
        <!-- Complete SEO meta tags -->
    </head>
    <body>
        <div id="app">
            <!-- Pre-rendered content -->
            <h1>James & Dannica</h1>
            <p>Wedding invitation content...</p>
        </div>
        <script src="/build/app.js"></script>
    </body>
</html>
```

## 🔄 Deployment Notes

### Production Deployment

1. Build SSR assets: `npm run build:ssr:full`
2. Deploy `public/build/` directory
3. Deploy `bootstrap/ssr/ssr.mjs` file
4. Start SSR server on production
5. Configure process manager (PM2, Supervisor) for SSR server

### Environment Variables

```env
VITE_APP_NAME="James & Dannica"
APP_URL="https://jamesdannica.site"
```

## 🛠️ Troubleshooting

### SSR Not Working

- Check SSR server is running: `node bootstrap/ssr/ssr.mjs`
- Verify `config/inertia.php` has SSR enabled
- Check `bootstrap/ssr/ssr.mjs` exists

### Meta Tags Missing

- Verify `wedding.blade.php` template includes SEO variables
- Check `HandleInertiaRequests.php` shares SEO data
- Test with `npm run test:seo`

### Build Issues

- Clear cache: `php artisan cache:clear`
- Rebuild: `npm run build:ssr:full`
- Check Node.js version compatibility

## 📈 SEO Benefits

With this implementation:

- ✅ **Search engines** can index your content properly
- ✅ **Social media** previews will show rich content
- ✅ **Page load** performance improved with SSR
- ✅ **SEO scores** will be significantly higher
- ✅ **Rich snippets** possible with structured data

## 🎉 Success Metrics

Your SEO implementation is successful when:

- Page source shows complete meta tags
- Social media previews display correctly
- Google search results show rich snippets
- Lighthouse SEO score > 90
- All automated tests pass

---

**Enjoy your SEO-optimized wedding RSVP application!** 🎊
