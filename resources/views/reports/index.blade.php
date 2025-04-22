@extends('layouts.main')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">Reports</h3>
        <ul class="list-group">
            <li class="list-group-item"><a href="{{ route('reports.mostFoodCategory') }}">Most Food in a Category</a></li>
            <li class="list-group-item"><a href="{{ route('reports.highestAvgPriceCategory') }}">Highest Average Price by
                    Category</a></li>
            <li class="list-group-item"><a href="{{ route('reports.menuCountPerCategory') }}">Menu Count Per Category</a></li>
            <li class="list-group-item"><a href="{{ route('reports.mostExpensiveAndCheapest') }}">Most Expensive and Cheapest
                    Menu</a></li>
            <li class="list-group-item"><a href="{{ route('reports.avgPricePerCategory') }}">Average Price per Category</a>
            </li>
        </ul>
    </div>
@endsection
