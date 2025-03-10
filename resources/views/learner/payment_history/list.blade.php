@extends('learner.layout.master')

@section('title')
    Transaction History
@endsection

@section('content_learner')
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
                                        <th>Invoice</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('learner.layout.footer')
    </div>

 
    <script>
        $(document).ready(function () {
            $('#transactionTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('payment.history') }}",
                columns: [
                    { data: "transaction_id", name: "transaction_id" },
                    { data: "course_name", name: "course_name" }, // Course Name Column
                    { data: "status", name: "status" },
                    { data: "amount", name: "amount" },
                    { data: "created_at", name: "created_at" },
                    {
                        data: "id",
                        name: "invoice",
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            return `
                                <a href="/invoice/view/${data}" class="text-primary" title="View Invoice">
                                    <i class="uil uil-eye"></i>
                                </a>
                                <a href="/invoice/download/${data}" class="text-success ms-2" title="Download Invoice">
                                    <i class="uil uil-download-alt"></i>
                                </a>
                            `;
                        }
                    }
                ],
                language: {
                    emptyTable: "No transaction history found"
                },
                error: function(xhr) {
                    console.log("AJAX Error: ", xhr.responseText);
                }
            });
        });
    </script>
@endsection
