# SPA with i18n @ Laravel, Filament, Vue, Vite, Pinia.

### Laravel backend:
- Full data migrations with seeders and factoriy example (pages, categories, projects, users)
- Filament admin panel with [Serenity theme](https://github.com/volkar/filament-laravel-serenity-theme-dark-light)
- Internationalization (i18n) with [Spatie Translatable](https://filamentphp.com/docs/2.x/spatie-laravel-translatable-plugin/installation)
- [Spatie Media](https://filamentphp.com/docs/2.x/spatie-laravel-media-library-plugin/installation)
- [Spatie Settings](https://filamentphp.com/docs/2.x/spatie-laravel-settings-plugin/installation)
- [Spatie Health](https://github.com/shuvroroy/filament-spatie-laravel-health) page
- Imagick instead of GD
- TinyEditor with custom colors

### Vue frontend:
- TypeScript
- [Vue 3](https://vuejs.org/)
- [Vite](https://vitejs.dev/) for assets build
- [Pinia](https://pinia.vuejs.org/) for data store
- [ky](https://github.com/sindresorhus/ky) for fetching data
- Simple SPA with basic routes as example
- [Cache/expiration](https://github.com/volkar/vue-pinia-cache-composables) system for api requests

## SPA screenshots
About page:
![SPA preview](https://github.com/volkar/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/preview-1.jpg?raw=true)
Italian locale:
![SPA preview](https://github.com/volkar/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/preview-2.jpg?raw=true)
Category page:
![SPA preview](https://github.com/volkar/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/preview-3.jpg?raw=true)
In case you don't like cookies:
![SPA preview](https://github.com/volkar/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/preview-4.jpg?raw=true)

## Filament screenshots

List:
![Filament preview](https://github.com/volkar/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/preview-f-1.jpg?raw=true)
Form:
![Filament preview](https://github.com/volkar/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/preview-f-2.jpg?raw=true)
Same about cookies:
![Filament preview](https://github.com/volkar/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/preview-f-3.jpg?raw=true)
Global settings page:
![Filament preview](https://github.com/volkar/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/preview-f-4.jpg?raw=true)

## Prerequisites

Required requisites:

1. [Git](https://git-scm.com/book/en/Getting-Started-Installing-Git)
2. [Node](https://nodejs.org/en/)
3. Any kind of serving app (valet, wamp, xamp, sail, artisan serve)

## Installation

1. Clone the project:
```
git clone https://github.com/volkar/laravel-filament-spa-i18n-vite-vue.git
```
2. Go to the project's folder
```
cd laravel-filament-spa-i18n-vite-vue
```
3. Update and install composer packages
```
composer update
```
4. Copy .env.example to .env
```
cp .env.example .env
```
5. Generate keys
```
php artisan key:generate
```
6. Edit your .env file to setup database connection and site address `APP_URL`
7. Create database schema & seed it
```
php artisan migrate:refresh --seed
```
8. Install all node.js dependencies
```
npm install
```
9. Run Vite dev server
```
npm run dev
```
10. Serve your Laravel app (valet link, wamp, xamp, sail or whatever)
11. Open served address in your browser.

Filament's admin account created by seeding:
- login: **admin@admin.com**
- pass: **admin**

## Contact me

You always welcome to write me
- E-mail: sergey@volkar.ru
- Telegram: @sergeyvolkar
