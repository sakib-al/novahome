<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MembershipMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user->status == 'before_submit') {
            return redirect()->route('user.form')->with('error-alert2', 'Please submit membership form!');
        }
        elseif(Auth::user()->status == 'canceled'){
            return redirect()->route('memberDashboard')->with('error-alert2', 'Your membership account is canceled!');
        }
         elseif($user->payment_status == 'unpaid' && $user->amount != null && $user->amount > 0){
             return redirect()->route('member.payment')->with('error-alert2', 'Please pay your membership payment!');
         }
        return $next($request);
    }
}
