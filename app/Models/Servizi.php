<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servizi extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'servizis';

    public static $searchable = [
        'nome_servizio',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nome_servizio',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function serviceDailyActivities()
    {
        return $this->hasMany(DailyActivity::class, 'service_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
