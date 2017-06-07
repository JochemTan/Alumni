<?php
use App\Filters;

?>
@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="/css/search.css">
    <link rel="stylesheet" href="/css/overview.css">
@endsection
@section('title','Werknemers')
@section('nav')
    @include('restrictions.level')
@endsection

@section('content')
        
        <div class="container" style="margin-top:100px;">
        <div class="alertMessage"></div>
            <h2>Werknemers</h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Naam</th>
                    <th>Email</th>
                    <th>Titel</th>
                    <th>Rol</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td class="name">{{$employee->name()}}</td>
                        <td class="email">{{$employee->email}}</td>
                        <td>{{$employee->jobTitle}}</td>
                        <td>
                            <select title="groep" name="group" class="selectpicker" style="">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{$role->id == $employee->getRole()->id?'selected':''}}>
                                        {{$role->name}}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('.selectpicker').change(function(){
            var id = $(this).val();
            var email = $(this).closest('tr').find('.email').text();
            $.ajax({
                type: 'POST',
                url: 'role/change',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    email: email,
                },
                success: function (e) {
                    $('.alertMessage').empty();
                    $('.alertMessage').html('<div class="alert alert-success"><strong>Gelukt:</strong> Rol is gewijzigd.</div>');

                },
                error: function () {
                    $('.alertMessage').html('<div class="alert alert-danger"><strong>Gelukt:</strong> Rol kan niet worden gewijzigd.</div>');
                }
                
            });
        });
    });
</script>
@endsection