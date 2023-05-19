<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_src',
        'first_name',
        'last_name',
        'middle_name',
        'birthday',
        'contact_number',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFormattedIdAttribute()
    {
        $id = strval($this->id);
        return "P" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }

    public function getAgeAttribute()
    {
        $birthday = $this->birthday;
        $age = date_diff(date_create($birthday), date_create('now'))->y;
        return $age;
    }
}
