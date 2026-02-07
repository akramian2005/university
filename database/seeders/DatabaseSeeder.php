<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Building, Classroom, Faculty, Department, Speciality, Group, Student, Teacher, Subject, Gender, Region, Nationality, FormOfStudy};

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

                Gender::insert([
            ['name' => 'Male'], 
            ['name' => 'Female']
        ]);

        FormOfStudy::insert([
            ['name' => 'Budjet'],
            ['name' => 'Contract']
        ]);

        Nationality::insert([
            ['name'=>'kyrgyz'], ['name'=>'russian'], ['name'=>'kazakh'], 
            ['name'=>'dungan'], ['name'=>'korean'], ['name'=>'uzbek'], ['name'=>'ukranian'], ['name'=>'tadjik']
        ]);

        Region::insert([
            ['name'=>'Bishkek'], ['name'=>'Osh'], ['name'=>'Chui'], ['name'=>'Batken'], 
            ['name'=>'Issik-Kul'], ['name'=>'Djalal-Abad'], ['name'=>'Talas'], ['name'=>'Naryn']
        ]);

        // Основная структура
        Building::factory()->count(3)->create();
        Classroom::factory()->count(100)->create();
        Faculty::factory()->count(6)->create();
        Department::factory()->count(12)->create();
        Speciality::factory()->count(24)->create();
        Group::factory()->count(48)->create();
        Student::factory()->count(144)->create();
        Teacher::factory()->count(28)->create();
        Subject::factory()->count(28)->create();
        
        $this->call(AdminUserSeeder::class);
    }
}
