<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public const SCHEDULE_CHECKLISTS = [
        1 => 'Monday (8:00am - 5:00pm)',
        2 => 'Tuesday (8:00am - 5:00pm)',
        3 => 'Wednesday (8:00am - 5:00pm)',
        4 => 'Thursday (8:00am - 5:00pm)',
        5 => 'Friday (8:00am - 5:00pm)',
        6 => 'Saturday (8:00am - 5:00pm)',
    ];

    protected $fillable = [
        'image_src',
        'first_name',
        'last_name',
        'middle_name',
        'birthday',
        'contact_number',
        'special_id',
        'consultation_fee',
        'schedule_checklists',
        'user_id',
    ];

    public function special()
    {
        return $this->belongsTo(Special::class);
    }

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
        return "D" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }

    public function getScheduleChecklistsArrAttribute() {
        $checklists = $this->schedule_checklists;

        if(!$checklists)
            return [];
        
        if(strpos($checklists, ',') === false)
            return [$checklists];

        return explode(',', $checklists);
    }
    


}
