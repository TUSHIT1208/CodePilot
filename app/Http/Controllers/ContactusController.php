<?php

namespace App\Http\Controllers;

use App\Models\contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ContactusController extends Controller
{
    public function index(Request $request)
    {
        // Check if the request is AJAX
        if ($request->ajax()) {
            $contactus = Contactus::all();  // Fetch all Contact Us records

            // Return DataTables response
            return DataTables::of($contactus)
                ->addColumn('checkbox', function ($contactus) {
                    return '<input type="checkbox" class="contactus-checkbox" value="' . $contactus->id . '">';
                })
                ->addColumn('action', function ($contactus) {
                    return '<a class="gray-s deletecontact" data-id="' . $contactus->id . '" data-type="' . $contactus->type . '">
                            <i class="uil uil-trash"></i>
                        </a>';
                })
                ->rawColumns(['checkbox', 'action'])  // Allow raw HTML in the actions and checkbox columns
                ->make(true);  // Return the DataTables response
        }

        return view('admin.contectus.list');  // Render the view for DataTable
    }

    public function create()
    {
        return view("frontside.contectus");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        try {
            // Store the contact data in the database
            Contactus::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
            
            return response()->json(['success' => 'Contact details send successfully.']);
        } catch (\Exception $e) {
            Log::error('Error creating contactus: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong! Please try again.'
            ]);
        }
    }

    public function show(contactus $contactus, $id)
    {
        try {
            $contactusData = contactus::all()->where('id', $id)->first();
            // return $contactusData;
            if (!$contactusData) {
                return redirect()->route('contactus.index')->with('error', 'Contactus not found');
            }
            // return $taskData;

            return view('app.admin.contact-us.view', compact('contactusData'));

        } catch (\Exception $e) {
            //Logger('Error fetching task: ' . $e->getMessage());

            return redirect()->route('contactus.index')->with('error', 'An error occurred while fetching the Data');
        }

    }

    public function edit(contactus $contactus)
    {
        //
    }

    public function update(Request $request, contactus $contactus)
    {
        //
    }

    public function destroy($id)
    {
        $contact = Contactus::findOrFail($id);

        // Delete the contact record
        $contact->delete();

        return response()->json(['success' => 'Contact deleted successfully.']);
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->input('ids');

        // Delete multiple records by their IDs
        Contactus::whereIn('id', $ids)->delete();

        return response()->json(['success' => 'Selected contacts deleted successfully.']);
    }

}