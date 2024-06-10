<?php

use Illuminate\Support\Facades\Route;

Route::post('/campaign', \App\Http\Controllers\Campaigns\StoreCampaignController::class);
Route::post('/campaign/{campaignId}/data', \App\Http\Controllers\CampaignData\StoreCampaignDataController::class);

