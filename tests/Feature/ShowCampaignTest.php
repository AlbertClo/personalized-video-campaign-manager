<?php

namespace Feature;

use App\Models\Campaign;
use App\Models\CampaignData;
use App\Models\Client;
use Tests\TestCase;

class ShowCampaignTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Client::upsert([
            ['id' => 1, 'name' => 'Test Client']
        ], uniqueBy: ['id'], update: ['name']);

        Campaign::truncate();
        CampaignData::truncate();
    }

    public function test_can_show_campaign(): void
    {
        $response = $this->postJson('/api/campaign',
            [
                'client_id' => 1,
                'name' => 'Campaign One',
                'start_date' => '2024-01-01',
                'end_date' => '2025-01-01',
            ]
        );
        $response->assertStatus(201);
        $campaignId = $response->getOriginalContent()->id;

        $response = $this->getJson("/api/campaign/{$campaignId}");
        $response->assertExactJson([
            "id" => 1,
            "client_id" => 1,
            "name" => "Campaign One",
            "start_date" => "2024-01-01",
            'end_date' => '2025-01-01',
            "campaign_data" => [],
        ]);
    }
}
