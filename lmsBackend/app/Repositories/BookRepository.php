<?php
namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use Illuminate\Http\JsonResponse;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface {

    public function __construct(private Book $book) {
        $this->with = [
            "author"
        ];
    }

    public function list(): JsonResponse {
        return response()->json(new BookCollection($this->book::with($this->with)->paginate(config('app.paginate_size'))));
    }

    public function single($id): JsonResponse {
       return response()->json(new BookResource($this->book::with($this->with)->findOrFail($id)));
    }

    public function store(array $data) : JsonResponse {
      $savedBook = $this->book::create($data);
      return response()->json(new BookResource($savedBook));
    }

    public function update(array $data, $id): JsonResponse {
        $updatedBook = $this->book::whereId($id)->update($data);
        if ($updatedBook) {
            return $this->single($id);
        } else {
            return response()->json(["message" => __('common.no_data_found')]);
        }
    }
    
    public function delete($id): JsonResponse {
        $deletedBook = $this->book::destroy($id);
        return response()->json($deletedBook);
    }
}