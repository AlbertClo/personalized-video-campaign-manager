<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'client_id' => $this->client_id,
            'name' => $this->name,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'campaign_data' => CampaignDataResource::collection($this->campaignData),
        ];
    }
}
