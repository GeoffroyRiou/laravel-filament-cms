<?php

namespace App\View\Components;

use App\Models\MediaLibraryFile;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontCms extends Component
{
    public array $blocks = [];

    /**
     * Create a new component instance.
     */
    public function __construct(array $contenu)
    {
        $this->prepare($contenu);
    }

    public function prepare(array $contenu): void
    {
        foreach ($contenu as $block) {

            $currentBlock = new \stdClass();

            switch ($block['type']) {
                case 'titre':
                    $currentBlock->type = 'titre';
                    $currentBlock->niveau = $block['data']['niveau'];
                    $currentBlock->texte = $block['data']['texte'];
                    break;

                case 'image':
                case 'fichier':
                    $mediaFile = MediaLibraryFile::find($block['data']['file']);

                    // Si pas de fichier lié, on arrête là pour le cbloc
                    if ($mediaFile && ! empty($mediaFile->getFirstMedia('*'))) {
                        $currentBlock->type = $block['type'];
                        $currentBlock->media = $mediaFile;
                    }

                    break;

                case "colored_block":
                    
                    $currentBlock->type = $block['type'];
                    $mediaFile = MediaLibraryFile::find($block['data']['file']);

                    if ($mediaFile && ! empty($mediaFile->getFirstMedia('*'))) {
                        $currentBlock->media = $mediaFile;
                    }
                    $currentBlock->titre = $block['data']['titre'] ?? '';
                    $currentBlock->contenu = $block['data']['contenu'] ?? '';
                    $currentBlock->reverse = $block['data']['reverse'] ?? false;
                    $currentBlock->texte_large = $block['data']['texte_large'] ?? false;
                    $currentBlock->couleur = $block['data']['couleur'] ?? 'jaune';

                    break;

                case "team":
                    
                    $currentBlock->type = $block['type'];
                    $currentBlock->images = [];

                    foreach($block['data']['teamImages'] as $image){
                        $imageObj = new \stdClass();

                        $mediaFile = MediaLibraryFile::find($image['file']);

                        if ($mediaFile && ! empty($mediaFile->getFirstMedia('*'))) {
                            $imageObj->media = $mediaFile;
                        }
                        $imageObj->nom = $image['nom'];
                        $imageObj->poste = $image['poste'];

                        $currentBlock->images[] = $imageObj;
                    }

                    break;

                case "impact":
                    
                    $currentBlock->type = $block['type'];
                    $currentBlock->titre = $block['data']['titre'] ?? '';
                    $currentBlock->contenu = $block['data']['contenu'] ?? '';
                    $currentBlock->baseline = $block['data']['baseline'] ?? '';
                    $currentBlock->couleur = $block['data']['couleur'] ?? 'jaune';

                    break;

                default:
                    $currentBlock->type = $block['type'];
                    $currentBlock->contenu = $block['data']['contenu'] ?? '- Aucun contenu -';
                    break;
            }

            if (! empty($currentBlock->type)) {
                $this->blocks[] = $currentBlock;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.front-cms');
    }
}
