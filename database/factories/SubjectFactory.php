<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subject;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition()
    {
        $subjects = [
            'Математика', 'Физика', 'Химия', 'Биология', 'Информатика', 'История', 
            'География', 'Литература', 'Английский язык', 'Немецкий язык', 
            'Французский язык', 'Русский язык', 'Обществознание', 'Экономика',
            'Право', 'Философия', 'Психология', 'Социология', 'Музыка', 'ИЗО', 
            'Физическая культура', 'Труд', 'Технология', 'Экология', 
            'Математический анализ', 'Алгебра', 'Геометрия', 'Программирование'
        ];

        return [
            'name' => $subjects[$this->faker->numberBetween(0, count($subjects) - 1)],
        ];
    }
}