<?php

namespace App\Http\Controllers\Campaigns;

use App\Actions\StoreCampaign;
use App\Dtos\CampaignDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaignRequest;
use App\Http\Resources\CampaignResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreCampaignController extends Controller
{
    public function __invoke(StoreCampaignRequest $request, StoreCampaign $storeCampaign): JsonResource
    {
        $campaign = $storeCampaign->handle(
            new CampaignDto(
                $request->client_id,
                $request->name,
                $request->start_date,
                $request->end_date,
            ));

        return new CampaignResource($campaign);
    }
}
