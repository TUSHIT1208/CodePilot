@extends('admin.layouts.master')
@section('title')
    learner
@endsection
@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <h2 class="st_title">Total Learners</h2>
                <div class="tab-pane fade show active" id="pills-my-courses" role="tabpanel">
                    <div class="table-responsive mt-30">
                        @if ($learners->isEmpty())
                            <!-- No Records Found -->
                            <div class="no-categories-container text-center fade-in-animation footer">
                                <i class="uil uil-folder-minus bounce-effect"
                                    style="font-size: 50px; color: #d1d1d1;"></i>
                                <h3 class="mt-3 scale-in-text" style="color: #777;">No Learner Found</h3>
                                <p class="mb-4 fade-in-text" style="color: #aaa;">It looks like you don't have
                                    any
                                    learners yet. Add one now to get started!</p>

                            </div>
                        @else
                            <!-- Display Table When Data Exists -->
                            <table class="ucp-table" id="myTable">
                                <thead class="ucp-table">
                                    <tr>
                                        <th class="text-left ucp-tabler">
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th class="text-left ucp-table">Profile</th>
                                        <th class="text-left ucp-table" scope="col">Full name</th>
                                        <th class="text-left ucp-table" scope="col">Email</th>
                                        <th class="text-left ucp-table" scope="col">Phone</th>
                                        <th class="text-left ucp-table" scope="col">Status</th>
                                        <th class="text-left ucp-table" scope="col">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')
    </div>
@endsection
