<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal')->required()->default(today()),
                TextInput::make('customer')
                    ->label('Nama Customer')
                    ->default('cash')
                    ->autofocus()
                    ->required(),
                Placeholder::make('banyak_items')->content(fn (Get $get) => number_format(count($get('items')), 0)),
                Repeater::make('items')
                    ->relationship()
                    ->schema([
                        TextInput::make('nama_item')
                            ->label('Nama Item')
                            ->required()->autofocus()->live(onBlur: true),
                        TextInput::make('harga')
                            ->label('harga')
                            ->numeric()
                            ->minValue(0)
                            ->required()->live(onBlur: true),
                        TextInput::make('banyak')
                            ->label('Banyak')
                            ->numeric()
                            ->minValue(0)
                            ->required()->live(onBlur: true),
                        Placeholder::make('jumlah')
                            ->content(fn (Get $get) => number_format(($get('banyak') ?? 0) * ($get('harga') ?? 0), 0)),
                    ])->required()->itemLabel(fn (array $state) => $state['nama_item'] ?? 'New Item'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
