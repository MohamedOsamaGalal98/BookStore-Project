<?php

namespace App\Filament\Resources\BookResource\Widgets;

use App\Http\Requests\DepartmentRequest;
use App\Models\AppliedDiscountsCarts;
use App\Models\Author;
use App\Models\Book;
use App\Models\department;
use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
 
    protected function getStats(): array
    {
        // $applieddiscountscarts = AppliedDiscountsCarts::get();
        // $books = [];
        // foreach($applieddiscountscarts as $cart) {
        //     foreach ($cart->books_data_with_specific_cart_discount as $book) {
        //         if (isset($books[$book['book_name']])) {
        //             $books[$book['book_name']]++;
        //         } else {
        //             $books[$book['book_name']] = 1;
        //         }

        //     }
        // }
        // $books = collect($books)->sortDesc()->take(10);
        
        $data = [
            Stat::make('Authors Count', Author::count()),
            Stat::make('Books Count', Book::count()),
            Stat::make('Departments Count', department::count()),
            Stat::make('Transactions Count', Transaction::count()),
            Stat::make('Users Count', User::count()),
           
        ];

        
        // foreach($books as $bookName => $count) {
        //     $data[] = Stat::make($bookName, $count);

        // }
        
        return $data;
    }
    
}
