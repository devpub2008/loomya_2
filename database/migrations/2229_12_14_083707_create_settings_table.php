<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('settings_new')) {
            Schema::create('settings_new', function (Blueprint $table): void {
                $table->id();
                $table->string('group');
                $table->string('name');
                $table->boolean('locked')->default(false);
                $table->longText('payload');
                $table->timestamps();
                $table->unique(['group', 'name']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings_new');
    }

};
