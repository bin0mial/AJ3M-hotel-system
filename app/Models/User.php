<?php

namespace App\Models;

use Carbon\Carbon;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Cog\Contracts\Ban\Bannable as BannableContract;


class User extends Authenticatable implements BannableContract
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, Billable ,Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'national_id',
        'avatar_image',
    ];

    public function manager()
    {
        return $this->hasOne(Manager::class);
    }

    public function receptionist(){
        return $this->hasOne(Receptionist::class);
    }


    public function client(){
        return $this->hasOne(Client::class);
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];




    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->toDateTimeString();
    }

    public function getAvatarImageAttribute($value): string
    {
        return $value?Storage::url($value):"/images/default_avatar.png";
    }

    public function setAvatarImageAttribute($value)
    {
        $path = $value ? $value->storePublicly("public/avatars") : null;
        $this->attributes['avatar_image'] = $path;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes["password"] = Hash::make($value);
    }


}
