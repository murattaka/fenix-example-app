<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->placeholder('Enter the product name')
                    ->columnSpanFull(),
                RichEditor::make('description')
                    ->label('Description')
                    ->required()
                    ->placeholder('Enter the product description')
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->numeric()
                    ->inputMode('decimal')
                    ->label('Price')
                    ->required()
                    ->placeholder('Enter the product price')
                    ->columnSpanFull(),
                TextInput::make('daily_credit_limit')
                    ->integer()
                    ->label('Daily Credit Limit')
                    ->required()
                    ->placeholder('Enter the daily credit limit')
                    ->columnSpanFull(),
                TextInput::make('subscription_days')
                    ->integer()
                    ->label('Subscription Days')
                    ->required()
                    ->placeholder('Enter the subscription days')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label('Name'),
                TextColumn::make('price')
                    ->searchable()
                    ->label('Price'),
                TextColumn::make('daily_credit_limit')
                    ->searchable()
                    ->label('Daily Credit Limit'),
                TextColumn::make('subscription_days')
                    ->searchable()
                    ->label('Subscription Days'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
