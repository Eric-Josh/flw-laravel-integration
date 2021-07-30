<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use GuzzleHttp\Client;
use App\Jobs\DeGuideJob;
// use Illuminate\Support\Facades\Log;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transactions.transaction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'firstname' => ['required', 'string', 'max:50'],
            'lastname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'phone' => ['required', 'numeric', 'digits:11'],
        ]);

        // create transaction ref
        $lastId = Transactions::select('id')->orderBy('id','desc')->first();
        if(is_null($lastId)){
            $lastId = 0;
        }else{
            $lastId=$lastId->count();
        }
        $tran_ref = 'DG'.rand().'-'.($lastId + 1);

        // call payment api gateway
        $client = new Client();
        $url = "https://api.flutterwave.com/v3/payments/";

        $params = [
            "tx_ref"    => $tran_ref, 
            "amount"    => 10,
            "currency"  => "NGN",
            "country"   => "NG",
            "redirect_url" => "http://localhost:8000/webhook",
            "payment_options" => " ",
            "customer"  => [
                "email" => $request->get('email'),
                "phone_number" => $request->get('phone'),
                "name" => $request->get('firstname')." ".$request->get('lastname'),
            ],
            "customizations" => [
                "title" => "DeGuide",
                "description" => "Canada Travel Guide Payment",
                "logo" => "https://checkout.flutterwave.com/assets/img/rave-logo.png",
            ],
        ];

        $headers = [
            "Authorization" => "Bearer SECRET-KEY"
        ];

        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        
        $responseBody = json_decode($response->getBody());
        
        if ($responseBody->status == "success"){
            $checkOut = $responseBody->data->link;

            return redirect()->away($checkOut);
            
        }else{

            return redirect()->route('billing')->withStatus('Oop! Something went wrong. Please try again.');
        }

    }

    public function webhook()
    {
        $transRef = request()->query('tx_ref');
        $flwTransId = request()->query('transaction_id');
        $status = request()->query('status');

        if($transRef && $flwTransId && $status )
        {
            if($status == 'successful'){

                 // call payment gateway verify api
                $client = new Client();
                $url = "https://api.flutterwave.com/v3/transactions/".$flwTransId."/verify";

                $params = [];
                $headers = [
                    "Authorization" => "Bearer SECRET-KEY"
                ];
                $response = $client->request('GET', $url, [
                    // 'json' => $params,
                    'headers' => $headers,
                    'verify'  => false,
                ]);
                $responseBody = json_decode($response->getBody());
                // dd($responseBody);
                if($responseBody->status == "success"){
                    $name = explode(" ", $responseBody->data->customer->name);

                    // save payment details to DB
                    $billing = new Transactions([
                        'firstname' => $name[0],
                        'lastname' => $name[1],
                        'email' => $responseBody->data->customer->email,
                        'phone' => $responseBody->data->customer->phone_number,
                        'amount' => $responseBody->data->amount,
                        'transaction_ref' => $responseBody->data->tx_ref,
                        'flw_transid' => $flwTransId,
                        'status' => $responseBody->status,
                        
                    ]);
                    $billing->save();
                    $delay = 5;
                    $userDetails = [
                        'firstname' => $name[0],
                        'email'     => $responseBody->data->customer->email,
                    ];
                    // send value through mail
                    dispatch(new DeGuideJob($userDetails))->delay($delay);
                }

                return redirect()->route('billing')->withStatus('Your order has placed successfully. Your product has been sent to your mail.');
            }else{
                return redirect()->route('billing')->withStatus('Oop! Something went wrong. Please try again.');
            }
        }else{
            return redirect()->route('billing')->withStatus('Oop! Something went wrong. Please try again.');
        }
    }

    
}
