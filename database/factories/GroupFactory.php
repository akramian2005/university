<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Group;
use App\Models\Speciality;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        // Массив русских букв
        $lettersArray = ['А','Б','В','Г','Д','Е','Ж','З','И','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Э','Ю','Я'];

        // Генерируем 2–4 случайные буквы
        $lettersCount = $this->faker->numberBetween(2, 4);
        $letters = '';
        for ($i = 0; $i < $lettersCount; $i++) {
            $letters .= $this->faker->randomElement($lettersArray);
        }

        // Случайная цифра 1–10
        $number = $this->faker->numberBetween(1, 10);

        // Год 23–26
        $year = $this->faker->numberBetween(23, 26);

        return [
            'name' => "{$letters}-{$number}-{$year}",
            'speciality_id' => Speciality::inRandomOrder()->first()->id,
        ];
    }
}
