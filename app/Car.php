<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Car extends Model
{
    use SoftDeletes;

    public $table = 'cars';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'capacity',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'hourly_rate',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');

    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
