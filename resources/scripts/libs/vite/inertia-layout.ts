// eslint-disable-next-line import/no-extraneous-dependencies
import { Plugin } from 'vite';

const PLUGIN_NAME = 'vite:inertia:layout';
// eslint-disable-next-line operator-linebreak
const TEMPLATE_LAYOUT_REGEX =
  /<template +layout(?: *= *['"](?:(?:(\w+):)?(\w+))['"] *)?>/;

/**
 * A basic Vite plugin that adds a <template layout="name"> syntax to Vite SFCs.
 * It must be used before the Vue plugin.
 */
export const inertia = (layouts = '@/src/layouts/'): Plugin => ({
  name: PLUGIN_NAME,
  transform: (code: string) => {
    if (!TEMPLATE_LAYOUT_REGEX.test(code)) {
      return undefined;
    }

    const isTypeScript = /lang=['"]ts['"]/.test(code);

    return code.replace(
      TEMPLATE_LAYOUT_REGEX,
      (_, __, layoutName) => `
      <script${isTypeScript ? ' lang="ts"' : ''}>
      import layout from '${layouts}${layoutName ?? 'Default'}.vue'
      export default { layout }
      </script>
      <template>
      `,
    );
  },
});
