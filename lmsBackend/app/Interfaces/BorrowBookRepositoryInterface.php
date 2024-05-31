<?php

namespace App\Interfaces;
use Illuminate\Http\JsonResponse;

interface BorrowBookRepositoryInterface
{
    public function list(): JsonResponse;
    public function single($id): JsonResponse;
    public function store(array $data): JsonResponse;
    public function update(array $data,$id): JsonResponse;
    public function delete($id): JsonResponse;
}
