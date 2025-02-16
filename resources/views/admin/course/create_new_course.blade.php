@extends('admin.layouts.master')
@section('title') Course  @endsection
@section('content')
<div class="wrapper">
    <div class="sa4d25">
        <div class="container">			
            <div class="row">
                <div class="col-lg-12">	
                    <h2 class="st_title"><i class="uil uil-analysis"></i> Create New Course</h2>
                </div>					
            </div>				
            <div class="row">
                <div class="col-12">
                    <div class="course_tabs_1">
                        <div id="add-course-tab" class="step-app">
                            <ul class="step-steps">
                                <li class="active">
                                    <a href="#tab_step1">
                                        <span class="number"></span>
                                        <span class="step-name">Basic</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_step2">
                                        <span class="number"></span>
                                        <span class="step-name">Curriculum</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_step3">
                                        <span class="number"></span>
                                        <span class="step-name">Media</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_step4">
                                        <span class="number"></span>
                                        <span class="step-name">Price</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab_step5">
                                        <span class="number"></span>
                                        <span class="step-name">Publish</span>
                                    </a>
                                </li>
                            </ul>
                            {{-- @yield('basic_information') --}}
                            <div class="step-content">
                                {{-- @include('admin.course.basic_information') --}}
                                @yield('step1')
                                {{-- @include('admin.course.test') --}}
                                {{-- @include('admin.course.media')
                                @include('admin.course.price')     --}}
                            </div>
                            {{-- <div class="step-footer step-tab-pager">
                                <button data-direction="prev" class="btn btn-default steps_btn">PREVIOUS</button>
                                <button data-direction="next" class="btn btn-default steps_btn">Next</button>
                                <button data-direction="finish" class="btn btn-default steps_btn">Submit for Review</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
		ClassicEditor.create( document.querySelector( '#editor1' ) )
		.then( editor => {
			window.editor1 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

		ClassicEditor.create( document.querySelector( '#editor2' ) )
		.then( editor => {
			window.editor2 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
		
		ClassicEditor.create( document.querySelector( '#editor3' ) )
		.then( editor => {
			window.editor3 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
		
		ClassicEditor.create( document.querySelector( '#editor4' ) )
		.then( editor => {
			window.editor4 = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
	</script> 
	<script>
		$('#add-course-tab').steps({
		  onFinish: function () {
			alert('Wizard Completed');
		  }
		});		
	</script>
	<script>
		$( function() {
			$( ".sortable" ).sortable();
			$( ".sortable" ).disableSelection();
		});
	</script>
@endsection