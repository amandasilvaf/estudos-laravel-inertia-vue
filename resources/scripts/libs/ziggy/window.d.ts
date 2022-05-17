import { Router } from 'ziggy-js';

/* eslint-disable @typescript-eslint/no-explicit-any */
export {}; // make the file a module, to get rid of the warning

declare global {
  interface Window {
    Ziggy:
      | {
          routes: Router;
        }
      | undefined;
  }
}
