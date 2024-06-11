<?php

namespace App\Dtos;

readonly class CampaignDto
{
    public function __construct(
        public int  $clientId,
        public string  $name,
        public string  $startDate,
        public ?string $endDate,
    )
    {
    }
}
