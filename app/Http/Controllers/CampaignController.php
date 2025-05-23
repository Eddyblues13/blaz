<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Mail\sendUserEmail;
use Illuminate\Http\Request;
use App\Jobs\SendCampaignEmails;
use App\Imports\RecipientsImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CampaignController extends Controller
{
    public function index()
    {
        return view('dashboard.create-campaigns', [
            'campaigns' => auth()->user()->campaigns()->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('dashboard.create-campaign');
    }

    public function createBulk()
    {
        return view('dashboard.create-multi-campaign');
    }


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            Mail::to($validated['email'])->send(new sendUserEmail($validated['subject'], $validated['message']));

            return back()->with('success', 'Email sent successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send email: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function storeBulk(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'recipients' => 'required|file|mimes:csv,txt|max:5120', // 5MB max
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Process CSV file
            $file = $request->file('recipients');
            $csv = Reader::createFromPath($file->getPathname());
            $csv->setHeaderOffset(0); // Use the first row as header

            $emails = [];
            $invalidEmails = [];
            $totalProcessed = 0;
            $maxRecipients = 10000; // Safety limit

            foreach ($csv as $record) {
                if ($totalProcessed >= $maxRecipients) {
                    break;
                }

                // Check for email in various possible column names
                $email = $record['email'] ?? $record['Email'] ?? $record['EMAIL'] ?? null;

                if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emails[] = $email;
                    $totalProcessed++;
                } else {
                    $invalidEmails[] = $email;
                }
            }

            // Log invalid emails for review
            if (!empty($invalidEmails)) {
                Log::warning('Invalid emails in bulk send', [
                    'invalid_emails' => $invalidEmails,
                    'total_invalid' => count($invalidEmails)
                ]);
            }

            // Send emails in chunks to prevent timeouts
            $chunkSize = 100;
            $totalSent = 0;

            foreach (array_chunk($emails, $chunkSize) as $chunk) {
                Mail::to($chunk)
                    ->queue(new SendUserEmail(
                        $request->subject,
                        $request->message
                    ));
                $totalSent += count($chunk);
            }

            return back()->with([
                'success' => "Bulk mail queued for $totalSent recipients!",
                'stats' => [
                    'total' => $totalProcessed,
                    'valid' => $totalSent,
                    'invalid' => count($invalidEmails)
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Bulk mail send failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to process bulk mail: ' . $e->getMessage());
        }
    }
}
