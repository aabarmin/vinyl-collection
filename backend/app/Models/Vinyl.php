<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $vinyl_id
 * @property string $vinyl_artist
 * @property string $vinyl_title
 */
class Vinyl extends Model
{
    use HasFactory;

    protected $primaryKey = 'vinyl_id';
    protected $fillable = [
        'vinyl_artist',
        'vinyl_title'
    ];

    public function images(): HasMany
    {
        return $this->hasMany(VinylImage::class, 'vinyl_id');
    }

    public function sides(): HasMany
    {
        return $this->hasMany(VinylSide::class, 'vinyl_id');
    }
}