<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\CampaignData;
use App\Models\Client;
use Tests\TestCase;

class StoreCampaignTest extends TestCase
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

    public function test_can_store_campaign(): void
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
        $response->assertExactJson([
            "id" => 1,
            "client_id" => 1,
            "name" => "Campaign One",
            "start_date" => "2024-01-01",
            "end_date" => "2025-01-01",
            'campaign_data' => [],
        ]);
    }

    public function test_can_store_campaign_without_end_date(): void
    {
        $response = $this->postJson('/api/campaign',
            [
                'client_id' => 1,
                'name' => 'Campaign One',
                'start_date' => '2024-01-01',
            ]
        );

        $response->assertStatus(201);
        $response->assertExactJson([
            "id" => 1,
            "client_id" => 1,
            "name" => "Campaign One",
            "start_date" => "2024-01-01",
            "end_date" => null,
            'campaign_data' => [],
        ]);
    }

    public function test_get_422_response_when_storing_campaign_with_invalid_client_id(): void
    {
        $response = $this->postJson('/api/campaign',
            [
                'client_id' => 2,
                'name' => 'Campaign One',
                'start_date' => '2024-01-01',
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('client_id');

    }

    public function test_get_422_response_when_storing_campaign_without_name(): void
    {
        $response = $this->postJson('/api/campaign',
            [
                'client_id' => 2,
                'start_date' => '2024-01-01',
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('name');

    }

    public function test_get_422_response_when_storing_campaign_with_invalid_dates(): void
    {
        $response = $this->postJson('/api/campaign',
            [
                'client_id' => 1,
                'name' => 'Campaign One',
                'start_date' => '2024-02-01',
                'end_date' => '2024-01-01',
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('end_date');
    }

    public function test_get_422_response_when_storing_campaign_without_start_date(): void
    {
        $response = $this->postJson('/api/campaign',
            [
                'client_id' => 1,
                'name' => 'Campaign One',
                'end_date' => '2024-01-01',
            ]
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('start_date');
    }
}
