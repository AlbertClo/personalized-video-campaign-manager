<?php

namespace App\Http\Controllers\CampaignData;

use App\Dtos\CampaignDataDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignDataRequest;
use App\Jobs\StoreCampaignDataJob;
use Illuminate\Http\JsonResponse;

class StoreCampaignDataController extends Controller
{
    public function __invoke(StoreCampaignDataRequest $request, $campaignId): JsonResponse
    {
        foreach ($request->data as $data) {
            StoreCampaignDataJob::dispatch(new CampaignDataDto(
                $campaignId,
                $data['user_id'],
                $data['video_url'],
                $data['custom_fields'],
            ));
        }

        return new JsonResponse(['data' => ['message' => 'Request Accepted']], 202);
    }
}
