<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    protected $fillable = ['survey_id', 'response'];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}
