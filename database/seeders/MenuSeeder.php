<?php

namespace Database\Seeders;

use App\Models\Menu_items;
use App\Models\Menus;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addMainMenu();
    }



    private function addMainMenu()
    {
        $items = [
            [
                'ru' => 'Поступить',
                'en' => 'Apply',
                'link' => 'https://priem.tltsu.ru/'
            ],
            [
                'ru' => 'Образование',
                'en' => 'Education',
                'link' => '',

            ],
            [
                'ru' => 'Наука и инновации',
                'en' => 'Science and innovation',
                'link' => '',
            ],
            [
                'ru' => 'О вузе',
                'en' => 'About',
                'link' => ''
            ],
            [
                'ru' => 'Жизнь вне учебы',
                'en' => 'Life outside of school',
                'link' => ''
            ],
            [
                'ru' => 'Кампус',
                'en' => 'Campus',
                'link' => ''
            ],
            [
                'ru' => 'Работа в вузе',
                'en' => 'Work at the university',
                'link' => ''
            ],
            [
                'ru' => 'Сервисы',
                'en' => 'Services',
                'link' => ''
            ],
        ];
        $menu = [
            'title' => "Главное меню",
            'slug' => "main_menu",
            'type' => "main",
        ];

        $menu = Menus::query()->firstOrCreate($menu);

        foreach ($items as $item){
            Menu_items::query()->firstOrCreate([
                'title' => $item['ru'],
                'link' => $item['link'],
                'menu_id' => $menu->id
            ]);
        }
    }
}
