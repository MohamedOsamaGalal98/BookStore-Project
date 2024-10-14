<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Transaction;
use App\Models\AppliedDiscountsCarts;
use App\Models\User;

class PaymentController extends Controller
{

     public function checkout(Request $request)
     {

         $data = [
             "CustomerName" => Auth::user()->name,
             "Notificationoption"=> "LNK",  
             "Invoicevalue" => $request->total_price, // total_price
             "CustomerEmail" =>  Auth::user()->email,     
             "CalLBackUrl"=> env(key: 'callback_url'),
             "Errorurl"=> env(key: 'callback_url'),
             "Languagn"=> 'en',
             "DisplayCurrencyIna"=>'KWD'  
         ];

         $response = $this->sendPayment($data);

         $response = json_decode($response->getContents());

         if($request->ajax()) {
            return $response->Data->InvoiceURL; // return this link for api
         } else {
            return redirect($response->Data->InvoiceURL); // redirect for this link to view payment page
        }

      }

      
      public function paymentCallback(Request $request)
      {
              $postFields = [
              'Key'     => $request->paymentId,
              'KeyType' => 'paymentId'
              ];

              $paymentData =  $this->getPaymentStatus($postFields);
              $response = json_decode($paymentData);
             
            $user = User::where('email', $response->Data->CustomerEmail)->first();

              $this->addDataToTransaction($response, $user);
              $this->addDiscountCartData($response, $user);


             return redirect('books'); 

      }
  
  
     public function buildRequest($url,$mothod, $data =[]){
       
         if (!$data)
             return false;

            $client = new Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, )));
            $response = $client->request($mothod , env(key: "fatoora_base_url") . $url, [
                "headers" => [
                    "Content-Type" =>'application/json',
                    "Authorization" => env(key: "fatoora_token")
                ],
                 'json' => $data
            ], );
           
          if ($response->getStatusCode() != 200)
             return false;

        return $response->getBody();
     }
  

     public function sendPayment($data){

        $response  = $this->buildRequest('v2/SendPayment', 'POST', $data);
         return $response;
     }


     public function getPaymentStatus($data){
         $response  = $this->buildRequest('v2/getPaymentStatus','POST', $data);
         return $response;
     }
 

     public function addDataToTransaction($response, $user){

        
        Transaction::updateOrCreate([
            'InvoiceId' => $response->Data->InvoiceId,
          ], [
          
            'Customer_id' => $user->id,
            'CustomerName' => $response->Data->CustomerName,
            'CustomerEmail' => $response->Data->CustomerEmail,

            'InvoiceId' => $response->Data->InvoiceId,
            'InvoiceStatus' => $response->Data->InvoiceStatus,
            'InvoiceReference' => $response->Data->InvoiceReference,
            'InvoiceValue' => $response->Data->InvoiceValue,

            'TransactionDate' => $response->Data->InvoiceTransactions[0]->TransactionDate,
            'PaymentGateway' => $response->Data->InvoiceTransactions[0]->PaymentGateway,
            'ReferenceId' => $response->Data->InvoiceTransactions[0]->ReferenceId,
            'TrackId' => $response->Data->InvoiceTransactions[0]->TrackId,
            'TransactionId' => $response->Data->InvoiceTransactions[0]->TransactionId,
            'PaymentId' => $response->Data->InvoiceTransactions[0]->PaymentId,
            'AuthorizationId' => $response->Data->InvoiceTransactions[0]->AuthorizationId,
            'TransactionStatus' => $response->Data->InvoiceTransactions[0]->TransactionStatus,
            'TransationValue' => $response->Data->InvoiceTransactions[0]->TransationValue,
            'PaidCurrency' => $response->Data->InvoiceTransactions[0]->PaidCurrency,
            'IpAddress' => $response->Data->InvoiceTransactions[0]->IpAddress,
        ]);

     }

     public function addDiscountCartData($response, $user){
     
        if($response->Data->InvoiceStatus == 'Paid'){
            $user_id = $user->id;
            $user_cart = $user->cart();
            //dd($user_cart->pivot->discount_id);
            $dis_id = (Cart::where('user_id',  $user_id)->first()->discount_id);
          

            $cartitems = $user->cart->items;
            $books_data_with_specific_cart_discount = [];

            $cartitems->each(function($item) use(&$books_data_with_specific_cart_discount) {

                $book_id = $item->id;
                $book_title = $item->title;
                $book_price = $item->price;
                $discount = $item->discount->first();
                $total_quantity = $item->pivot->quantity;
               
                if((isset($discount) && $discount->discount_type == 'percentage')) {
                    $book_price_after_discount =  ($book_price  - ($book_price *  $discount->value/100)) ;
                }elseif(isset($discount) &&  $discount->discount_type == 'fixed') {
                    $book_price_after_discount =  ($book_price  - $discount->value) ;
                } else {
                    $book_price_after_discount =  $book_price;
                }

                $total_books_price = $total_quantity * $book_price_after_discount;

                $books_data_with_specific_cart_discount[] = [ 'book_id' => $book_id,
                                                            'book_name' => $book_title,
                                                            'book_price' => $book_price,                                               
                                                            'specific_discount_type' => $discount->discount_type ?? null,
                                                            'specific_discount_value' => $discount->value ?? null,
                                                            'book_quantity' => $total_quantity,
                                                            'book_price_after_discount' => $book_price_after_discount,
                                                            'total_books_price' => $total_books_price,
                                                           ];
                });

                $discount = Discount::where('id', $dis_id)->first();

                AppliedDiscountsCarts::create([
                'user_id' => $user->id,
                'user_name' => $response->Data->CustomerName,
                'user_email' => $response->Data->CustomerEmail,
                'PaymentId' => $response->Data->InvoiceTransactions[0]->PaymentId,

                'general_cart_discount' => ['general_discount_type' =>$discount->discount_type,
                                           'general_discount_value' =>$discount->value,
                                            ],

                'books_data_with_specific_cart_discount' => [
                                                            $books_data_with_specific_cart_discount,
                                                            ],
            ]);
    
             $user->cart()->delete();
        }

    }

}


    

