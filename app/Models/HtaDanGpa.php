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

    /**
     * Relationship to get the user who performed Penilai1 action.
     */
    public function getPenilai1()
    {
        return $this->belongsTo(User::class, 'Penilai1_Oleh', 'id');
    }

    /**
     * Relationship to get the user who performed Penilai2 action.
     */
    public function getPenilai2()
    {
        return $this->belongsTo(User::class, 'Penilai2_Oleh', 'id');
    }

    /**
     * Relationship to get the user who performed Penilai3 action.
     */
    public function getPenilai3()
    {
        return $this->belongsTo(User::class, 'Penilai3_Oleh', 'id');
    }

    /**
     * Relationship to get the user who performed Penilai4 action.
     */
    public function getPenilai4()
    {
        return $this->belongsTo(User::class, 'Penilai4_Oleh', 'id');
    }

    /**
     * Relationship to get the user who performed Penilai5 action.
     * Penilai5_Oleh in controller is set as 'name', so we match to user's name here instead of id.
     */
    public function getPenilai5()
    {
        return $this->belongsTo(User::class, 'Penilai5_Oleh', 'id');
    }
}
