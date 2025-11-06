import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createSSRApp, DefineComponent, h } from 'vue';
import { renderToString } from 'vue/server-renderer';

const appName = import.meta.env.VITE_APP_NAME || 'James & Dannica';

createServer(
    (page) =>
        createInertiaApp({
            page,
            render: renderToString,
            title: (title) => {
                // Use the SEO title from page props if available, otherwise use the title
                const seoTitle = (page.props as any)?.seo?.title || title;
                return seoTitle ? `${seoTitle}` : appName;
            },
            resolve: (name) =>
                resolvePageComponent(
                    `./pages/${name}.vue`,
                    import.meta.glob<DefineComponent>('./pages/**/*.vue'),
                ),
            setup: ({ App, props, plugin }) => {
                // Ensure SEO props are available during SSR
                const app = createSSRApp({ render: () => h(App, props) });
                app.use(plugin);

                // Add SEO meta tags to head during SSR
                if ((props as any)?.page?.props?.seo) {
                    const seo = (props as any).page.props.seo;

                    // Set document title
                    if (seo.title) {
                        app.config.globalProperties.$title = seo.title;
                    }
                }

                return app;
            },
        }),
    {
        cluster: true,
    },
);
