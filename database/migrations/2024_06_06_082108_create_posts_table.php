<?php

use App\Enums\PostsStatus;
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
            $table->string('slug');
            $table->string('model');
            $table->enum('statut', array_map(fn ($case) => $case->value, PostsStatus::cases()));
            $table->foreignIdFor(MediaLibraryFile::class)->nullable();
            $table->json('contenu')->nullable();
            $table->json('custom')->nullable();
            $table->integer('order')->default(0);
            $table->unsignedBigInteger('categorie_id')->nullable();
            $table->timestamps();

            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');
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
