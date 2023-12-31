<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'file_id',
        'latitude',
        'longitude',
        // 'category_id',
        // 'visibility_id',
        'author_id',
        'visibilities_id',
    ];
    public function file()
    {
        return $this->belongsTo(File::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class);
    }
    public function favorited()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
    public function visibilities()
    {
        return $this->belongsTo(Visibility::class);
    }

}
