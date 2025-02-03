<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;

class ImageService
{
    private string $directory = 'public';
    private string $resizedDirectory = 'sizes';

    /**
     * Point d'entrée principal pour le redimensionnement d'image
     */
    public function getResizedImage(string $imagePath, int $width, int $height, bool $crop = true): string
    {
        if (!$this->isResizable($imagePath)) {
            return $imagePath;
        }

        $resizedFilename = $this->generateResizedFilename($imagePath, $width, $height, $crop);
        $resizedPath = $this->getResizedPath($resizedFilename);

        if (!$this->resizedImageExists($resizedPath)) {
            $this->createResizedImage($imagePath, $resizedPath, $width, $height, $crop);
        }

        return $this->getPublicPath($resizedFilename);
    }

    /**
     * Génère le nom du fichier redimensionné
     */
    private function generateResizedFilename(string $imagePath, int $width, int $height, bool $crop): string
    {
        $filename = basename($imagePath);
        return sprintf(
            '%s-%dx%d%s.avif',
            pathinfo($filename, PATHINFO_FILENAME),
            $width,
            $height,
            $crop ? '-crop' : ''
        );
    }

    /**
     * Retourne le chemin complet du fichier redimensionné
     */
    private function getResizedPath(string $resizedFilename): string
    {
        return $this->directory . '/' . $this->resizedDirectory . '/' . $resizedFilename;
    }

    /**
     * Retourne le chemin de l'image originale
     */
    private function getOriginalPath(string $imagePath): string
    {
        return Storage::disk('local')->path($this->directory . '/' . $imagePath);
    }

    /**
     * Vérifie si l'image redimensionnée existe déjà
     */
    private function resizedImageExists(string $resizedPath): bool
    {
        return Storage::disk('local')->exists($resizedPath);
    }

    /**
     * Crée l'image redimensionnée
     */
    private function createResizedImage(string $imagePath, string $resizedPath, int $width, int $height, bool $crop): void
    {
        $manager = ImageManager::gd();
        $image = $manager->read($this->getOriginalPath($imagePath));

        if ($crop) {
            $image->cover($width, $height, position: 'center');
        } else {
            $image->resize($width);
        }

        Storage::disk('local')->put($resizedPath, $image->toAvif(80));
    }

    /**
     * Retourne le chemin public de l'image redimensionnée
     */
    private function getPublicPath(string $resizedFilename): string
    {
        return $this->resizedDirectory . '/' . $resizedFilename;
    }

    /**
     * Vérifie si le format de l'image permet le redimensionnement
     */
    private function isResizable(string $filename): bool
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'avif'];

        return in_array($extension, $allowedExtensions);
    }
}
