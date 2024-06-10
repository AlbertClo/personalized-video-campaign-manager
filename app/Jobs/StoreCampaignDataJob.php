<?php

namespace App\Jobs;

use App\Actions\StoreCampaignData;
use App\Dtos\CampaignDataDto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreCampaignDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public CampaignDataDto $campaignDataDto,
    ) {}

    public function handle(StoreCampaignData $storeCampaignData): void
    {
        $storeCampaignData->handle($this->campaignDataDto);
    }
}
