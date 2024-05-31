<?php
namespace App\Repositories;

use App\Interfaces\BorrowBookRepositoryInterface;
use App\Http\Resources\BorrowBookCollection;
use App\Http\Resources\BorrowBookResource;
use Illuminate\Http\JsonResponse;
use App\Models\BorrowBook;

class BorrowBookRepository implements BorrowBookRepositoryInterface {

    public function __construct(private BorrowBook $borrowBook) {
        $this->with = [
            "member", "book"
        ];
    }

    public function list(): JsonResponse {
        return response()->json(new BorrowBookCollection($this->borrowBook::with($this->with)->paginate(config('app.paginate_size'))));
    }

    public function single($id): JsonResponse {
       return response()->json(new BorrowBookResource($this->borrowBook::with($this->with)->findOrFail($id)));
    }

    public function store(array $data) : JsonResponse {
      $savedBorrowBook = $this->borrowBook::create($data);
      return response()->json(new BorrowBookResource($savedBorrowBook));
    }

    public function update(array $data, $id): JsonResponse {
        $updatedBorrowBook = $this->borrowBook::whereId($id)->update($data);
        if ($updatedBorrowBook) {
            return $this->single($id);
        } else {
            return response()->json(["message" => __('common.no_data_found')]);
        }
    }
    
    public function delete($id): JsonResponse {
        $deletedBorrowBook = $this->borrowBook::destroy($id);
        return response()->json($deletedBorrowBook);
    }
}