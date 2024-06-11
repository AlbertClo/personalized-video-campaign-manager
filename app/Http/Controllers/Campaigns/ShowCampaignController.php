<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowCampaignController extends Controller
{
    public function __invoke(int $campaignId): JsonResponse | JsonResource
    {
        $campaign = Campaign::whereId($campaignId)->first();
        if ($campaign === null) {
            return new JsonResponse(['message' => "Campaign with ID {$campaignId} not found."], 404);
        }

        return new CampaignResource($campaign);
    }
}
