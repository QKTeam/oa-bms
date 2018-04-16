<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Book
 * @package App\Models
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property boolean $available
 * @property string $e_book
 * @property Carbon $next_available_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read array $tags
 */
class Book extends Model
{
    protected $table = 'book';

    public function tags () {
        return $this->belongsToMany('Models\Tag', 'book_x_tag', 'book_id', 'tag_id');
    }

    public function getUserAttribute () {
        $user_x_book = DB::table('user_x_book')->where('book_id', 1)->latest()->first();
        $return_time = Carbon::createFromTimeString($user_x_book->return_time);
        if ($return_time->timestamp < Carbon::now()->timestamp) return null;
        return $user_x_book->user_id;
    }
}
