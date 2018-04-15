<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    public function book_x_tag(){
    	return $this->belongsToMany('\App\Book_x_tag');
    }
}
