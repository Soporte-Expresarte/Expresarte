<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use App\Traits\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'apodo', 'password', 'rut', 'name', 'apellido', 'telefono', 'fecha_nacimiento',
        'profile_photo_path', 'current_team_id', 'carro_id', 'perfil_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Obtiene el perfil asociado a un usuario.
     */
    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id');
    }

    /**
     * Obtiene el carro de compras asociado a un usuario.
    */
    public function carro()
    {
        return $this->belongsTo(Carro::class, 'carro_id');
    }

    /**
     * Obtiene las noticias creadas por un usuario (artistas).
    */
    public function noticias()
    {
        return $this->hasMany(Noticia::class, 'usuario_id');
    }

    /**
     * Obtiene los eventos creados por un usuario (artistas y admins).
    */
    public function eventos()
    {
        return $this->hasMany(Evento::class, 'usuario_id');
    }

    /**
     * Obtiene los productos publicados por un usuario (artistas).
    */
    public function productos()
    {
        return $this->hasMany(Producto::class, 'usuario_id');
    }

    /**
     * Obtiene las obras publicadas por un usuario (artistas).
    */
    public function obras()
    {
        return $this->hasMany(Obra::class, 'usuario_id');
    }

    /**
     * Un usuario genera o posee una o muchas órdenes de compra.
    */
    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'usuario_id');
    }

    /**
     * Un usuario genera o posee una o muchas órdenes de compra.
    */
    public function donaciones()
    {
        return $this->hasMany(Donacion::class, 'usuario_id');
    }

	/**
	 * Un usuario posee una o muchas ordenes de proyecto
	*/
	public function ordenesProyecto()
	{
		return $this->hasMany(OrdenProyecto::class, 'usuario_id');
	}
}
