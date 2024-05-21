<?php

namespace App\Http\Controllers;
use App\Repositories\BidRequestRepository;
use App\Http\Requests\ValidateBidRequest;
use App\Http\Resources\BidderResource;
use App\Classes\ApiResponseClass;
use Illuminate\Http\Request;

class BidRequestController extends Controller
{
    public function compareWithCampaign(ValidateBidRequest $request) {
        try {
            $comparedCampaign = $this->bidRequestRepository->compareWithCampaign($request->validated());
            if (!$comparedCampaign) {
                return ApiResponseClass::sendResponse([], __('No Data Found'), 422);
            }

            return ApiResponseClass::sendResponse(new BidderResource($comparedCampaign), __('Bidder Campaign'), 200);
            
        } catch (\Exception $e) {
            return ApiResponseClass::rollback($ex);
        }
    }
}
