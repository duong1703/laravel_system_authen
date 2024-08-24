<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    use HasFactory;

    protected $table = "group";

    // protected $primaryKey = "id";

    protected $fillable = [
       'goupName',
       'groupDescription',
       'accessSite',
       'accessAdmin',
       'accessTestManager',
       'accessGradingSystem',
       'accessQuestionBank',
       'accessSubjects',
       'accessGroups',
       'accessUsers',
       'createBy',
       'updateBy',
    ];

    public function user()
    {
        return $this->belongsToMany(user::class, 'group_user', 'groupId', 'userId')
                    ->withTimestamps();
    }
}
