@extends('admin.layouts.master')
@section('title')
Certificate
@endsection
@section('content')
<div class="wrapper">
    <div class="sa4d25">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="st_title"><i class="uil uil-award"></i> My Certificates</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="mt-10">
                        <div class="card_dash1">
                            <div class="card_dash_left1">
                                <i class="uil uil-award"></i>
                                <h1>Jump Into New Certificate</h1>
                            </div>
                            <div class="card_dash_right1">
                                <button class="create_btn_dash"
                                    onclick="window.location.href = 'certification_center.html';">New
                                    Certificate</button>
                            </div>
                        </div>
                        <div class="table-cerificate">
                            <div class="table-responsive">
                                <table class="ucp-table" id="content-table">
                                    <thead class="thead-s">
                                        <tr>
                                            <th class="text-center" scope="col">Item No.</th>
                                            <th scope="col">Title</th>
                                            <th class="text-center" scope="col">Marks</th>
                                            <th class="text-center" scope="col">Out Of</th>
                                            <th class="text-center" scope="col">Upload Date</th>
                                            <th class="text-center" scope="col">Certificate</th>
                                            <th class="text-center" scope="col">Controls</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="cell-ta">WordPress Certificate</td>
                                            <td class="text-center">15</td>
                                            <td class="text-center">20</td>
                                            <td class="text-center">6 April 2019</td>
                                            <td class="text-center"><a
                                                    href="http://gambolthemes.net/html-imgs/certificate.jpg"
                                                    target="_blank">View</a></td>
                                            <td class="text-center">
                                                <a href="#" title="Delete" class="gray-s"><i
                                                        class="uil uil-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="cell-ta">WordPress Pro Certificate</td>
                                            <td class="text-center">14</td>
                                            <td class="text-center">20</td>
                                            <td class="text-center">4 April 2019</td>
                                            <td class="text-center"><a
                                                    href="http://gambolthemes.net/html-imgs/certificate.jpg"
                                                    target="_blank">View</a></td>
                                            <td class="text-center">
                                                <a href="#" title="Delete" class="gray-s"><i
                                                        class="uil uil-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="cell-ta">HTML CSS Certificate</td>
                                            <td class="text-center">18</td>
                                            <td class="text-center">20</td>
                                            <td class="text-center">3 April 2019</td>
                                            <td class="text-center"><a
                                                    href="http://gambolthemes.net/html-imgs/certificate.jpg"
                                                    target="_blank">View</a></td>
                                            <td class="text-center">
                                                <a href="#" title="Delete" class="gray-s"><i
                                                        class="uil uil-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.footer')

    </div>
    @endsection