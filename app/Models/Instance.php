<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Instance
 *
 * @property int $id
 * @property string $name
 * @property string $moodle_version
 * @property string $server_provider
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Instance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Instance query()
 * @method static \Illuminate\Database\Eloquent\Builder|Instance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instance whereMoodleVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instance whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instance whereServerProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Instance whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|Instance whereUserId($value)
 */
class Instance extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'user_id',
        'moodle_version',
        'server_provider',
    ];
}
