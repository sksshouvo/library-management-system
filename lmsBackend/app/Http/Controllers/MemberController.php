<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberUpdateRequest;
use App\Http\Requests\MemberStoreRequest;
use App\Repositories\MemberRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function __construct(public MemberRepository $memberRepository) {
        //
    }
    /**
 * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $member = $this->memberRepository->list()->getData();
        return $this->successResponse(__('member.list'), $member, request()->bearerToken(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MemberStoreRequest $request, MemberRepository $memberService)
    {
        try {
            DB::beginTransaction();
            $member = $memberService->store($request->validated());
            DB::commit();
            return $this->successResponse(__('member.created'), $member->getData(), $request->bearerToken(), 201);
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            return $this->successResponse(__('member.single'), $this->memberRepository->single($id)->getData(), request()->bearerToken(), 200);
        } catch (\Exception $e) {
            return $this->errorResponse(__('common.no_data_found'), NULL, request()->bearerToken(), 422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MemberUpdateRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $member = $this->memberRepository->update($request->validated(), $id);
            DB::commit();
            return $this->successResponse(__('member.updated'), $member->getData(), $request->bearerToken(), 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $member = $this->memberRepository->delete($id);
            DB::commit();
            if ($member->getData()) {
                return $this->successResponse(__('member.deleted'), NULL, $request->bearerToken(), 200);
            } else {
                return $this->errorResponse(__('member.invalid_id'), NULL, $request->bearerToken());
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }
}
