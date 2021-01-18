<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $hidden = ['id'];
    protected $fillable = [
        'name'
    ];

    public static function getRole($kode)
    {
        return Role::where('name', $kode)->first();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
