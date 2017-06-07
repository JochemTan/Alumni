@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="/css/overview.css">
    <link rel="stylesheet" href="/css/bootstrap-tagsinput.css">
@endsection
@section('js')
    <script src="js/bootstrap-tagsinput.js"></script>
    <script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    {{--<script src="http://twitter.github.io/typeahead.js/releases/latest/typeahead.bundle.js"></script>--}}
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    {{-- <script>tinymce.init({ selector:'textarea' });</script> --}}
    {{-- <script>
        CKEDITOR.replace( 'editor1' );
    </script> --}}
@endsection
@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="well well-sm">
                    <form class="form-horizontal" action="/sendmail" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend class="text-center">Bericht Alumni</legend>
                            <!-- Email input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="email">E-mail</label>
                                <div class="col-md-9">
                                    <input data-role="tagsinput" id="email" name="email" type="text" class="form-control"
                                           value="

                                        @if(isset($opleidingshoofdEmails))
                                            @foreach($opleidingshoofdEmails as $email)
                                                {{$email . ","}}
                                            @endforeach
                                        @else
                                            @foreach($alumni as $alumnus)
                                               {{$alumnus["email"] . ","}}
                                            @endforeach
                                        @endif
                                    "/>
                                </div>
                            </div>
                            <!-- Name input-->
                                    <input type="hidden" id="name" name="name" class="form-control"
                                           value="

                                           @if(isset($opleidingshoofdEmails))
                                               @foreach($opleidingshoofdNames as $name)
                                                {{$name . ","}}
                                               @endforeach
                                           @else
                                               @foreach($alumni as $alumnus)
                                               {{$alumnus["name"] . ","}}
                                               @endforeach
                                           @endif
                                    "/>
                                {{--</div>--}}
                            {{--</div>--}}
                            <!-- Subject input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="subject">Onderwerp</label>
                                <div class="col-md-9">
                                    <input id="subject" name="subject" type="text" class="form-control">
                                </div>
                            </div>

                            <!-- Message body -->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="message">Bericht</label>
                                <div class="col-md-9">
                                    <textarea style="max-width: 686px;" class="form-control" id="message" name="message"
                                              placeholder="Plaats hier een bericht..." rows="5"></textarea>
                                </div>
                            </div>

                            <!-- Form actions -->
                            <div class="form-group">
                                <div class="col-md-11 text-right">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


