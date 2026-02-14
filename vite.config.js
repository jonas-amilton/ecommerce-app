import { defineConfig, loadEnv } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ mode }) => {
  const env = loadEnv(mode, process.cwd(), "");

  const host = env.VITE_DEV_HOST || env.APP_DOMAIN || "localhost";
  const port = Number(env.VITE_DEV_PORT || 5173);

  return {
    plugins: [
      laravel({
        input: ["resources/css/app.css", "resources/js/app.js"],
        refresh: true,
      }),
      tailwindcss(),
    ],
    server: {
      host,
      port,
      strictPort: true,
      hmr: {
        host,
        port,
      },
    },
  };
});
