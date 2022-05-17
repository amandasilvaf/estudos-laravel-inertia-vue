/* eslint-disable no-unused-vars,no-redeclare */
import originalRoute from 'ziggy-js';
import type { Config, Router, RouteParamsWithQueryOverload } from 'ziggy-js';
import { Ziggy } from './routes';

const generateZiggyRoutesCommand =
  'php artisan ziggy:generate ./resources/scripts/libs/ziggy/routes.ts';

const ziggyConfig = {
  ...Ziggy,
  url: '',
  port: null,
} as Config;

function route(
  name?: undefined,
  params?: RouteParamsWithQueryOverload,
  absolute?: boolean,
  config?: Config,
): Router;

function route(
  name: string,
  params?: RouteParamsWithQueryOverload,
  absolute?: boolean,
  config?: Config,
): string;

function route(
  name: unknown,
  params?: RouteParamsWithQueryOverload,
  absolute?: boolean,
  config = ziggyConfig,
) {
  // @ts-expect-error: Unreachable code error
  return originalRoute(name, params, absolute, config);
}

export { route, generateZiggyRoutesCommand };
