<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentController extends Controller
{
    private function getUser ($token, $remember_token) {
        $url = 'http://oa.qkteam.com/api/getAuth';
        $user = file_get_contents("$url?token=$token&remember_token=$remember_token");
        $user = json_decode($user);
        return $user;
    }
    private function insertRent ($user_id, Book $book) {
        $book->available = false;
        $next_time = Carbon::now()->addMonth();
        $book->next_available_time = $next_time;

        DB::insert('INSERT INTO `user_x_book` (`user_id`, `book_id`, `return_time`, `created_at`, `updated_at`)
                    VALUES (?, ?, ?, ?, ?)', [$user_id, $book->id, $next_time, Carbon::now(), Carbon::now()]);
        $book->save();
        return $next_time->timestamp;
    }
    private function deleteRent ($user_id, Book $book) {
        DB::delete('DELETE FROM `user_x_book` WHERE `user_id` = ? AND `book_id` = ?', [$user_id, $book->id]);
        $book->available = true;
        $book->next_available_time = NULL;
        $book->save();
        return true;
    }
    private function getList ($user_id) {
        $rents = DB::table('user_x_book')->where('user_id', $user_id)->latest()->get();
        $books = [];
        foreach ($rents as $rent) {
            $book = Book::find($rent->book_id);
            if ($book === null) continue;
            $books[] = $book->data;
        }
        return $books;
    }

    public function Rent (Request $request, $book_id) {
        $book = Book::find($book_id);
        if ($book === null) abort(404);
        if ($book->available === 0) abort(499);
        $token = $request->header('Api-Token', $request->input('token', ''));
        $remember_token = $request->header('remember_token', $request->input('remember_token', ''));

        $user = $this->getUser($token, $remember_token);
        $expired_at = $this->insertRent($user->id, $book);
        return response([
            'status' => 1,
            'expired_at' => $expired_at,
        ]);
    }

    public function Revert (Request $request, $book_id) {
        $book = Book::find($book_id);
        if ($book === null) abort(404);
        if ($book->available === 1) return response([
            'status' => 1,
        ]);
        $token = $request->header('Api-Token', $request->input('token', ''));
        $remember_token = $request->header('remember_token', $request->input('remember_token', ''));

        $user = $this->getUser($token, $remember_token);
        if ($user->id !== $book->user) abort(403);

        if ($this->deleteRent($user->id, $book)) return response([
            'status' => 1,
        ]);
        else return response([
            'status' => 0,
        ]);
    }

    public function List (Request $request) {
        $token = $request->header('Api-Token', $request->input('token', ''));
        $remember_token = $request->header('remember_token', $request->input('remember_token', ''));

        $user = $this->getUser($token, $remember_token);
        $books = $this->getList($user->id);

        return response($books);
    }
}
