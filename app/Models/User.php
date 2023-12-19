<?php

namespace App\Models;

use App\Models\Like;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);//one to many: donde un usuario puede tener multiples posts
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Almacena los seguidores de un usuario
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id'); //el metodo followers() en la tabla de followers pertenece a muchos usuarios y va a insertar en la tabla de followers tanto user_id como follower_id
    }

    //Almacena los que seguimos
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    //Comprobar si el usuario ya esta siguiendo a otro
    public function siguiendo(User $user)
    {
        return $this->followers->contains( $user->id );
    }
}
