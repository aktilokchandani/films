@extends('layouts.master')
{{-- load page specific Css Files --}}
@section("CSS_LOAD")

@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 p-5">
                <div class="card" style="background: #000;color: #fff;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 text-center">
                                <a class="action-url" href="javascript:void(0)">
                                    <img style="border-radius:20px" class="cover-image" width="100%"
                                         src="{!! !empty($data->cover_image) ? $data->cover_image : "" !!}">
                                </a>
                            </div>
                            <div class="col-8">
                                <div class="card-title">
                                    <table>
                                        <tr>
                                            <td>
                                                <h5 >
                                                    Title :
                                                </h5>
                                            </td>
                                            <td>
                                                <p >
                                                    <input type="hidden" name="slug"
                                                           value="{!! !empty($data->slug) ? $data->slug : "" !!}"
                                                           id="slug">
                                                    {!! !empty($data->name) ? $data->name : "" !!}
</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 >
                                                    Ticket Price :
                                                </h5>
                                            </td>
                                            <td>
                                                <p >
                                                    {!! !empty($data->ticket_price) ? "$".$data->ticket_price : "" !!}
</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 >
                                                    Release Date :
                                                </h5>
                                            </td>
                                            <td>
                                                <p >
                                                    {!! !empty($data->release_date) ? $data->release_date : "" !!}
</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 >
                                                    Genre :
                                                </h5>
                                            </td>
                                            <td>
                                                <h5 >
                                                    @if(!empty($data->getFilmGenres))
                                                        @foreach($data->getFilmGenres as $genre)
                                                            <span class="btn btn-danger">
                                                                {!! $genre->name !!}
                                                            </span>
                                                        @endforeach
                                                    @endif
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 >
                                                    Country :
                                                </h5>
                                            </td>
                                            <td>
                                                <p >
                                                    {!! !empty($data->country) ? $data->country : "" !!}
</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 >
                                                    Rating :
                                                </h5>
                                            </td>
                                            <td>
                                                <h5 >
                                                    @if(!empty($data->rating))
                                                        @for($i=0; $i < 5; $i++)
                                                            @if($i < $data->rating)
                                                                <span class="fa fa-star rating-checked"></span>
                                                            @else
                                                                <span class="fa fa-star"></span>
                                                            @endif
                                                        @endfor
                                                    @endif
                                                    {{--{!! !empty($data->rating) ? $data->rating : "" !!}--}}
                                                </h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td valign="top" width="30%">
                                                <h5 >
                                                    Description :
                                                </h5>
                                            </td>
                                            <td>
                                                <p >
                                                    {!! !empty($data->description) ? $data->description : "" !!}
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
        <div class="comment-section">
            <div class="card">
               
                <div class="card-body">
                    <div class="row comment-body">
                    </div>
                    <div class="row">
                        <div class="custom_pagination d-none p-lg-1 col-12  text-center">
                            <button id="next-record" type="button" class="btn btn-primary d-none request-btn">Load
                                More
                            </button>
                        </div>

                    </div>
                    @if(!empty(auth()->user()->id))
                        <div class="row">
                            <div class="col-12">
                                <form action="javascript:void(0)" method="POST" id="ajax-form" class="ajax-form"
                                      data-action="{!! route("api.comments.store") !!}">
                                    <input type="hidden" name="user_id"
                                           value="{!! (!empty(auth()->user()->id))? auth()->user()->id : '' !!}">
                                    <input type="hidden" name="film_id"
                                           value="{!! (!empty($data->id))? $data->id : '' !!}">

                                    <fieldset class="form-group position-relative has-icon-left">
                                        <textarea name="comment" id="comment"
                                                  class="embed-responsive required  @error('comment') is-invalid @enderror"
                                                  rows="10" style="resize: none"></textarea>
                                        <span class="invalid-feedback" role="alert"></span>
                                    </fieldset>

                                    <button type="submit" class="btn btn-success float-right mt-1"> comment</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-footer d-none">
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- load page specific Js Files --}}
@section("JS_LOAD")
    <script src='{!! asset("assets/js/comments.js") !!}'></script>
@endsection
