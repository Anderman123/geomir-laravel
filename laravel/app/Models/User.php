<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', // Asegúrate de que 'role_id' esté en $fillable
    ];

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
    public function places()
    {
        return $this->hasMany(Place::class, 'author_id');
    }
    public function favorites()
    {
        return $this->belongsToMany(Place::class, 'favorites');
    }

    public function hasPlaceFav(Place $place) : bool
    {
        return Favorite::where('user_id', '=', $this->id)
            ->where('place_id','=', $place->id)
            ->exists();
    }

    public function canAccessFilament(): bool
    {
        if ($this->role_id === 2 || $this->role_id === 3 ) {
            return true;
        }else{
            return false;
        }
    }

    public function getFilamentAvatarUrl(): ?string
    {
        return $this->avatar_url;
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
 
}
