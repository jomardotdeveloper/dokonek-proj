<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public const APPROVAL_STATUS = [
        'pending' => 'Pending',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
    ];

    public const STATUS = [
        'pending' => 'Pending',
        'ongoing' => 'Ongoing',
        'done' => 'Done',
    ];

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'special_id',
        'date',
        'approval_status',
        'status',
        'is_paid',
        'payment_method',
        'doctor_confirmation_src'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class);
    }

    public function special()
    {
        return $this->belongsTo(Special::class);
    }

    public function getFormattedIdAttribute()
    {
        $id = strval($this->id);
        return "A" . str_pad($id, 4, "0", STR_PAD_LEFT);
    }
}
