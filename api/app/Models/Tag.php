<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property integer $count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read array $books
 */
class Tag extends Model
{
    protected $table = 'tag';

    public function books () {
        return $this->belongsToMany('Models\Book', 'book_x_tag','tag_id', 'book_id');
    }
}
