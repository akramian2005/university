<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Student extends Authenticatable
{
    use HasFactory;
    
    protected $fillable = [
        'first_name',
        'last_name',
        'date_born',
        'gender_id',
        'region_id',
        'nationality_id',
        'group_id',
        'form_of_study_id',
        'password',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function formOfStudy()
    {
        return $this->belongsTo(FormOfStudy::class);
    }
    
        public function studyMode()
    {
        return $this->belongsTo(StudyMode::class);
    }

}

