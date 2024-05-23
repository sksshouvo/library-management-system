<?php
namespace App\Repositories;

use App\Interfaces\MemberRepositoryInterface;
use App\Http\Resources\MemberCollection;
use App\Http\Resources\MemberResource;
use Illuminate\Http\JsonResponse;
use App\Models\Member;

class MemberRepository implements MemberRepositoryInterface {

    public function __construct(private Member $member) {
        
    }
    
    public function list(): JsonResponse {
        return $this->member::all();
    }

    public function single($id): JsonResponse {
       return $this->member::findOrFail($id);
    }

    public function store(array $data) : JsonResponse {
      $savedMember = $this->member::create($data);
      return response()->json(new MemberResource($savedMember));
    }

    public function update(array $data, $id): JsonResponse {
       return $this->member::whereId($id)->update($data);
    }
    
    public function delete($id): JsonResponse {
        return $this->member::destroy($id);
    }
}