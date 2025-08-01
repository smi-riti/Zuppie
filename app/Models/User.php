<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use  HasApiTokens ,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_no',
        'is_admin',
        'otp',
        'otp_expires_at' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp',              
        'otp_expires_at'

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    // Relationship methods
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Accessor for phone field compatibility
    public function getPhoneAttribute()
    {
        return $this->phone_no;
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone_no'] = $value;
    }
    public function setPhoneNoAttribute($value) 
    {
        $this->attributes['phone_no'] = preg_replace('/[^0-9]/', '', $value);
    }

    // Add accessor for consistent formatting
    public function getFormattedPhoneAttribute()
    {
        return substr($this->phone_no, 0, 3) . '****' . substr($this->phone_no, -3);
    }

}
