import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue'; // Vue plugin for Vite

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()], // Add Vue plugin for handling .vue files
  server: {
    proxy: {
      // Proxy API requests to Laravel backend (optional)
      '/app': 'http://localhost',  // Adjust this if needed based on your API path
    }
  },
  build: {
    outDir: 'public/build',  // Output compiled files to public/build directory
    manifest: true,  // Generate a manifest for easier linking to assets
    rollupOptions: {
      input: 'resources/js/app.js',  // Set entry point for Vue application
    }
  }
});
