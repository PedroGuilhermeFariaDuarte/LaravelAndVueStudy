<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        "username",
        "name",
        "email",
        "password",
        "admin",
        "owner",
        "level_admin",
        "team_id",
        "user_uuid"];

    /**
     * Define a relation with Team Model
     * @return Illuminate\Database\Eloquent\Model
     */
    public function team()
    {
        return $this->hasOne(Team::class);
    }
}
