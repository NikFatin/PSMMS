<?php

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
        Schema::dropIfExists('booking_titles');
        Schema::dropIfExists('booking_supervisors');
        Schema::dropIfExists('approval_supervisors');
        Schema::dropIfExists('approval_titles');
        Schema::dropIfExists('project');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
