<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_user extends Model
{
    use HasFactory;

    protected $table = "group_user";

    protected $primaryKey = "id";

    protected $fillable = [
        'groupId',
        'userId',
        'createBy',
        'updateBy',
    ];

    public function user(){
        return $this->belongsTo(user::class);
    }

    public function group(){
        return $this->belongsTo(group::class);
    }
}
