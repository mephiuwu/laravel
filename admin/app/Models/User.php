<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Roles;
use ESolution\DBEncryption\Traits\EncryptedAttribute;


class User extends Authenticatable
{
    use HasFactory, Notifiable, EncryptedAttribute;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $encryptable = [
        'name', 'email', 'rut', 'telefono', 'profile_image'
    ];

    protected $fillable = [
        'name',
        'rut',
        'email',
        'password',
        'estado',
        'telefono',
        'rol_id',
        'profile_image'
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

    public function rol()
    {
        return $this->belongsTo(Roles::class, 'rol_id');
    }


    public function getAllAttributes()
    {
        $columns = $this->getFillable();
        // Another option is to get all columns for the table like so:
        // $columns = \Schema::getColumnListing($this->table);
        // but it's safer to just get the fillable fields

        $attributes = $this->getAttributes();

        foreach ($columns as $column) {
            if (!array_key_exists($column, $attributes)) {
                $attributes[$column] = null;
            }
        }
        return $attributes;
    }
}
