<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Catalog
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property bool $is_public
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Catalog whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Book[] $books
 * @property-read \App\Models\User $user
 */
class Catalog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_public', 'user_id',
    ];

    /**
     * Relation to User
     *
     * @return BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation to Books
     *
     * @return BelongsToMany
     */
    public function books() : BelongsToMany
    {
        return $this->belongsToMany(Book::class);
    }
}
