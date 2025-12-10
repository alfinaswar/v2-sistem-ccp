<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HtaDanGpa extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'hta_dan_gpas';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    protected $casts = [
        'IdParameter' => 'array',
        'Parameter' => 'array',
        'Deskripsi' => 'array',
        'Nilai1' => 'array',
        'Nilai2' => 'array',
        'Nilai3' => 'array',
        'Nilai4' => 'array',
        'Nilai5' => 'array',
        'SubTotal' => 'array',
    ];
}
