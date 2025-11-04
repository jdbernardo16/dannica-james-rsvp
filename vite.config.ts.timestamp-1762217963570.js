// vite.config.ts
import { wayfinder } from "@laravel/vite-plugin-wayfinder";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";
import imageminWebp from "imagemin-webp";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";
import compression from "vite-plugin-compression";
import viteImagemin from "vite-plugin-imagemin";
var vite_config_default = defineConfig({
  plugins: [
    laravel({
      input: ["resources/js/app.ts"],
      ssr: "resources/js/ssr.ts",
      refresh: true
    }),
    tailwindcss(),
    wayfinder({
      formVariants: true
    }),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false
        }
      }
    }),
    viteImagemin({
      plugins: [
        imageminWebp({
          quality: 80,
          preset: "default"
        })
      ],
      filter: (file) => {
        return file.includes("resources/") && (file.endsWith(".jpg") || file.endsWith(".jpeg") || file.endsWith(".png") || file.endsWith(".gif"));
      }
    }),
    compression({
      algorithm: "gzip",
      ext: ".gz"
    })
  ],
  build: {
    rollupOptions: {
      output: {
        assetFileNames: (assetInfo) => {
          const info = assetInfo.name.split(".");
          const ext = info[info.length - 1];
          if (/\.(mp4|webm|ogg|mp3|wav|flac|aac)(\?.*)?$/i.test(
            assetInfo.name
          )) {
            return `media/[name]-[hash][extname]`;
          }
          if (/\.(png|jpe?g|gif|svg|webp|avif)(\?.*)?$/i.test(
            assetInfo.name
          )) {
            return `images/[name]-[hash][extname]`;
          }
          if (/\.(woff2?|eot|ttf|otf)(\?.*)?$/i.test(assetInfo.name)) {
            return `fonts/[name]-[hash][extname]`;
          }
          return `assets/[name]-[hash][extname]`;
        }
      }
    }
  }
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcudHMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImltcG9ydCB7IHdheWZpbmRlciB9IGZyb20gJ0BsYXJhdmVsL3ZpdGUtcGx1Z2luLXdheWZpbmRlcic7XG5pbXBvcnQgdGFpbHdpbmRjc3MgZnJvbSAnQHRhaWx3aW5kY3NzL3ZpdGUnO1xuaW1wb3J0IHZ1ZSBmcm9tICdAdml0ZWpzL3BsdWdpbi12dWUnO1xuaW1wb3J0IGltYWdlbWluV2VicCBmcm9tICdpbWFnZW1pbi13ZWJwJztcbmltcG9ydCBsYXJhdmVsIGZyb20gJ2xhcmF2ZWwtdml0ZS1wbHVnaW4nO1xuaW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSAndml0ZSc7XG5pbXBvcnQgY29tcHJlc3Npb24gZnJvbSAndml0ZS1wbHVnaW4tY29tcHJlc3Npb24nO1xuaW1wb3J0IHZpdGVJbWFnZW1pbiBmcm9tICd2aXRlLXBsdWdpbi1pbWFnZW1pbic7XG5cbmV4cG9ydCBkZWZhdWx0IGRlZmluZUNvbmZpZyh7XG4gICAgcGx1Z2luczogW1xuICAgICAgICBsYXJhdmVsKHtcbiAgICAgICAgICAgIGlucHV0OiBbJ3Jlc291cmNlcy9qcy9hcHAudHMnXSxcbiAgICAgICAgICAgIHNzcjogJ3Jlc291cmNlcy9qcy9zc3IudHMnLFxuICAgICAgICAgICAgcmVmcmVzaDogdHJ1ZSxcbiAgICAgICAgfSksXG4gICAgICAgIHRhaWx3aW5kY3NzKCksXG4gICAgICAgIHdheWZpbmRlcih7XG4gICAgICAgICAgICBmb3JtVmFyaWFudHM6IHRydWUsXG4gICAgICAgIH0pLFxuICAgICAgICB2dWUoe1xuICAgICAgICAgICAgdGVtcGxhdGU6IHtcbiAgICAgICAgICAgICAgICB0cmFuc2Zvcm1Bc3NldFVybHM6IHtcbiAgICAgICAgICAgICAgICAgICAgYmFzZTogbnVsbCxcbiAgICAgICAgICAgICAgICAgICAgaW5jbHVkZUFic29sdXRlOiBmYWxzZSxcbiAgICAgICAgICAgICAgICB9LFxuICAgICAgICAgICAgfSxcbiAgICAgICAgfSksXG4gICAgICAgIHZpdGVJbWFnZW1pbih7XG4gICAgICAgICAgICBwbHVnaW5zOiBbXG4gICAgICAgICAgICAgICAgaW1hZ2VtaW5XZWJwKHtcbiAgICAgICAgICAgICAgICAgICAgcXVhbGl0eTogODAsXG4gICAgICAgICAgICAgICAgICAgIHByZXNldDogJ2RlZmF1bHQnLFxuICAgICAgICAgICAgICAgIH0pLFxuICAgICAgICAgICAgXSxcbiAgICAgICAgICAgIGZpbHRlcjogKGZpbGUpID0+IHtcbiAgICAgICAgICAgICAgICAvLyBQcm9jZXNzIGltYWdlcyBmcm9tIHJlc291cmNlcyBkaXJlY3RvcnlcbiAgICAgICAgICAgICAgICByZXR1cm4gKFxuICAgICAgICAgICAgICAgICAgICBmaWxlLmluY2x1ZGVzKCdyZXNvdXJjZXMvJykgJiZcbiAgICAgICAgICAgICAgICAgICAgKGZpbGUuZW5kc1dpdGgoJy5qcGcnKSB8fFxuICAgICAgICAgICAgICAgICAgICAgICAgZmlsZS5lbmRzV2l0aCgnLmpwZWcnKSB8fFxuICAgICAgICAgICAgICAgICAgICAgICAgZmlsZS5lbmRzV2l0aCgnLnBuZycpIHx8XG4gICAgICAgICAgICAgICAgICAgICAgICBmaWxlLmVuZHNXaXRoKCcuZ2lmJykpXG4gICAgICAgICAgICAgICAgKTtcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH0pLFxuICAgICAgICBjb21wcmVzc2lvbih7XG4gICAgICAgICAgICBhbGdvcml0aG06ICdnemlwJyxcbiAgICAgICAgICAgIGV4dDogJy5neicsXG4gICAgICAgIH0pLFxuICAgIF0sXG4gICAgYnVpbGQ6IHtcbiAgICAgICAgcm9sbHVwT3B0aW9uczoge1xuICAgICAgICAgICAgb3V0cHV0OiB7XG4gICAgICAgICAgICAgICAgYXNzZXRGaWxlTmFtZXM6IChhc3NldEluZm8pID0+IHtcbiAgICAgICAgICAgICAgICAgICAgY29uc3QgaW5mbyA9IGFzc2V0SW5mby5uYW1lLnNwbGl0KCcuJyk7XG4gICAgICAgICAgICAgICAgICAgIGNvbnN0IGV4dCA9IGluZm9baW5mby5sZW5ndGggLSAxXTtcbiAgICAgICAgICAgICAgICAgICAgaWYgKFxuICAgICAgICAgICAgICAgICAgICAgICAgL1xcLihtcDR8d2VibXxvZ2d8bXAzfHdhdnxmbGFjfGFhYykoXFw/LiopPyQvaS50ZXN0KFxuICAgICAgICAgICAgICAgICAgICAgICAgICAgIGFzc2V0SW5mby5uYW1lLFxuICAgICAgICAgICAgICAgICAgICAgICAgKVxuICAgICAgICAgICAgICAgICAgICApIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBgbWVkaWEvW25hbWVdLVtoYXNoXVtleHRuYW1lXWA7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgaWYgKFxuICAgICAgICAgICAgICAgICAgICAgICAgL1xcLihwbmd8anBlP2d8Z2lmfHN2Z3x3ZWJwfGF2aWYpKFxcPy4qKT8kL2kudGVzdChcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBhc3NldEluZm8ubmFtZSxcbiAgICAgICAgICAgICAgICAgICAgICAgIClcbiAgICAgICAgICAgICAgICAgICAgKSB7XG4gICAgICAgICAgICAgICAgICAgICAgICByZXR1cm4gYGltYWdlcy9bbmFtZV0tW2hhc2hdW2V4dG5hbWVdYDtcbiAgICAgICAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgICAgICAgICBpZiAoXG4gICAgICAgICAgICAgICAgICAgICAgICAvXFwuKHdvZmYyP3xlb3R8dHRmfG90ZikoXFw/LiopPyQvaS50ZXN0KGFzc2V0SW5mby5uYW1lKVxuICAgICAgICAgICAgICAgICAgICApIHtcbiAgICAgICAgICAgICAgICAgICAgICAgIHJldHVybiBgZm9udHMvW25hbWVdLVtoYXNoXVtleHRuYW1lXWA7XG4gICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgcmV0dXJuIGBhc3NldHMvW25hbWVdLVtoYXNoXVtleHRuYW1lXWA7XG4gICAgICAgICAgICAgICAgfSxcbiAgICAgICAgICAgIH0sXG4gICAgICAgIH0sXG4gICAgfSxcbn0pO1xuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUFBLFNBQVMsaUJBQWlCO0FBQzFCLE9BQU8saUJBQWlCO0FBQ3hCLE9BQU8sU0FBUztBQUNoQixPQUFPLGtCQUFrQjtBQUN6QixPQUFPLGFBQWE7QUFDcEIsU0FBUyxvQkFBb0I7QUFDN0IsT0FBTyxpQkFBaUI7QUFDeEIsT0FBTyxrQkFBa0I7QUFFekIsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDeEIsU0FBUztBQUFBLElBQ0wsUUFBUTtBQUFBLE1BQ0osT0FBTyxDQUFDLHFCQUFxQjtBQUFBLE1BQzdCLEtBQUs7QUFBQSxNQUNMLFNBQVM7QUFBQSxJQUNiLENBQUM7QUFBQSxJQUNELFlBQVk7QUFBQSxJQUNaLFVBQVU7QUFBQSxNQUNOLGNBQWM7QUFBQSxJQUNsQixDQUFDO0FBQUEsSUFDRCxJQUFJO0FBQUEsTUFDQSxVQUFVO0FBQUEsUUFDTixvQkFBb0I7QUFBQSxVQUNoQixNQUFNO0FBQUEsVUFDTixpQkFBaUI7QUFBQSxRQUNyQjtBQUFBLE1BQ0o7QUFBQSxJQUNKLENBQUM7QUFBQSxJQUNELGFBQWE7QUFBQSxNQUNULFNBQVM7QUFBQSxRQUNMLGFBQWE7QUFBQSxVQUNULFNBQVM7QUFBQSxVQUNULFFBQVE7QUFBQSxRQUNaLENBQUM7QUFBQSxNQUNMO0FBQUEsTUFDQSxRQUFRLENBQUMsU0FBUztBQUVkLGVBQ0ksS0FBSyxTQUFTLFlBQVksTUFDekIsS0FBSyxTQUFTLE1BQU0sS0FDakIsS0FBSyxTQUFTLE9BQU8sS0FDckIsS0FBSyxTQUFTLE1BQU0sS0FDcEIsS0FBSyxTQUFTLE1BQU07QUFBQSxNQUVoQztBQUFBLElBQ0osQ0FBQztBQUFBLElBQ0QsWUFBWTtBQUFBLE1BQ1IsV0FBVztBQUFBLE1BQ1gsS0FBSztBQUFBLElBQ1QsQ0FBQztBQUFBLEVBQ0w7QUFBQSxFQUNBLE9BQU87QUFBQSxJQUNILGVBQWU7QUFBQSxNQUNYLFFBQVE7QUFBQSxRQUNKLGdCQUFnQixDQUFDLGNBQWM7QUFDM0IsZ0JBQU0sT0FBTyxVQUFVLEtBQUssTUFBTSxHQUFHO0FBQ3JDLGdCQUFNLE1BQU0sS0FBSyxLQUFLLFNBQVM7QUFDL0IsY0FDSSw2Q0FBNkM7QUFBQSxZQUN6QyxVQUFVO0FBQUEsVUFDZCxHQUNGO0FBQ0UsbUJBQU87QUFBQSxVQUNYO0FBQ0EsY0FDSSwyQ0FBMkM7QUFBQSxZQUN2QyxVQUFVO0FBQUEsVUFDZCxHQUNGO0FBQ0UsbUJBQU87QUFBQSxVQUNYO0FBQ0EsY0FDSSxrQ0FBa0MsS0FBSyxVQUFVLElBQUksR0FDdkQ7QUFDRSxtQkFBTztBQUFBLFVBQ1g7QUFDQSxpQkFBTztBQUFBLFFBQ1g7QUFBQSxNQUNKO0FBQUEsSUFDSjtBQUFBLEVBQ0o7QUFDSixDQUFDOyIsCiAgIm5hbWVzIjogW10KfQo=
