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
 * @property string $publisher
 * @property string $publishDate
 * @property string $img_url
 * @property string $authors
 * @property boolean $available
 * @property string $e_book
 * @property Carbon $next_available_time
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read array $tags
 * @property-read array $data
 * @property-read array $detail
 */
class Book extends Model
{
    protected $table = 'book';

    public function tags () {
        return $this->belongsToMany('Models\Tag', 'book_x_tag', 'book_id', 'tag_id');
    }

    public function getUserAttribute () {
        if ($this->attributes['available'] === true) return null;
        $user_x_book = DB::table('user_x_book')->where('book_id', $this->attributes['id'])->latest()->first();
        $return_time = Carbon::createFromTimeString($user_x_book->return_time);
        if ($return_time->timestamp < Carbon::now()->timestamp) return null;
        return $user_x_book->user_id;
    }

    public function getDataAttribute () {
        return [
            "id" => $this->attributes['id'],
            "name" => $this->attributes['name'],
            "description" => $this->attributes['description'],
            "available" => $this->attributes['available'],
            "next_available_time" => $this->attributes['next_available_time'],
        ];
    }

    public function getDetailAttribute () {
        return [
            "id" => $this->attributes['id'],
            "name" => $this->attributes['name'],
            "description" => $this->attributes['description'],
            "available" => $this->attributes['available'],
            "authors" => $this->attributes['authors'],
            "img_url" => $this->attributes['img_url'],
            "publisher" => $this->attributes['publisher'],
            "publishDate" => $this->attributes['publishDate'],
            "e_book" => $this->attributes['e_book'],
            "next_available_time" => $this->attributes['next_available_time'],
        ];
    }
}
