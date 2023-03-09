<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'slug' => 'index',
            'title' => ['en' => 'Index', 'it' => 'Indice'],
            'content' => [
                'en' => '<p><strong>SPA @ <a href="https://vitejs.dev" target="_blank">Vite</a>/<a href="https://vuejs.org" target="_blank">Vue</a> & <a href="https://pinia.vuejs.org" target="_blank">Pinia</a><br>++<a href="https://laravel.com" target="_blank">Laravel</a>/<a href="https://filamentphp.com" target="_blank">Filament</a></strong></p>',
                'it' => '<p><strong>SPA @ <a href="https://vitejs.dev" target="_blank">Vite</a>/<a href="https://vuejs.org" target="_blank">Vue</a> & <a href="https://pinia.vuejs.org" target="_blank">Pinia</a><br>++<a href="https://laravel.com" target="_blank">Laravel</a>/<a href="https://filamentphp.com" target="_blank">Filament</a></strong></p>',
            ],
        ]);

        Page::create([
            'slug' => 'about',
            'title' => ['en' => 'About', 'it' => 'Informazioni'],
            'content' => [
                'en' => '<p><strong>Single Page Application.</strong><br>Vue3, Pinia, Laravel, Vite.<br>GitHub <a href="https://github.com/volkar/laravel-filament-spa-i18n-vite-vue" target="blank">volkar/laravel-filament-spa-i18n-vite-vue</a><br>by <a href="https://volkar.ru" target="blank">Sergey Volkar</a></p>',
                'it' => '<p><strong>Applicazione a Pagina Singola.</strong><br>Vue3, Pinia, Laravel, Vite.<br>GitHub <a href="https://github.com/volkar/laravel-filament-spa-i18n-vite-vue" target="blank">volkar/laravel-filament-spa-i18n-vite-vue</a><br>di <a href="https://volkar.ru" target="blank">Sergey Volkar</a></p>',
            ],
        ]);
    }
}
