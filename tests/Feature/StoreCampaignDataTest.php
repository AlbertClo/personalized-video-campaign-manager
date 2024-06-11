<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\Client;
use Tests\TestCase;

class StoreCampaignDataTest extends TestCase
{
    private int $campaignId = 1;

    public function setUp(): void
    {
        parent::setUp();

        Client::upsert([
            ['id' => 1, 'name' => 'Test Client']
        ], uniqueBy: ['id'], update: ['name']);

        Campaign::upsert([
            'id' => $this->campaignId,
            'client_id' => 1,
            'name' => 'Campaign One',
            'start_date' => '2024-01-01',
            'end_date' => '2025-01-01',
        ], uniqueBy: ['id'], update: ['name']);
    }

    public function test_can_store_campaign_data(): void
    {
        $response = $this->postJson("/api/campaign/{$this->campaignId}/data", ["data" =>
                [
                    [
                        "user_id" => "one@test.test",
                        "video_url" => "https://test.test.io/one",
                        "custom_fields" => "{\"title\": \"One\"}"
                    ],
                    [
                        "user_id" => "two@test.test",
                        "video_url" => "https://test.test.io/two",
                        "custom_fields" => "{\"title\": \"Two\"}"
                    ],
                    [
                        "user_id" => "three@test.test",
                        "video_url" => "https://test.test.io/three",
                        "custom_fields" => "{\"title\": \"Three\"}"
                    ],
                ],
            ]
        );

        $response->assertStatus(202);
        $this->assertDatabaseHas('campaign_data', [
            "user_id" => "one@test.test",
            "video_url" => "https://test.test.io/one",
            "custom_fields" => "{\"title\": \"One\"}"
        ]);
        $this->assertDatabaseHas('campaign_data', [
            "user_id" => "two@test.test",
            "video_url" => "https://test.test.io/two",
            "custom_fields" => "{\"title\": \"Two\"}"
        ]);
        $this->assertDatabaseHas('campaign_data', [
            "user_id" => "three@test.test",
            "video_url" => "https://test.test.io/three",
            "custom_fields" => "{\"title\": \"Three\"}"
        ]);
    }

    public function test_store_campaign_data_endpoint_returns_error_with_invalid_url(): void
    {
        $response = $this->postJson("/api/campaign/{$this->campaignId}/data", ["data" =>
                [
                    [
                        "user_id" => "one@test.test",
                        "video_url" => "https://test.test.io/one",
                        "custom_fields" => "{\"title\": \"One\"}"
                    ],
                    [
                        "user_id" => "two@test.test",
                        "video_url" => "not a valid url",
                    ],
                ],
            ],
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('data.1.video_url');
    }

    public function test_store_campaign_data_endpoint_returns_error_without_user_id(): void
    {
        $response = $this->postJson("/api/campaign/{$this->campaignId}/data", ["data" =>
                [
                    [
                        "video_url" => "https://test.test.io/one",
                        "custom_fields" => "{\"title\": \"One\"}"
                    ]
                ],
            ],
        );

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('data.0.user_id');
    }
}
