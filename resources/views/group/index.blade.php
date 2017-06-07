@extends('layouts.app')
@section('nav')
    @include('layouts.nav.header2')
@endsection

@section('css')
    <style>
        .container.alumniProfile {
            max-width: 800px;
            margin-top: 100px;
        }

        .container.alumniProfile .row {
            margin: 0px;
        }

        .alert {
            display: none;
        }

        .special  {
            margin-top: 0px;
            display: block;
        }
    </style>
@endsection

@section('content')

    <div class="container alumniProfile">
            <form method="post" action="/group/create">
                {{csrf_field()}}
                <h4>Groep aanmaken</h4>
                <hr>

                <div class="row">
                    <b>Naam:</b>
                    <br>
                    <input name="groupName" required>
                    <button type="submit" class="profile profile-green">Opslaan</button>
                </div>
            </form>

        <div>
            <br>
            @if (session('msg-danger'))
                <div class="special alert alert-danger">
                    <strong>Mislukt:</strong> {{Session::get('msg-danger')}}
                </div>
            @endif
            @if (Session::has('msg-success'))
                <div class="special alert alert-success">
                    <strong>Gelukt:</strong> {{Session::get('msg-success')}}
                </div>
            @endif
            {{ $groups->links() }}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Groep</th>
                        <th>Aantal</th>
                        <th>Gemaakt op</th>
                    </tr>
                </thead>
                <tbody>
                {{--@foreach ($groups->members as $members)--}}
                    {{--@foreach($members as $member)--}}
                        {{--{{$member->id}}--}}
                    {{--@endforeach--}}
                {{--@endforeach--}}

                @foreach($groups as $group)
                    <form method="post" name="{{$group->id}}">
                    {{csrf_field()}}
                    <input type="hidden" name="ids" value="
                    @foreach($groups->members[$group->id] as $members)
                        {{$members->id . ","}}
                    @endforeach">

                    <tr>
                        <td><a href="/group/select/{{$group->id}}">{{$group->name}}</a></td>
                        <td>{{$groups->count[$group->id]}}</td><!-- comment: 1 -->
                        <td>{{$group->created_at}}</td>
                        <td>
                            @if($groups->count[$group->id] > 0)
                            <button formaction="/mail?" type="submit" class="btn btn-default">
                                <i class="glyphicon glyphicon-envelope"></i> Mail
                            </button>
                            @endif
                        </td>

                    </tr>
                    </form>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<!--
comment: 1
$the 'count' cant be places in the $group foreach because the '$group->items'
are protected. So $groups had a 2e array in it. Called 'count'.
'$groups->count' is a associate array so the count always check for the group id.