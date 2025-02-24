<?php

namespace App\Filament\Resources;

use App\Enums\PostsStatus;
use App\Filament\CMSFields\PageBuilder;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\CMSFields\MediaLibraryFileField;
use App\Models\Post;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use RalphJSmit\Filament\SEO\SEO;

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $navigationGroup = 'Articles';

    protected static ?string $model = Post::class;

    protected static ?string $modelLabel = 'Article';

    protected static ?int $navigationSort = 1;

    /**
     * Retourne les champs à afficher dans la table de liste de la resource
     */
    protected static function getTableCustomFields(): array
    {
        return [];
    }

    /**
     * Retourne les champs pour le contenu de type CMS
     */
    protected static function getCmsFormSchema(
        array $customFields = [],
        bool $hasExerpt = true,
        bool $hasBuilder = true,
        bool $hasIllustration = true,
        bool $hasTags = true,
        bool $hasCategories = true,
        bool $hasPrivateOption = true,
    ): array {

        $mainFields = [
            TextInput::make('titre')
                ->required()
                ->columnSpan(2),
            TextInput::make('slug')
                ->columnSpan(2)
                ->helperText('Texte apparaissant dans l\'url. Généré automatiquement si laissé vide.'),
        ];

        if ($hasIllustration) {
            $mainFields[] = MediaLibraryFileField::make('illustration')
                ->imagesOnly(true)
                ->label('Illustration');
        }

        $sidebarFields = [
            Select::make('statut')
                ->options(getAllEnumValues(PostsStatus::cases()))
                ->required(),
        ];

        if ($hasCategories) {
            $sidebarFields[] = SelectTree::make('categories')
                ->label('Parents')
                ->placeholder(__('Choisir'))
                ->emptyLabel(__('Aucun résultat'))
                ->relationship('categories', 'nom', 'parent_id')
                ->enableBranchNode()
                ->defaultOpenLevel(2)
                ->columnSpan(2);
        }

        if ($hasTags) {
            $sidebarFields[] = Select::make('tags')
                ->relationship(
                    titleAttribute: 'nom',
                )
                ->multiple()
                ->columnSpan(2);
        }


        if ($hasExerpt) {
            $sidebarFields[] = Textarea::make('excerpt')
                ->label('Extrait')
                ->columnSpan(2);
        }


        if ($hasPrivateOption) {
            $sidebarFields[] = Toggle::make('private')
                ->label('Page privée')
                ->default(false)
                ->helperText('Si la page est privée, elle ne sera visible que par les utilisateurs connectés.')
                ->columnSpan(2);
        }

        return array_merge(
            [
                // Deux colonnes responsives
                Split::make([

                    // Titre + slug
                    Section::make($mainFields),

                    // Colonne de droite
                    Section::make($sidebarFields),

                ])->from('md')->columnSpan(2),

                // Contenu avec blocs

                (
                    $hasBuilder ?
                    Section::make('Contenu de la page')
                    ->schema([
                        PageBuilder::make('contenu')
                            ->columnSpan(2)
                            ->collapsed()
                            ->collapsible()
                            ->cloneable(),
                    ]) :
                    Hidden::make('ignoredBuilder')
                ),

                // Contenu avec blocs additionnels
                (
                    !empty($customFields) ?
                    Section::make('Contenu additionnel')
                    ->schema([
                        Repeater::make('custom') // Utilisation d'un repeater pour stocker la totalité des données dans une seule colonne de base
                            ->label('')
                            ->schema($customFields)
                            ->defaultItems(1)
                            ->deletable(false)
                            ->reorderable(false)
                            ->addable(false)
                            ->columnSpan(2),
                    ])
                    : Hidden::make('ignoredField') // Hack car il faut absolument un champ retourné. Ne sera pas pris en compte à l'enregistrement car pas fillable
                ),

                // Meta
                Section::make('Méta données')
                    ->schema([
                        SEO::make(),
                    ]),

            ]
        );
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema(self::getCmsFormSchema());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns(array_merge(
                [
                    TextColumn::make('titre')->searchable(),
                ],
                static::getTableCustomFields(),
                [
                    TextColumn::make('created_at')
                        ->label('Date')
                        ->dateTime('d F Y à H:i'),
                    IconColumn::make('statut')
                        ->label('Publication')
                        ->icon(fn(string $state): string => match ($state) {
                            'draft' => 'heroicon-o-clock',
                            'published' => 'heroicon-o-check-circle',
                        })->color(fn(string $state): string => match ($state) {
                            'draft' => 'warning',
                            'published' => 'primary',
                        }),
                ]
            ))
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                Action::make('voir')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Post $record) => $record->getUrl(true)),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\PostListPage::route('/'),
            'create' => Pages\PostCreatePage::route('/create'),
            'edit' => Pages\PostEditPage::route('/{record}/edit'),
        ];
    }
}
