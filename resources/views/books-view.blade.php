<!DOCTYPE html>
<body>
    <table>
    <tr>
        <th>Book ID</th>
        <th>Book Name</th>
        <th>Book Price</th>
        <th>Discount Type</th>
        <th>Discount Value</th>
        <th>Price After Discount</th>
    </tr>
    @foreach($getRecord()->books_data_with_specific_cart_discount as $book)
    
    <tr>
    <td>{{$book['book_id']}}</td>
    <td>{{$book['book_name'] }}</td>
    <td>{{$book['book_price'] }}</td>
    <td>{{$book['specific_discount_type'] }}</td>
    <td>{{$book['specific_discount_value'] }}</td>
    <td>{{$book['book_price_after_discount'] }}</td>
    </tr>
   
    @endforeach
    </table>
</body>
</html>
