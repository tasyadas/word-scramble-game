<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Word extends Model
{
    use HasFactory;

    protected $table = 'words';
    protected $primaryKey = 'id';
    protected $hidden = ['id'];
    protected $fillable = [
        'word'
    ];

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'history', 'word_id', 'user_id');
    }
}
