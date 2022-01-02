@extends('layouts.master')
{{-- load page specific Css Files --}}
@section("CSS_LOAD")

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center film-section">
            <div class="col-md-4 p-5">
                <div class="card pt-4">
                   
                        
                <div class=" custom_pagination text-center d-none">
                      <button id="prev-record" type="button" class="btn btn-success d-none request-btn">Previous
                      </button>
                      <button id="next-record" type="button" class="btn btn-success d-none request-btn">Next</button>
                      <button id="last-record" type="button" class="btn btn-success d-none request-btn">Last</button>
                  </div>
                  
                    <div class="card-body">
                        <div class="row  text-center">
                            <div class="col-12 text-center">
                                <a class="action-url" href="javascript:void(0)">
                                    <img class="cover-image" style="border-radius:20px" src="" width="100%">
                                </a>
                                <h2 class="film-title text-center mt-3"></h2>
                            <hr>
                            <a class="action-url btn btn-danger mx-auto btn-sm mt-3" href="javascript:void(0)">
                                View Detail
</a>
                            </div>
                           
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- load page specific Js Files --}}
@section("JS_LOAD")
    <script src='{!! asset("assets/js/films/list_film.js") !!}'></script>
@endsection