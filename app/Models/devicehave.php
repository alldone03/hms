<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devicehave extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function user()
    {
        return $this->belongsTo(User::class, 'users');
    }
    public function device()
    {
        return $this->belongsTo(Device::class, 'devices');
    }
}
