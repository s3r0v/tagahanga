<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscription;
use App\Http\Requests;
use App\User;
use App\Notifications\NewSubscriberNotification;
use App\Invoice;

class YandexController extends Controller
{

	function subscribe(User $user) {
		if (auth()->id() == $user->id) {
			alert()->info(__('general.dontSubscribeToYourself'));
			return back();
		}
		
		// compute price
		$price = number_format($user->profile->finalPrice, 2);
		
		// get platform fee
		$platform_fee = opt('payment-settings.site_fee');
		$fee_amount = ($price * $platform_fee) / 100;
		
		// compute creator amount
		$creator_amount = number_format($price - $fee_amount, 2);
		
		// compute subscription id
        $subscrId = uniqid();

        // save this order in database
        $subPlan = new Subscription;
        $subPlan->creator_id = $user->id;
        $subPlan->subscriber_id = auth()->user()->id;
        $subPlan->subscription_id = $subscrId;
        $subPlan->gateway = 'Yandex';
        $subPlan->subscription_date = now();
        $subPlan->subscription_expires = now();
        $subPlan->subscription_price = $price;
        $subPlan->creator_amount = $creator_amount;
        $subPlan->admin_amount = $fee_amount;
        $subPlan->status = 'Canceled';
        $subPlan->save();

        // put into session
        session(['uniqueId' => $subscrId]);
		
		return view('subscribe.yandex', compact('user', 'subPlan'));
	}
	
	function status( Request $request ) {
		file_put_contents(__DIR__ . '/x.log', print_r($request->all(), 1) . PHP_EOL, FILE_APPEND);
		$secret = 'ZZxfrQ6vJMoQm8FEQ+Lbwe9H';
		if( !$request->has('sha1_hash') || !$request->has('label') ) {
			return 'Error';
		}
		
		if( $request->codepro == 'true' ) {
			return 'STATUS_CODEPRO';
		}
		
		$sha_check = sha1(implode('&', [
			$request->notification_type,
			$request->operation_id,
			$request->amount,
			$request->currency,
			$request->datetime,
			$request->sender,
			$request->codepro,
			$secret,
			$request->label
		]));
		
		if( $request->sha1_hash !== $sha_check ) {
			return 'BAD_SHA1';
		}
		
		$subscription = Subscription::where('subscription_id', $request->label)->firstOrFail();
		
		if( $subscription->status != 'Active' ) {
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
		}
	}
}
