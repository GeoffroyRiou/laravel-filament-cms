<?php

namespace App\Filament\Blocks;

use App\Forms\Components\MediaFileField;
use App\Models\Page;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;

class CMSField extends Builder
{
    /**
     * Configure le schéma du formulaire pour le CMSField.
     *
     * Cette méthode initialise le schéma du formulaire en ajoutant divers composants
     * tels que des champs de texte, des champs de sélection, un éditeur enrichi, des
     * interrupteurs de basculement et des répétiteurs. Le schéma est défini en utilisant
     * la classe Builder\Block et ses composants de schéma correspondants.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('')
            ->addActionLabel('Ajouter un bloc')

            ->schema([

                // CONTENU EDITORIAL
                Builder\Block::make('cms.generic-content')
                    ->label('Contenu éditorial')
                    ->schema([
                        RichEditor::make('content')->label('Contenu')
                            ->required()
                            ->disableToolbarButtons([
                                'attachFiles',
                            ]),
                    ]),

                // IMAGE
                Builder\Block::make('cms.simple-image')
                    ->label('Image pleine largeur')
                    ->schema([
                        self::getDefaultImageUploadField(label: 'Image'),
                        TextInput::make('alt')->label('Texte alternatif')->required(),
                    ]),

                // BOUTON
                Builder\Block::make('cms.simple-button')
                    ->label('Bouton pleine largeur')
                    ->schema([
                        Select::make('icon')
                            ->label('Icône')
                            ->options([
                                'pdf' => 'PDF',
                            ]),
                        ToggleButtons::make('type')
                            ->label('Type de lien')
                            ->options([
                                'page' => 'Page du site',
                                'customLink' => 'Lien personnalisé',
                                'file' => 'Fichier public',
                                'filePrivate' => 'Fichier privé',
                            ])
                            ->required()
                            ->inline()
                            ->live(),
                        Section::make('Page')
                            ->schema(self::getButtonSectionSchema(hasStyle: false))
                            ->visible(fn(Get $get): bool => $get('type') == 'page'),
                        Section::make('Lien')
                            ->schema([
                                TextInput::make('link')->label('Lien')->url()->required(),
                                TextInput::make('label')->label('Intitulé du bouton')->required(),
                            ])
                            ->visible(fn(Get $get): bool => $get('type') == 'customLink'),
                        Section::make('Fichier public')
                            ->schema([
                                FileUpload::make('file')
                                    ->maxSize(1024 * 5),
                                TextInput::make('label')->label('Intitulé du bouton')->required(),
                            ])
                            ->visible(fn(Get $get): bool => $get('type') == 'file'),
                        Section::make('Fichier privé')
                            ->schema([
                                FileUpload::make('filePrivate')
                                    ->maxSize(1024 * 5)
                                    ->disk('private'),
                                TextInput::make('label')->label('Intitulé du bouton')->required(),
                            ])
                            ->visible(fn(Get $get): bool => $get('type') == 'filePrivate'),
                        TextInput::make('subtitle')->label('Soustitre'),
                        ToggleButtons::make('style')
                            ->label('Style visuel')
                            ->options([
                                '-white' => 'Blanc',
                                '-main-m' => 'Vert foncé',
                            ])->inline(),
                    ]),

                // HERO
                Builder\Block::make('cms.hero')
                    ->label('Héro')
                    ->schema([
                        TextInput::make('titre')->label('Titre principal')->required(),
                        TextInput::make('baseline')->label('Sous-titre')->required(),
                        TextInput::make('horaires')->label('Horaires')->required(),
                        Textarea::make('intro')->label('Introduction')->required(),
                        Section::make('bouton')->label('Bouton 1')->schema(self::getButtonSectionSchema('bouton1_')),
                        Section::make('bouton2')->label('Bouton 2')->schema(self::getButtonSectionSchema('bouton2_')),
                    ]),

                // BLOC DE TEXTE AVEC ILLUSTRATION
                Builder\Block::make('cms.text-image')
                    ->label('Texte avec image d\'illustration')
                    ->schema([
                        self::getDefaultImageUploadField(),
                        Toggle::make('image_right')->label('Image à droite')->default(false),
                        Toggle::make('image_full')->label('Image couvrante')->default(false),
                        TextInput::make('title_light')->label('Partie du titre claire'),
                        TextInput::make('title_dark')->label('Partie du titre foncée'),
                        ToggleButtons::make('bgTextColor')->label('Couleur de fond du texte')->options([
                            'white' => 'Blanc (par défaut)',
                            'main-l' => 'Vert clair',
                            'main-m' => 'Vert foncé',
                        ])->required()->inline(),
                        RichEditor::make('text')->label('Introduction')->required(),
                        Toggle::make('add_button')->label('Avec un bouton')->default(true)->live(),
                        Section::make('bouton')
                            ->label('Bouton')
                            ->schema(self::getButtonSectionSchema())
                            ->visible(fn(Get $get): bool => $get('add_button')),
                    ]),

                // BANDEAU AVEC PICTO
                Builder\Block::make('cms.stripe')
                    ->label('Bandeau avec picto et texte')
                    ->schema([
                        self::getDefaultImageUploadField(label: 'Pictogramme'),
                        TextInput::make('title')->label('Titre'),
                        ToggleButtons::make('format')->label('Format')->options([
                            'light' => 'Vert clair avec texte',
                            'dark' => 'Vert foncé avec bouton',
                        ])
                            ->required()
                            ->default('light')
                            ->inline()
                            ->live(),
                        Textarea::make('text')->label('Texte')->visible(fn(Get $get): bool => $get('format') == 'light'),
                        Section::make('bouton')
                            ->label('Bouton')
                            ->schema(self::getButtonSectionSchema())
                            ->visible(fn(Get $get): bool => $get('format') == 'dark'),
                    ]),

                // BLOCS DE PAGES
                Builder\Block::make('cms.pages-blocks')
                    ->label('Blocs de pages')
                    ->schema([
                        Repeater::make('cards')
                            ->label('')
                            ->itemLabel(fn(array $state): ?string => ($state['title'] ?? 'Page'))
                            ->schema([
                                self::getDefaultImageUploadField(label: 'Image de fond'),
                                TextInput::make('title')->label('Titre'),
                                Section::make('bouton')->label('Bouton')->schema(self::getButtonSectionSchema()),
                                ToggleButtons::make('format')->label('Format')->options([
                                    'standard' => 'Standard',
                                    'main-l' => 'Vert clair',
                                    'main-m' => 'Vert foncé',
                                    'second-m' => 'Bleu/vert',
                                ])
                                    ->inline()->required()
                            ])
                            ->cloneable()
                            ->collapsed()
                            ->collapsible()
                            ->addActionLabel('Ajouter un bloc de page')
                    ]),

                // DERNIERS ARTICLES
                Builder\Block::make('cms.last-articles')
                    ->label('Derniers articles')
                    ->schema([
                        TextInput::make('title_light')->label('Partie du titre claire'),
                        TextInput::make('title_dark')->label('Partie du titre foncée'),
                        RichEditor::make('text')->label('Introduction')->required(),
                        Section::make('bouton')->label('Bouton')->schema(self::getButtonSectionSchema()),
                    ]),

                // SLIDER DE LOGOS
                Builder\Block::make('cms.slider-logos')
                    ->label('Carousel de logos')
                    ->schema([
                        TextInput::make('title')->label('Titre'),
                        Repeater::make('logos')
                            ->label('')
                            ->itemLabel(fn(array $state): ?string => 'Logo ' . ($state['label'] ?? ''))
                            ->schema([
                                FileUpload::make('logo')
                                    ->acceptedFileTypes(['image/svg+xml'])
                                    ->maxSize(1024),
                                TextInput::make('label')->label('Légende'),
                                TextInput::make('link')->label('Lien')->url()->required(),
                            ])
                            ->cloneable()
                            ->collapsed()
                            ->collapsible()
                            ->addActionLabel('Ajouter un autre logo')
                    ]),

                // CHIFFRES CLES
                self::getKeyNumbersField('Chiffres clés'),

                // SECTION MÉTIER
                Builder\Block::make('cms.job-section')
                    ->label('Section métier')
                    ->schema([
                        self::getDefaultImageUploadField(label: 'Illustration'),
                        TextInput::make('title_light')->label('Partie du titre claire'),
                        TextInput::make('title_dark')->label('Partie du titre foncée'),
                        Toggle::make('image_right')->label('Image à droite')->default(false),
                        Repeater::make('paragraphs')
                            ->label('')
                            ->itemLabel(fn(array $state): ?string => 'Paragraphe')
                            ->schema([
                                TextInput::make('label')->label('Intitulé')->required(),
                                ToggleButtons::make('labelColor')->label('Couleur de fond de l\'intitulé')->options([
                                    'main-l' => 'Vert clair',
                                    'main-m' => 'Vert foncé',
                                    'second-m' => 'Bleu/vert',
                                ])->required()->inline(),
                                RichEditor::make('text')->label('Texte')->required(),
                            ])
                            ->cloneable()
                            ->collapsed()
                            ->collapsible()
                            ->addActionLabel('Ajouter un paragraphe')
                    ]),

                // Equipe
                Builder\Block::make('cms.team')
                    ->label('Equipe')
                    ->schema([
                        ToggleButtons::make('bgColor')->label('Couleur de fond')->options([
                            'main-l' => 'Vert clair',
                            'second-l' => 'Bleu/vert',
                        ])->required()->inline(),
                        Repeater::make('members')
                            ->label('')
                            ->itemLabel(fn(array $state): ?string => $state['firstname'] ?? 'Membre')
                            ->schema([
                                self::getDefaultImageUploadField(label: 'Photo'),
                                TextInput::make('firstname')->label('Prénom')->required(),
                                TextInput::make('job')->label('Métier')->required(),
                                TextInput::make('role')->label('Rôle'),
                                RichEditor::make('text')->label('Présentation')->required(),
                                TextInput::make('duration')->label('Ancienneté')->required()->prefix('Avec nous depuis : '),
                            ])
                            ->cloneable()
                            ->collapsed()
                            ->collapsible()
                            ->addActionLabel('Ajouter un.e membre')
                    ]),

                // LE MOT DE LA GESTIONNAIRE
                Builder\Block::make('cms.administrator-word')
                    ->label('Le mot de la gestionnaire')
                    ->schema([
                        TextInput::make('title')->label('Titre'),
                        RichEditor::make('text')->label('Texte')->required(),
                        self::getDefaultImageUploadField(label: 'Photo'),
                        TextInput::make('name')->label('Nom'),
                        TextInput::make('role')->label('Rôle'),
                        self::getDefaultImageUploadField('signature', label: 'Signature'),
                    ]),

                // Simulateur tarifaire
                Builder\Block::make('cms.simulator')
                    ->label('Infos simulation tarifaire')
                    ->schema([
                        TextInput::make('title')->label('Titre')->required(),
                        RichEditor::make('text')->label('Texte')->required(),
                        TextInput::make('button_link')->label('Lien')->url()->required(),
                        TextInput::make('button_label')->label('Intitulé du bouton')->required(),
                    ]),

                // TIMELINE
                Builder\Block::make('cms.timeline')
                    ->label('Frise chronologique')
                    ->schema([
                        Repeater::make('items')
                            ->label('')
                            ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Date')
                            ->schema([
                                DatePicker::make('date')->label('Date')->required(),
                                TextInput::make('title')->label('Titre')->required(),
                                Textarea::make('text')->label('Texte')->required(),
                            ])
                            ->cloneable()
                            ->collapsed()
                            ->collapsible()
                            ->addActionLabel('Ajouter une date')
                    ]),

                // ORGANISATION
                Builder\Block::make('cms.arrangement')
                    ->label('Organisation')
                    ->schema([
                        TextInput::make('title')->label('Titre')->required(),
                        TextInput::make('subtitle')->label('Sous-titre')->required(),
                        self::getDefaultImageUploadField(label: 'Illustration'),
                        ToggleButtons::make('bgColor')->label('Couleur de fond')->options([
                            'main-m' => 'Vert foncé',
                            'second-l' => 'Bleu/Vert',
                        ])->required()->inline(),
                        Repeater::make('items')
                            ->label('Etapes')
                            ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Etape')
                            ->schema([
                                TextInput::make('title')->label('Titre')->required()->placeholder('Ex: Accueil du matin'),
                                TextInput::make('label')->label('Label')->required()->placeholder('Ex: Accueil'),
                                self::getDefaultImageUploadField(label: 'Illustration'),
                                Textarea::make('text')->label('Texte')->required(),
                            ])
                            ->cloneable()
                            ->collapsed()
                            ->collapsible()
                            ->addActionLabel('Ajouter un étape')
                    ]),

                // AVANTAGES
                Builder\Block::make('cms.benefits')
                    ->label('Avantages')
                    ->schema([
                        Repeater::make('benefits')
                            ->label('')
                            ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Avantage')
                            ->schema([
                                TextInput::make('title')->label('Titre')->required(),
                                RichEditor::make('text')->label('Texte')->required(),
                            ])
                            ->cloneable()
                            ->collapsed()
                            ->collapsible()
                            ->addActionLabel('Ajouter un avantage')
                    ]),

                // Valeur
                Builder\Block::make('cms.value')
                    ->label('Valeur')
                    ->schema([
                        Toggle::make('reverse')->label('Inverser les deux blocs')->default(false),
                        Section::make('Texte')
                            ->schema([
                                TextInput::make('title')->label('Titre')->required(),
                                Textarea::make('text')->label('Texte')->required(),
                                ToggleButtons::make('bgTextColor')->label('Couleur de fond')->options([
                                    'white' => 'Blanc (par défaut)',
                                    'main-l' => 'Vert clair',
                                    'main-m' => 'Vert foncé',
                                    'second-l' => 'Bleu/Vert',
                                    'main-lr' => 'Jaune',
                                ])->required()->inline(),
                            ]),
                        Section::make('Témoignage')
                            ->schema([
                                self::getDefaultImageUploadField(label: 'Photo'),
                                TextInput::make('firstname')->label('Prénom')->required(),
                                TextInput::make('role')->label('Rôle')->required(),
                                RichEditor::make('testimony')->label('Texte')->required(),
                                ToggleButtons::make('bgTestimonyColor')->label('Couleur de fond')->options([
                                    'white' => 'Blanc (par défaut)',
                                    'main-l' => 'Vert clair',
                                    'main-m' => 'Vert foncé',
                                    'second-l' => 'Bleu/Vert',
                                    'main-lr' => 'Jaune/Vert',
                                ])->required()->inline(),
                            ])
                    ]),

                // FAQ
                Builder\Block::make('cms.faq')
                    ->label('FAQ')
                    ->schema([
                        TextInput::make('title')->label('Titre')->required(),
                        RichEditor::make('text')->label('Texte')->required(),
                        Repeater::make('questions')
                            ->label('')
                            ->itemLabel(fn(array $state): ?string => $state['title'] ?? 'Question')
                            ->schema([
                                TextInput::make('title')->label('Titre')->required(),
                                RichEditor::make('text')->label('Texte')->required(),
                            ])
                            ->cloneable()
                            ->collapsed()
                            ->collapsible()
                            ->addActionLabel('Ajouter une question')
                    ]),

                // LISTE DES ARTICLES
                Builder\Block::make('cms.articles-list')
                    ->label('Liste des articles')
                    ->schema([
                        Hidden::make('placeholder'), // Champ requis dans schema. Ne sera pas utilisé
                    ]),

                // FORMULAIRE DE CONTACT
                Builder\Block::make('formulaire')
                    ->label('Formulaire de contact')
                    ->schema([
                        ContactFormSelect::make('contenu')
                            ->label('')
                            ->required(),
                    ]),
            ]);
    }

    public static function getButtonSectionSchema(string $prefix = 'bouton_', bool $hasStyle = true): array
    {
        return [
            CMSPageFormSelect::make($prefix . 'page')->label('Page')->generateOptions(Page::class),
            Select::make($prefix . 'style')
                ->label('Style visuel')
                ->options([
                    '-main-l' => 'Vert clair',
                    '-line-main-d' => 'Ligne',
                ])->visible($hasStyle),
            TextInput::make($prefix . 'text')->label('Texte'),
        ];
    }

    public static function getDefaultImageUploadField(string $fieldName = 'image', string $label = 'Image'): FileUpload
    {
        return FileUpload::make($fieldName)
            ->label($label)
            ->image()
            ->maxSize(5120);
    }

    public static function getKeyNumbersField(string $label = 'Image'): Builder\Block
    {
        return Builder\Block::make('cms.key-numbers')
            ->label($label)
            ->schema([
                Repeater::make('numbers')
                    ->label('')
                    ->itemLabel(fn(array $state): ?string => 'Chiffre clé ' . ($state['number'] ?? ''))
                    ->schema([
                        FileUpload::make('picto')
                            ->label('Pictogramme')
                            ->acceptedFileTypes(['image/svg+xml'])
                            ->maxSize(1024),
                        TextInput::make('number')->label('Chiffre'),
                        TextInput::make('description')->label('Description'),
                    ])
                    ->cloneable()
                    ->collapsed()
                    ->collapsible()
                    ->addActionLabel('Ajouter un chiffre clé')
            ]);
    }
}
