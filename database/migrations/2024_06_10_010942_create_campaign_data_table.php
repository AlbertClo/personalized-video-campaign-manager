<?php

use App\Models\Campaign;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaign_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Campaign::class);
            $table->string('user_id');
            $table->index('user_id');
            $table->text('video_url');
            $table->json('custom_fields');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_data');
    }
};
