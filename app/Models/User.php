<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'username',
    'email',
    'password',
    'role',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
        ];
    }
    public function concursosComoJurado()
    {
    return $this->belongsToMany(\App\Models\Concurso::class, 'concurso_jurados', 'user_id', 'concurso_id')
        ->withTimestamps();
    }

    public function concursoJuradoAspectos()
    {
    return $this->hasMany(\App\Models\ConcursoJuradoAspecto::class);
    }

  public function concursos()
{
    return $this->belongsToMany(Concurso::class, 'concurso_jurados', 'user_id', 'concurso_id')
        ->withTimestamps();
}

}
