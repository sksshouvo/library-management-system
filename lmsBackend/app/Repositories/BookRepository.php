<?php
namespace App\Repositories;

use App\Interfaces\BookRepositoryInterface;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use Illuminate\Http\JsonResponse;
use App\Models\Book;

class BookRepository implements BookRepositoryInterface {

    public function __construct(private Book $book) {
        
    }
    
    public function list(): JsonResponse {
        return $this->book::all();
    }

    public function single($id): JsonResponse {
       return $this->book::findOrFail($id);
    }

    public function store(array $data) : JsonResponse {
      $savedBook = $this->book::create($data);
      return new BookResource($savedBook);
    }

    public function update(array $data, $id): JsonResponse {
       return $this->book::whereId($id)->update($data);
    }
    
    public function delete($id): JsonResponse {
        return $this->book::destroy($id);
    }
}