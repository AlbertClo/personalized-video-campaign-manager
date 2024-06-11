<?php

namespace App\Dtos;

readonly class CampaignDataDto
{
    public function __construct(
        public int  $campaignId,
        public string  $userId,
        public string  $videoUrl,
        public ?string $customFields,
    )
    {
    }
}
