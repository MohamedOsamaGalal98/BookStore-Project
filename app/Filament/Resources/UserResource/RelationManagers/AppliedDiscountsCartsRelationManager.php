<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\ViewEntry;


class AppliedDiscountsCartsRelationManager extends RelationManager implements HasInfolists
{
    protected static string $relationship = 'AppliedDiscountsCarts';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('PaymentId'),
            
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([
                 Tables\Actions\ViewAction::make(),
                //Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }



public function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Section::make()
            ->schema([
                TextEntry::make('general_cart_discount')->label('general_cart_discount_type')
                ->formatStateUsing(function ($record) {
                    return $record->general_cart_discount['general_discount_type'];
                }),

                TextEntry::make('general_cart_discount')->label('general_cart_discount_value')
                ->formatStateUsing(function ($record) {
                    return $record->general_cart_discount['general_discount_value'];
                }),


                ]),

                Section::make()
                ->schema([

                    ViewEntry::make('books_data_with_specific_cart_discount')
                    ->view('books-view')
              
                    ]),
                                
        ]);
}
}
