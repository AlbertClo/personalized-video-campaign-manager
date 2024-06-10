<?php

namespace App\Actions;

use App\Dtos\CampaignDto;
use App\Models\Campaign;

class StoreCampaign
{
    public function handle(CampaignDto $campaignDto): Campaign
    {
        return Campaign::create([
            'client_id' => $campaignDto->clientId,
            'name' => $campaignDto->name,
            'start_date' => $campaignDto->startDate,
            'end_date' => $campaignDto->endDate ?? null,
        ]);
    }
}
