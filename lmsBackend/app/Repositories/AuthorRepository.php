<?php
namespace App\Repositories;

use App\Interfaces\AuthorRepositoryInterface;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;
use Illuminate\Http\JsonResponse;
use App\Models\Author;

class AuthorRepository implements AuthorRepositoryInterface {

    public function __construct(private Author $author) {
        
    }

    public function list(): JsonResponse {
        return response()->json(new AuthorCollection($this->author::paginate(config('app.paginate_size'))));
    }

    public function single($id): JsonResponse {
       return  response()->json(new AuthorResource($this->author::findOrFail($id)));
    }

    public function store(array $data): JsonResponse {
      $savedAuthor = $this->author::create($data);
      return response()->json(new AuthorResource($savedAuthor));
    }

    public function update(array $data, $id): JsonResponse {
        $this->author::whereId($id)->update($data);
        return $this->single($id);
    }
    
    public function delete($id): JsonResponse {
        $deletedAuthor = $this->author::destroy($id);
        return response()->json($deletedAuthor);
    }
}