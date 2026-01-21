<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $limit = $this->command->ask('Сколько новых тэгов создать? (Значение по умолчанию 10)'
                                              . PHP_EOL . '  Для пропуска введите, что либо кроме чисел');
        $limit = is_numeric($limit) ? (int) $limit : 10;
        // Сам не знаю почему, faker отказывается воспринимать локаль ru_RU указанную в env. Точно так же если явно ему
        // её задать в TagFactory. Посему будет делать латынь...
        Tag::factory()
            ->count($limit)
            ->create();
    }
}
