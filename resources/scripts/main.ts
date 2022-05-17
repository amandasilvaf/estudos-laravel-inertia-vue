import { createApp, h } from 'vue';

import { createInertiaApp, Link } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import Button from 'primevue/button';
import Toast from 'primevue/toast';
import InputMask from 'primevue/inputmask';
import InputNumber from 'primevue/inputnumber';
import InputSwitch from 'primevue/inputswitch';
import InputText from 'primevue/inputtext';
import Textarea from 'primevue/textarea';
import Checkbox from 'primevue/checkbox';
import ToggleButton from 'primevue/togglebutton';
import RadioButton from 'primevue/radiobutton';
import ProgressBar from 'primevue/progressbar';
import Dropdown from 'primevue/dropdown';

import BadgeDirective from 'primevue/badgedirective';
import Ripple from 'primevue/ripple';
import Tooltip from 'primevue/tooltip';
import StyleClass from 'primevue/styleclass';
import ConfirmDialog from 'primevue/confirmdialog';

import { importPageComponent } from './libs/vite';

import 'primevue/resources/themes/lara-light-blue/theme.css';
import 'primevue/resources/primevue.min.css';
import 'primeicons/primeicons.css';
import 'primeflex/primeflex.css';
import '../src/styles/global.scss';

createInertiaApp({
  resolve: (name: string) => {
    const glob = import.meta.glob('../src/pages/**/*.vue');
    return importPageComponent(name, glob);
  },
  setup(setup) {
    const { el, app, props, plugin } = setup;
    createApp({
      render: () => h(app, props),
    })
      .use(plugin)
      .use(PrimeVue, {
        ripple: true,
      })
      .use(ToastService)
      .use(ConfirmationService)
      .use(VueSweetalert2)
      .component('Toast', Toast)
      .component('InputMask', InputMask)
      .component('InputNumber', InputNumber)
      .component('InputSwitch', InputSwitch)
      .component('InputText', InputText)
      .component('Textarea', Textarea)
      .component('Checkbox', Checkbox)
      .component('ProgressBar', ProgressBar)
      .component('Dropdown', Dropdown)
      .component('Button', Button)
      .component('ToggleButton', ToggleButton)
      .component('RadioButton', RadioButton)
      .component('Link', Link)
      .component('ConfirmDialog', ConfirmDialog)
      .directive('badge', BadgeDirective)
      .directive('ripple', Ripple)
      .directive('tooltip', Tooltip)
      .directive('styleclass', StyleClass)
      .mount(el);
  },
});

InertiaProgress.init({
  color: 'purple',
  showSpinner: true,
});
