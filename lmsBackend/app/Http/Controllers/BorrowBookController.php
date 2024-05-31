<?php

namespace App\Http\Controllers;
use App\Http\Requests\BorrowBookUpdateRequest;
use App\Http\Requests\BorrowBookStoreRequest;
use App\Repositories\BorrowBookRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BorrowBookController extends Controller
{
    public function __construct(public BorrowBookRepository $borrowBookRepository) {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->successResponse(__('borrowBook.list'), $this->borrowBookRepository->list()->getData(), $request->bearerToken(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BorrowBookStoreRequest $request) : JsonResponse
    {
        try {
            DB::beginTransaction();
            $borrowBook = $this->borrowBookRepository->store($request->validated());
            DB::commit();
            return $this->successResponse(__('borrowBook.created'), $borrowBook->getData(), $request->bearerToken(), 201);
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
        try {
            return $this->successResponse(__('borrowBook.single'), $this->borrowBookRepository->single($id)->getData(), request()->bearerToken(), 200);
        } catch (\Throwable $th) {
            return $this->errorResponse(__('common.no_data_found'), $th, request()->bearerToken(), 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BorrowBookUpdateRequest $request, string $id)
    {
        try {
            DB::beginTransaction();
            $borrowBook = $this->borrowBookRepository->update($request->validated(), $id);
            if (!empty($borrowBook->getdata()->message)) {
                return $this->errorResponse(__('common.no_data_found'), NULL, $request->bearerToken(), 422);
            }
            DB::commit();
            return $this->successResponse(__('borrowBook.updated'), $borrowBook->getData(), $request->bearerToken(), 200);
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
            $borrowBook = $this->borrowBookRepository->delete($id);
            DB::commit();
            if ($borrowBook->getData()) {
                return $this->successResponse(__('borrowBook.deleted'), NULL, $request->bearerToken(), 200);
            } else {
                return $this->errorResponse(__('borrowBook.invalid_id'), NULL, $request->bearerToken());
            }
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::emergency($e);
            return $this->errorResponse(__('common.error'), $e, $request->bearerToken());
        }
    }
    
}
