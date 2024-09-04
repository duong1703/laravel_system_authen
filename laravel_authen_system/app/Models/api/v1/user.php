<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class user extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "user";

    // protected $primaryKey = "id";

    protected $fillable = [
        'userName',
        'userPassword',
        'userEmail',
        'userFirstName',
        'userLastName',
        'userMiddleName',
        'userGender',
        'userBirthday',
        'userJoinDate',
        'userLoginDate',
        'userExpireDate',
        'createBy',
        'updateBy'
    ];

    public function group()
    {
        return $this->belongsToMany(group::class, 'group_user', 'userId', 'groupId')
            ->withTimestamps();
    }

    public function tokens()
    {
        return $this->hasMany(token::class, 'userId');
    }
}
