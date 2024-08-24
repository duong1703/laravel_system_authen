<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_test extends Model
{
    use HasFactory;

    
    protected $table = "group_test";

    protected $fillable = ['groupId', 'testId', 'createBy', 'updateBy'];

    public function test()
    {
        return $this->belongsTo(group::class);
    }
}
