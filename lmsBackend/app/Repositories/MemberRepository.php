<?php
namespace App\Repositories;

use App\Interfaces\MemberRepositoryInterface;
use App\Http\Resources\MemberCollection;
use App\Http\Resources\MemberResource;
use Illuminate\Http\JsonResponse;
use App\Models\Member;

class MemberRepository implements MemberRepositoryInterface {

    public function __construct(private Member $member) {
        $this->with = [
        ];
    }
    
    public function list(): JsonResponse {
        return response()->json(new MemberCollection($this->member::paginate(config('app.paginate_size'))));
    }

    public function single($id): JsonResponse {
       return response()->json(new MemberResource($this->member::with($this->with)->findOrFail($id)));
    }

    public function store(array $data) : JsonResponse {
      $savedMember = $this->member::create($data);
      return response()->json(new MemberResource($savedMember));
    }

    public function update(array $data, $id): JsonResponse {
        $updatedMember = $this->member::whereId($id)->update($data);
       return $this->single($id);
    }
    
    public function delete($id): JsonResponse {
        $deletedMember = $this->member::destroy($id);
        return response()->json($deletedMember);
    }
}