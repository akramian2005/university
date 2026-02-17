<?php

namespace App\Services\Admin;

class AdminRelations
{
    public static function get(): array
    {
        return [
            'students' => [
                'gender_id' => ['table' => 'genders', 'field' => 'name'],
                'region_id' => ['table' => 'regions', 'field' => 'name'],
                'nationality_id' => ['table' => 'nationalities', 'field' => 'name'],
                'group_id' => ['table' => 'groups', 'field' => 'name'],
                'form_of_study_id' => ['table' => 'form_of_studies', 'field' => 'name'],
                'study_mode_id' => ['table' => 'study_modes', 'field' => 'name'],
            ],
            'groups' => [
                'speciality_id' => ['table' => 'specialities', 'field' => 'name'],
            ],
            'specialities' => [
                'faculty_id' => ['table' => 'faculties', 'field' => 'name'],
            ],
            'departments' => [
                'faculty_id' => ['table' => 'faculties', 'field' => 'name'],
            ],
            'teachers' => [
                'gender_id' => ['table' => 'genders', 'field' => 'name'],
                'department_id' => ['table' => 'departments', 'field' => 'name'],
            ],
        ];
    }
}
