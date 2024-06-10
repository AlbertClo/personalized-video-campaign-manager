<?php

namespace App\Actions;

use App\Dtos\CampaignDataDto;
use App\Models\CampaignData;

class StoreCampaignData
{
    public function handle(CampaignDataDto $campaignDataDto): CampaignData
    {
        return CampaignData::create([
            'campaign_id' => $campaignDataDto->campaignId,
            'user_id' => $campaignDataDto->userId,
            'video_url' => $campaignDataDto->videoUrl,
            'custom_fields' => $campaignDataDto->customFields ?? null,
        ]);
    }
}
