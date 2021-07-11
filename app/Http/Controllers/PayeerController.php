<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Daaner\UnitPay\Facades\UnitPay;
use Illuminate\Support\Facades\Log;
use App\Subscription;
use App\Notifications\NewSubscriberNotification;
use App\Invoice;

class PayeerController extends Controller
{
    // only authenticated users
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Search the order if the request from unitpay is received.
     * Return the order with required details for the unitpay request verification.
     *
     * @param Request $request
     * @param $order_id
     * @return mixed
     */
    public static function searchOrderFilter(Request $request, $order_id) {

        if(strpos($order_id, 'tip') !== false) {

        }
        else {
            $subscription = Subscription::where('subscription_id', $order_id)->firstOrFail();
            if ($subscription) {

                $subscription['UNITPAY_orderSum'] = $subscription->subscription_price; // from your database
                $subscription['UNITPAY_orderCurrency'] = 'RUB';  // from your database

                // if the current_order is already paid in your database, return strict "paid";
                // if not, return something else
                if($subscription->status == 'Active')
                    $status = 'paid';
                else
                    $status = $subscription->status;
                $subscription['UNITPAY_orderStatus'] = $status;//$subscription->staus; // from your database

                return $subscription;
            }
        }

        return false;
    }

    /**
     * When the payment of the order is received from unitpay, you can process the paid order.
     * !Important: don't forget to set the order status as "paid" in your database.
     *
     * @param Request $request
     * @param $order
     * @return bool
     */
    public static function paidOrderFilter(Request $request, $order)
    {
        $subscriber = User::findOrFail( $order->subscriber_id);
        $subscription = Subscription::where('subscription_id', $order->subscription_id)->firstOrFail();

        // validate amount
        /*if ($r->mc_gross != $subscription->subscription_price) {
            \Log::error('On subscription #' . $subscription->id . ' received amount was ' . $r->mc_gross . ' while the cost of subscription is ' . $subscription->subscription_price);
            exit;
        }*/

        // update expires
        $subscription->subscription_expires = now()->addMonths(1);
        $subscription->status = 'Active';
        $subscription->save();

        // notify creator on site & email
        $creator = $subscription->creator;
        $creator->notify(new NewSubscriberNotification($subscriber));

        // update creator balance
        $creator->balance += $subscription->creator_amount;
        $creator->save();

        // create invoice to be able to have stats in admin
        $i = new Invoice;
        $i->invoice_id = $subscription->subscription_id;
        $i->user_id = $subscription->subscriber_id;
        $i->subscription_id = $subscription->id;
        $i->amount = $subscription->subscription_price;
        $i->payment_status = 'Paid';
        $i->invoice_url = '#';
        $i->save();

        //YourOrderController::saveOrderAsPaid($order);

        // Return TRUE if the order is saved as "paid" in the database or FALSE if some error occurs.
        // If you return FALSE, then you can repeat the failed paid requests on the unitpay website manually.
        return true;
    }

    /**
     * Process the request from the UnitPay route.
     * searchOrderFilter is called to search the order.
     * If the order is paid for the first time, paidOrderFilter is called to set the order status.
     * If searchOrderFilter returns the "paid" order status, then paidOrderFilter will not be called.
     *
     * @param Request $request
     * @return mixed
     */
    public function payOrderFromGate(Request $request)
    {
        /*$m_key = 'JDiSsQ7NjJdA79qol08Q';
        $m_shop = $request->get('m_shop');
        $m_orderid = $request->get('m_orderid');
        $m_amount = $request->get('m_amount');
        $m_curr = $request->get('m_curr');
        $m_desc = $request->get('m_desc');
        $checksum = $request->get('m_sign');
        $user = Payment::select('user_id')->where('uid', '=', $m_orderid)->first();

        if (isset($_POST['m_operation_id']) && isset($checksum)) {

            $arHash = array($m_shop, $m_orderid, $m_amount, $m_curr, $m_desc, $m_key);
            $sign_hash = strtoupper(hash('sha256', implode(':', $arHash)));

            if ($checksum == $sign_hash && $_POST['m_status'] == 'success') {
                if (Payment::where('uid', '=', $m_orderid) && Payment::where('balance', '=', $m_amount)) {
                    try {
                        DB::beginTransaction();
                        $payment = Payment::where('uid', '=', $m_orderid)->first();
                        if ($payment->status == 0) {
                            $payment->status = 1;
                            $payment->update();
                            $addBalanceToUser = User::find($user->user_id);
                            $addBalanceToUser->balance += $m_amount;
                            $addBalanceToUser->update();
                        }
                        DB::commit();
                    } catch (\PDOException $e) {

                        \Session::flash('message', "$e->getMessage()");
                        DB::connection()->getPdo()->rollBack();
                    }
                }
            }
        }

        return redirect()->action('ProfileController@index');*/
    }

    // unitpay route
    public function payeer(User $user)
    {
        if (auth()->id() == $user->id) {
            alert()->info(__('general.dontSubscribeToYourself'));
            return back();
        }
        //return view('subscribe.unitpay', compact('user'));
    }
}
