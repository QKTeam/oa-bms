<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_x_book extends Model
{
    protected $table = 'User_x_book';
    public function tag(){
    	return $this->belongsToMany('\App\Book_x_tag','\App\Tag');
    }
}
