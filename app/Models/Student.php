<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'surname', 'group_id', 'gender', 'birthday'];
    protected $guarded = ['id', 'status', 'created_at', 'updated_at'];

    public function group()
    {
        return $this->hasOne(Group::class);
    }
}
