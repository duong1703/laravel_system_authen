<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class token extends Model
{
    use HasFactory;

    
    protected $table = "token";

    protected $fillable = ['userId', 'token', 'type', 'createdAt'];

    public function user_token()
    {
        return $this->belongsTo(user::class);
    }
}
