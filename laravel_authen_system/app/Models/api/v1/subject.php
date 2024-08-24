<?php

namespace App\Models\api\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    use HasFactory;

    protected $table = "subject";

    protected $primaryKey = "id";

    protected $fillable = ['subjectName', 'subjectDescription', 'subjectParentId', 'createBy', 'updateBy'];

    public function subject()
    {
        return $this->hasOne(subject::class);
    }
}
