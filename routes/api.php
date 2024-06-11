<?php

use Illuminate\Support\Facades\Route;

Route::get('/campaign/{campaignId}', \App\Http\Controllers\Campaigns\ShowCampaignController::class);
Route::post('/campaign', \App\Http\Controllers\Campaigns\StoreCampaignController::class);
Route::post('/campaign/{campaignId}/data', \App\Http\Controllers\CampaignData\StoreCampaignDataController::class);

