<?php

namespace App\Http\Controllers\Admin;

use App\Models\Loan;
use App\Models\User;
use App\Models\Trade;
use App\Models\Profit;
use App\Models\Deposit;
use App\Mail\DebitEmail;
use App\Models\Activity;
use App\Models\Document;
use App\Models\Earnings;
use App\Models\Referral;
use App\Mail\CreditEmail;
use App\Models\Withdrawal;
use App\Mail\sendUserEmail;
use App\Mail\TransferEmail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\ChequeDeposit;
use App\Models\AccountBalance;
use App\Models\InvestmentPlan;
use App\Models\SavingsBalance;
use Illuminate\Support\Carbon;
use App\Models\CheckingBalance;
use App\Models\TransferHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionNotificationMail;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;
use Illuminate\Validation\ValidationException;


class AdminController extends Controller
{
    /**
     * Display the admin dashboard with a list of all users.
     *
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $data['users'] = User::get();
        return view('admin.home', $data);
    }


    /**
     * Open a new account.
     *
     * @return \Illuminate\View\View
     */
    public function sendEmailPage()
    {
        // Display form for opening a new account
        return view('admin.send_mail_form');
    }

    public function sendEmail(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $email = $request->input('email');
        $subject = $request->input('subject');
        $messageBody = $request->input('message');

        try {
            Mail::send([], [], function ($message) use ($email, $subject, $messageBody) {
                $message->to($email)
                    ->subject($subject)
                    ->setBody($messageBody, 'text/html');
            });

            return response()->json(['success' => 'Email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email. Please try again.']);
        }
    }











    public function sendUserEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $email = $request->email;
        $subject = $request->subject;
        $messageBody = $request->message;

        Mail::to($email)->send(new sendUserEmail($subject, $messageBody));

        return back()->with('message', 'Email sent successfully!');
    }

    public function sendEmailToAllUsers(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $users = User::pluck('email'); // Get all user emails

        foreach ($users as $email) {
            Mail::to($email)->send(new SendUserEmail($request->subject, $request->message));
        }

        return back()->with('success', 'Emails have been sent successfully.');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login'); // or wherever you want to redirect after logout
    }
}
