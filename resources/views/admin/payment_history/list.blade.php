@extends('admin.layouts.master')

@section('title')
    Transaction History
@endsection

@section('content')
    <div class="wrapper">
        <div class="sa4d25">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="st_title"><i class="uil uil-transaction"></i> Transaction History</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card_dash1">
                        <div class="table-responsive mt-30">
                            <table id="transactionTable" class="ucp-table">
                                <thead>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>Course Name</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.layouts.footer')
    </div>

    <!-- DataTables Script -->
    <script>
        $(document).ready(function () {
            $('#transactionTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('transactions.index') }}",
                columns: [
                    { data: "transaction_id", name: "transaction_id" },
                    { data: "course_name", name: "course_name" }, // Added Course Name
                    { data: "status", name: "status" },
                    { data: "amount", name: "amount" },
                    { data: "created_at", name: "created_at" }
                ],language: {
                    emptyTable: "No transaction history found"
                },
                error: function(xhr) {
                    console.log("AJAX Error: ", xhr.responseText);
                }
            });
        });
    </script>
@endsection
