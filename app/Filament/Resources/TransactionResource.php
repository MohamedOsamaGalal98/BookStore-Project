<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;


class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                TextInput::make('InvoiceValue')->label('Invoice Value'),
                TextInput::make('TransactionStatus')->label('Transaction Status'),
                
            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')->label('User_Id'),
                TextColumn::make('user_name')->label('User Name'),
                TextColumn::make('user_email')->label('User Email'),
                
                TextColumn::make('InvoiceId')->label('Invoice Id'),
                TextColumn::make('InvoiceStatus')->label('Invoice Status'),
                TextColumn::make('InvoiceReference')->label('Invoice Reference'),
                TextColumn::make('InvoiceValue')->label('Invoice Value'),
                
                TextColumn::make('TransactionDate')->label('Transaction Date'),
                TextColumn::make('PaymentGateway')->label('Payment Gateway'),
                TextColumn::make('ReferenceId')->label('Reference Id'),
                TextColumn::make('TrackId')->label('Track Id'),
                TextColumn::make('TransactionId')->label('Transaction Id'),
                TextColumn::make('PaymentId')->label('Payment Id'),
                TextColumn::make('AuthorizationId')->label('Authorization Id'),
                TextColumn::make('TransactionStatus')->label('Transaction Status'),
                TextColumn::make('TransationValue')->label('Transation Value'),
                TextColumn::make('PaidCurrency')->label('Paid Currency'),
                TextColumn::make('IpAddress')->label('Ip Address'),
            
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

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
            'index' => Pages\ListTransactions::route('/'),
            //'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
