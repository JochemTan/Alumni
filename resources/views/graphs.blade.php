@extends('layouts.app')
@section('title','Zoeken')
@section('nav')
    @include('restrictions.search')
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="css/search.css">
    <link rel="stylesheet" href="/css/overview.css">
@endsection
@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="form-group col-sm-6 col-lg-4">
            <label for="dataTypeSelect">Selecteer een groep</label>
            <select id="dataTypeSelect" class="form-control">
                <option value="graduationYear" selected>Afstudeer jaar</option>
                <option value="education">Opleiding</option>
                <option value="province">Provincie</option>
                <option value="place" >Plaats</option>
            </select>
        </div>
        <div class="form-group col-sm-6 col-lg-4">
            <label for="dataValuesSelect">Select soort waarde</label>
            <select id="dataValuesSelect" class="form-control">
                <option value="" selected>Totale hoeveelheid alumni</option>
                <option value="percentage">Percentage van de groep</option>
                <option value="percentageTotal">Percentage van de zoekresultaat</option>
                <option value="percentageAll">Percentage van het totaal</option>
            </select>
        </div>
        <div class="form-group col-sm-12 col-lg-4">
            <label for="chartTypeSelect">Selecteer diagram type</label>
            <select id="chartTypeSelect" class="form-control">
                <option value="bar" selected>Staafdiagram</option>
                <option value="line">Lijndiagram</option>
                <option value="pie">Taartdiagram</option>
                <option value="doughnut">Donutdiagram</option>
                <option value="polarArea">Pooldiagram</option>
                <option value="radar">Radardiagram</option>
            </select>
        </div>
        <canvas id="results-graph" width="400" height="120"></canvas>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.min.js"></script>
    <script src="/js/randomColor.js"></script>
    <script src="/js/graphs.js"></script>
@endsection
@section('footer')
@endsection

