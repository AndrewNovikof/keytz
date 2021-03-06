<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Book
 *
 * @property int $id
 * @property string $name
 * @property string|null $text
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Catalog[] $catalogs
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book excludedCatalog($catalog_id = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Book search($string = null)
 */
class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'text', 'user_id',
    ];

    /**
     * Relation to User
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to Catalog
     *
     * @return BelongsToMany
     */
    public function catalogs(): BelongsToMany
    {
        return $this->belongsToMany(Catalog::class);
    }

    /**
     * Search book by name like $string
     *
     * @param $query
     * @param $string
     * @return mixed
     */
    public function scopeSearch($query, $string = null)
    {
        if (!$string) {
            return $query;
        }
        return $query->where('name', 'ILIKE', "%" . $string . "%");
    }

    /**
     * @param $query
     * @param null $catalog_id
     * @return mixed
     */
    public function scopeExcludedCatalog($query, $catalog_id = null)
    {
        if (!$catalog_id) {
            return $query;
        }
        return $query->whereHas('catalogs', function ($query) use ($catalog_id) {
            $query->whereNotIn('id', [$catalog_id]);
        });
    }
}
