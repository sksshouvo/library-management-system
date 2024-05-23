<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorStoreRequest;
use App\Repositories\AuthorRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct(public AuthorRepository $authorRepository) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->successResponse(__('author.list'), $this->authorRepository->list()->getData(), $request->bearerToken(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request): JsonResponse
    {
        try {
            
            DB::beginTransaction();
            $author = $this->authorRepository->store($request->validated());
            DB::commit();
            return $this->successResponse(__('author.created'), $author->getData(), $request->bearerToken(), 201);
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $singleAuthor = $this->authorRepository->single($id)->getData();
        if ($singleAuthor) {
            return $this->successResponse(__('author.list'), $singleAuthor, $request->bearerToken(), 200);
        } else {
            return $this->errorResponse(__('author.invalid_id'), NULL, $request->bearerToken(), 422);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();
            $author = $this->authorRepository->update($request->validated(), $id);
            DB::commit();
            return $this->successResponse(__('author.updated'), $author->getData(), $request->bearerToken(), 200);
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();
            $author = $this->authorRepository->delete($id);
            DB::commit();
            if ($author->getData()) {
                return $this->successResponse(__('author.deleted'), NULL, $request->bearerToken(), 200);
            } else {
                return $this->errorResponse(__('author.invalid_id'), NULL, $request->bearerToken());
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }
}
