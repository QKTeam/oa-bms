<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_x_tag extends Model
{
    protected $table = 'book_x_tag';
    public function tag(){
    	return $this->belongsToMany('\App\Tag','\App\User_x_tag');
    }
}
