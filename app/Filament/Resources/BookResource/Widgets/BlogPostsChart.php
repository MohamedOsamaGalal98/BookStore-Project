<?php

namespace App\Filament\Resources\BookResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\AppliedDiscountsCarts;

class BlogPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Best Selling Books';

    protected function getData(): array
    {

        $applieddiscountscarts = AppliedDiscountsCarts::get();
        $books = [];
        foreach($applieddiscountscarts as $cart) {
            foreach ($cart->books_data_with_specific_cart_discount as $book) {
                if (isset($books[$book['book_name']])) {
                    $books[$book['book_name']]++;
                } else {
                    $books[$book['book_name']] = 1;
                }

            }
        }
        $books = collect($books)->sortDesc()->take(10);
        foreach($books as $bookName => $count) {
            $books_names[] = $bookName;
            $books_count[] = $count;

        }

        return [
            'datasets' => [
                [
                    'label' => 'Best Selling Books',
                    'data' => $books_count,
                ],
            ],
            'labels' => $books_names,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
