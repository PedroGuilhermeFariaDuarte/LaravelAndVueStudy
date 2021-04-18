<?php

namespace App\Models;

use App\Models\Drive;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "game_area",
        "manufacture",
        "points",
    ];

    /**
     * Define a relation with User Model
     * @return Illuminate\Database\Eloquent\Model
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Define a relation with Driver Model
     * @return Illuminate\Database\Eloquent\Model
     */
    public function driver()
    {
        return $this->hasMany(Drive::class);
    }
}
