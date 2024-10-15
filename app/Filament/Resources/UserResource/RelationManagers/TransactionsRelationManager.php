<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\ViewEntry;


class TransactionsRelationManager extends RelationManager
{
    protected static string $relationship = 'Transactions';

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
             
                Tables\Columns\TextColumn::make('InvoiceId'),
                Tables\Columns\TextColumn::make('InvoiceStatus'),
                Tables\Columns\TextColumn::make('InvoiceReference'),
                Tables\Columns\TextColumn::make('InvoiceValue'),
                
                Tables\Columns\TextColumn::make('TransactionDate'),
                Tables\Columns\TextColumn::make('PaymentGateway'),
                Tables\Columns\TextColumn::make('ReferenceId'),
                Tables\Columns\TextColumn::make('TrackId'),
                Tables\Columns\TextColumn::make('TransactionId'),
                Tables\Columns\TextColumn::make('AuthorizationId'),
                Tables\Columns\TextColumn::make('TransactionStatus'),
                Tables\Columns\TextColumn::make('TransationValue'),
                Tables\Columns\TextColumn::make('PaidCurrency'),
                Tables\Columns\TextColumn::make('IpAddress'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

}
