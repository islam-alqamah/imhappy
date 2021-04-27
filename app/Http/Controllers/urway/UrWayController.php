<?php

namespace App\Http\Controllers\urway;

use App\Http\Controllers\Controller;
use App\Models\subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Payment;
use Auth;

class UrWayController extends Controller
{
    public $terminal_id ,$password,$secret_key,$currency_code,$response_url;

    public function __construct()
    {
        $this->terminal_id =env('URWAY_TERMINAL');
        $this->password = env('URWAY_PASSWORD');
        $this->secret_key = env('URWAY_SECRET_KEY');
        $this->currency_code = 'SAR';
    }

    public function hash_generate(Request $request){
        if($this->terminal_id==''||$this->password==''||$this->secret_key==''){
            return 'Please Check Environment Vars';
        }
        $amount = $request->amount;
        $currency = $this->currency_code;
        $order_id = $request->order_id;
        $txn_details= "$order_id|$this->terminal_id|$this->password|$this->secret_key|$amount|$currency";
        $hash=hash('sha256', $txn_details);
        return $hash;
    }

    public function payment_response(Request $request){

        $payment = Payment::where('trackid',$request->TrackId)->first();
        $payment->tranid = $request->TranId;
        $payment->save();
        if($payment)
        {
            $requestHash
                ="".$request->TranId."|".$this->secret_key."|".$request->ResponseCode."|".$request->amount."";
            $hash=hash('sha256', $requestHash);
            $txn_details1=
                "".$request->TrackId."|".$this->terminal_id."|".$this->password."|".$this->secret_key."|".$request->amount."|".$this->currency_code."";
            $requestHash1 = hash('sha256', $txn_details1);
            $apifields = array(
                'trackid' => $request->TrackId,
                'terminalId' => $this->terminal_id,
                'action' => '10',
                'merchantIp' =>$request->ip(),
                'password'=> $this->password,
                'currency' => $this->currency_code,
                'transid'=>$request->TranId,
                'amount' => $request->amount,
                'requestHash' => $requestHash1
            );
            $apifields_string = json_encode($apifields);
            $ch = curl_init('https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $apifields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($apifields_string))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $apiresult = curl_exec($ch);

            $urldecodeapi=(json_decode($apiresult,true));
            $inquiryResponsecode=$urldecodeapi['responseCode'];
            $inquirystatus=$urldecodeapi['result'];

                    if($inquirystatus=='Successful' || $inquiryResponsecode=='000'){
                        $payment->status = 'success';
                        $payment->save();
                        $subscribe = currentTeam()->subscribe;
                        if(!isset(currentTeam()->subscribe)){
                            $subscribe = new subscribe();
                            $subscribe->user_id = Auth::user()->id;
                            $subscribe->team_id = currentTeam()->id;
                            $subscribe->plan_id = $payment->plan_id;
                            $subscribe->payment_id = $payment->id;
                            $subscribe->starts_at = Carbon::now()->format('Y-m-d');
                            $subscribe->ends_at = Carbon::now()->addMonth()->format('Y-m-d');
                            $subscribe->save();
                        }

                        return view('account.payment-success',compact('subscribe'));
                    }else {
                        $payment->status = 'declined';
                        $payment->save();
                        return 'declined';
                    }
                }
                else
                {
                    return 'Payment Error';
                }



    }
    public function payment_request(Request $request)
    {
        $amount = $request->amount;
        $currency = $this->currency_code;
        $order_id = rand(55544,9999999);
        $fields = array(
            'trackid' => $order_id,
            'terminalId' => $this->terminal_id,
            'customerEmail' => Auth::user()->email,
            'action' => "1", // action is always 1
            'merchantIp' => $request->ip(),
            'password' => $this->password,
            'currency' => $currency,
            'country' => "SA",
            'udf2'=> url('account/payment/response'),
            'amount' => $amount,
            'requestHash' => $this->hash_generate($request) //generated Hash
        );
        $data = json_encode($fields);
        $ch = curl_init('https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close
        $urldecode = (json_decode($result, true));
        if ($urldecode['payid'] != NULL) {
            $url = $urldecode['targetUrl'] . "?paymentid=" . $urldecode['payid'];
        $payment = new Payment();
        $payment->team_id = currentTeam()->id;
        $payment->user_id = Auth::user()->id;
        $payment->plan_id = 1;
        $payment->payid = $urldecode['payid'];
        $payment->trackid = $order_id;
        $payment->tranid = 0;
        $payment->amount = $amount;
        $payment->user_ip = $request->ip();
        $payment->response_url = $url;
        $payment->gateway = 'urway';
        $payment->status = 'request';
        $payment->save();
            echo '
<html>
<form name="myform" method="POST" action="' . $url . '">
<h1> Transaction is processing........</h1>
</form>
<script type="text/javascript">document.myform.submit();
</script>
</html>';
        } else {
            echo "<b>Something went wrong!!!!</b>";
        }
    }
}
