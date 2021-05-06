<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'isAdmin',
    ];

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
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new Notifications\VerifyEmail);
    }

    public function productosFavoritos()
    {
        return $this->belongsToMany("App\Models\Product", "favourites", "user_id", "product_id");
    }

      public function productosEnCarrito()
      {
        return $this->belongsToMany("App\Models\Product", "carts", "user_id", "product_id", );
      }
      public function carts()
      {
        return $this->hasMany("App\Models\Cart", "user_id", );
      }
}
