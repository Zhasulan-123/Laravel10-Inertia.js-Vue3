import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import "bootstrap/dist/js/bootstrap.min.js";

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./src/**/*.vue', { eager: true })
    return pages[`./src/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
});
