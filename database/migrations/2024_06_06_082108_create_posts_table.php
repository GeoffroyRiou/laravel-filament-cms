<?php

use App\Enums\PostsStatus;
use App\Models\Categorie;
use App\Models\MediaLibraryFile;
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

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('excerpt');
            $table->string('slug');
            $table->string('model');
            $table->boolean('private')->default(false);
            $table->enum('statut', array_map(fn($case) => $case->value, PostsStatus::cases()));
            $table->foreignId('media_library_file_id')->nullable();
            $table->json('contenu')->nullable();
            $table->json('custom')->nullable();
            $table->integer('order')->default(0);
            $table->foreignId('categorie_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
