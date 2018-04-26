<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function Create (Request $request) {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'isbn' => 'required|string',
        ]);
        if ($validate->fails()) return response($validate->errors(), 422);

        $book_isbn = $request->input('isbn', '0');
        try {
            system("python " . __DIR__ . "/ISBN.py $book_isbn " . __DIR__ . "/../../../storage/test");
        } catch (\Exception $exception) {}
        $start = Carbon::now();
        while (! file_exists(__DIR__ . "/../../../storage/test") && Carbon::now() < $start->addSeconds(20));
        try {
            $a = file_get_contents(__DIR__ . "/../../../storage/test");
            unlink(__DIR__ . "/../../../storage/test");
            $a = json_decode($a);
        } catch (\Exception $exception) {
            $a = [
                [
                    'img_url' => '',
                    'authors' => '',
                    'publisher' => '',
                    'publishDate' => '',
                ],
            ];
        }
        $book_info = $a[0];
        $book = new Book();
        if (isset($book_info->img_url)) $book->img_url = $book_info->img_url;
        if (isset($book_info->publisher)) $book->publisher = $book_info->publisher;
        if (isset($book_info->authors)) $book->authors = $book_info->authors;
        if (isset($book_info->publishDate)) $book->publishDate = $book_info->publishDate;
        if (isset($book_info->title)) $book->name = $book_info->title;
        else $book->name = $request->input('name');
        $book->description = $request->input('description');
        $book->save();
        return response([
            'book_id' => $book->id,
        ]);
    }

    public function List () {
        $books = Book::all();
        $response = [];
        foreach ($books as $book) {
            $response[] = $book->data;
        }
        return response($response);
    }

    public function Detail ($book_id) {
        $book = Book::find($book_id);
        if ($book === null) abort(404);
        return response($book->detail);
    }

    public function Change (Request $request, $book_id) {
        $validate = Validator::make($request->all(), [
            'description' => 'nullable|string',
        ]);
        if ($validate->fails()) return response($validate->errors(), 422);

        $book = Book::find($book_id);
        if ($book === null) abort(404);
        $book->description = $request->input('description', $book->description);

        $book->save();
        return response($book->id);
    }

    public function Delete ($book_id) {
        $book = Book::find($book_id);
        if ($book === null) return response([]);
        $book->delete();
        return response([]);
    }
}
