<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'username',
    //     'first_name',
    //     'last_name',
    //     'email',
    //     'password',
    //     'phone_number',
    //     'role_id',
    //     'is_active',
    // ];
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];



    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user_video_tracker()
    {
        return $this->belongsTo(user_video_tracker::class);
    }

    public function adminprofile()
    {
        return $this->hasOne(adminprofile::class, 'admin_id');
    }
    public function learnerprofile()
    {
        return $this->hasOne(LearnerProfile::class, 'user_id');
    }
    public function instructorprofile()
    {
        return $this->hasOne(InstractorProfile::class, 'user_id');
    }
    public function course()
    {
        return $this->hasMany(course::class, 'user_id');
    }
    public function cart()
    {
        return $this->hasMany(cart::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
    public function review(){
        return $this->hasMany(review::class);
    }

    public function userCourse(){
        return $this->hasMany(user_course::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}