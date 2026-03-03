<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{
    User, Building, Classroom, Faculty, Department, Speciality, Group,
    Student, Teacher, Subject, Gender, Region, Nationality, FormOfStudy,
    StudyMode, Year, Month, Semester, Period, Schedule
};

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Пользователь для теста
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Статические таблицы
        Gender::insert([
            ['name' => 'Male'],
            ['name' => 'Female']
        ]);

        FormOfStudy::insert([
            ['name' => 'Budjet'],
            ['name' => 'Contract']
        ]);

        StudyMode::insert([
            ['name' => 'Full-time'],
            ['name' => 'Part-time']
        ]);

        Nationality::insert([
            ['name' => 'kyrgyz'], ['name' => 'russian'], ['name' => 'kazakh'],
            ['name' => 'dungan'], ['name' => 'korean'], ['name' => 'uzbek'],
            ['name' => 'ukranian'], ['name' => 'tadjik']
        ]);

        Region::insert([
            ['name' => 'Bishkek'], ['name' => 'Osh'], ['name' => 'Chui'],
            ['name' => 'Batken'], ['name' => 'Issik-Kul'], ['name' => 'Djalal-Abad'],
            ['name' => 'Talas'], ['name' => 'Naryn']
        ]);

        // Фабрики для динамических данных
        Building::factory()->count(3)->create();
        Classroom::factory()->count(100)->create();
        Faculty::factory()->count(6)->create();
        Department::factory()->count(12)->create();
        Speciality::factory()->count(24)->create();
        Group::factory()->count(48)->create();
        Student::factory()->count(144)->create();
        Teacher::factory()->count(28)->create();
        Subject::factory()->count(28)->create();

        // Сидеры с логикой (в правильном порядке)
        $this->call([
            AdminUserSeeder::class,
            YearsTableSeeder::class,
            MonthsTableSeeder::class,
            SemestersTableSeeder::class,
            StreamsSeeder::class,
            SubjectTeacherSeeder::class,
            RegistrationsSeeder::class,
            PeriodsSeeder::class,
            SchedulesSeeder::class,
        ]);
    }
}