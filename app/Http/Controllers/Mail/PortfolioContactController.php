<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\PortfolioContact;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class PortfolioContactController extends Controller
{

    public function index()
    {
        return view('mail.index', ['mails' => Contact::orderByDesc('id')->paginate(8)]);
    }

    public function Store(Request $request)
    {
        // dd($request);
        $data = $request->all();
        // dd($data);

        $validator = Validator::make($data, [
            'name' => 'required|max:50',
            'email' => 'required|max:50',
            'message' => 'required',
        ]);
        // dd($validator);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        } else {
            $newContact = Contact::create($data);

            Mail::to($request->email)->send(new PortfolioContact($newContact));

            return response()->json([
                'success' => true,
                'message' => 'message successfully sent'
            ]);
        };
    }

    public function show(Contact $mail)
    {
        return view('mail.show', compact('mail'));
    }

    public function destroy(Contact $mail)
    {
        $mail->delete();

        return to_route('admin.mails.index')->with('status', "Mail from $mail->name deleted");
    }
}
