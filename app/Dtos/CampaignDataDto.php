<?php

namespace App\Dtos;

readonly class CampaignDataDto
{
    public function __construct(
        public string  $campaignId,
        public string  $userId,
        public string  $videoUrl,
        public ?string $customFields,
    )
    {
    }
}
