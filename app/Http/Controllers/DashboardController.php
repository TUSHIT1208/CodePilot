<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }

    public function learner(Request $request)
    {
        if ($request->ajax()) {
            $learners = User::select([
                'id',
                'profile_picture_url',
                'first_name',
                'middle_name',
                'last_name',
                'email',
                'phone_number',
                'is_active'
            ])->where('role_id', 3);

            return DataTables::of($learners)
                ->addColumn('profile', function ($row) {
                    return '<img src="' . asset($row->profile_picture_url) . '" width="50" height="50" class="rounded-circle">';
                })
                ->addColumn('full_name', function ($row) {
                    return $row->first_name . ' ' . ($row->middle_name ? $row->middle_name . ' ' : '') . $row->last_name;
                })
                ->addColumn('status', function ($row) {
                    return $row->is_active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->rawColumns(['profile', 'status'])
                ->make(true);
        }

        $learners = User::where('role_id', 3)->get();
        return view('admin.report.total_learner.list', compact('learners'));
    }
}