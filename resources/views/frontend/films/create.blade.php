@extends('layouts.master')
{{-- load page specific Css Files --}}
@section("CSS_LOAD")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center film-section">
            <div class="col-md-8 p-5" >
                <form action="javascript:void(0)" id="ajax-form" class="ajax-form" method="POST"
                      data-action="{!! route("api.films.store") !!}" enctype="multipart/form-data"
                      data-redirect="{!! route("films.index") !!}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control  required  @error('name') is-invalid @enderror"
                               name="name" id="name">
                        <span class="invalid-feedback" role="alert"></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Ticket Price</label>
                        <input type="text" class="form-control  required  @error('ticket_price') is-invalid @enderror"
                               name="ticket_price" id="ticket_price">
                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Description</label>
                        <textarea type="text" class="form-control  required  @error('description') is-invalid @enderror"
                                  name="description" id="description" rows="5" style="resize: none">

                        </textarea>
                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Cover image</label>
                        <input type="file"
                               class="form-control-file  required  @error('cover_image') is-invalid @enderror"
                               name="cover_image" id="cover_image">
                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Release Date</label>
                        <input type="text" class="form-control  required  @error('release_date') is-invalid @enderror"
                               name="release_date" id="release_date">
                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Genre</label>
                        <select multiple
                                class="form-control required  @error('genre_ids') is-invalid @enderror select2"
                                name="genre_ids[]" id="genre_ids" data-placement="Please select genre">
                            @if(!empty($genres))
                                @foreach($genres as $genre)
                                    <option value="{!! $genre->id !!}">{!! $genre->name !!}</option>
                                @endforeach
                            @endif
                        </select>
                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Rating</label>

                        <select class="form-control required @error('rating') is-invalid @enderror" name="rating"
                                id="rating">
                            <option value="">Select Rating</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Country</label>
                        <input type="text" class="form-control  required  @error('country') is-invalid @enderror"
                               name="country" id="country">
                        <span class="invalid-feedback" role="alert"></span>
                    </div>
                    <button type="submit" class="btn btn-success float-right">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- load page specific Js Files --}}
@section("JS_LOAD")
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{!! asset("assets/js/films/create_film.js") !!}"></script>
@endsection