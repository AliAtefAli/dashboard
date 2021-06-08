<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Installment extends Model
{
    use Translatable, SoftDeletes;
    public $translatedAttributes = ['title'];
    protected $fillable = [
        'price', 'note', 'pay_date', 'transfer_image', 'project_steps_id', 'status'
    ];

    public function documents()
    {
        return $this->morphMany(Document::class, 'document');
    }

    public function projectStep()
    {
        return $this->belongsTo(ProjectStep::class, 'project_steps_id');
    }

}
