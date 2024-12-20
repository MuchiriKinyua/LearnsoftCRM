@extends('layouts.app')

@section('content')

<head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{ asset('css/myUI.css') }}" type="text/css" rel="stylesheet" />
</head>

<div class="container-fluid">
    <div class="item0">
        <h1>Welcome {{ Auth::user()->name }}</h1>
        <!-- Group date and clock in a flex container -->
        <div style="display: flex; align-items: center; font-size: 1.2em;">
            <p style="margin: 0;">{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
            <p id="digital-clock" style="margin: 0 0 0 10px;"></p>
        </div>
    </div>

    <script>
        function updateClock() {
            const clockElement = document.getElementById('digital-clock');
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            clockElement.textContent = `${hours}:${minutes}:${seconds}`;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);

        // Initialize the clock immediately
        updateClock();
    </script>

    <div class="grid-row">

        <div class="card-body bg-primary">
            <p>{{ $totalClients }}</p>
            <p>Clients</p>
            <i class="nav-icon fas fa-address-book fa-2x"></i>
            <hr>
            <form action="{{ route('clients.index') }}" method="GET">
                <button type="submit" class="btn btn-dark">View clients</button>
            </form>
        </div>

        <div class="card-body bg-danger">
            <p>{{ $totalProducts }}</p>
            <p>Products</p>
            <i class="nav-icon fas fa-shopping-cart fa-2x"></i>
            <hr>
            <form action="{{ route('products.index') }}" method="GET">
                <button type="submit" class="btn btn-dark">View products</button>
            </form>
        </div>

        <div class="card-body bg-warning">
            <p>{{ $totalOrders }}</p>
            <p>Orders</p>
            <i class="nav-icon fas fa-shopping-basket fa-2x"></i>
            <hr>
            <form action="{{ route('orders.index') }}" method="GET">
                <button type="submit" class="btn btn-dark">View orders</button>
            </form>
        </div>

        <div class="card-body bg-info">
            <p>{{ $totalDepartments }}</p>
            <p>Departments</p>
            <i class="nav-icon fas fa-users fa-2x"></i>
            <hr>
            <form action="{{ route('departments.index') }}" method="GET">
                <button type="submit" class="btn btn-dark">View departments</button>
            </form>
        </div>

        <div class="card-body bg-dark">
            <p>{{ $totalEmployees }}</p>
            <p>Employees</p>
            <i class="nav-icon fas fa-user fa-2x"></i>
            <hr>
            <form action="{{ route('employees.index') }}" method="GET">
                <button type="submit" class="btn btn-dark">View employees</button>
            </form>
        </div>

        <div class="card-body bg-orange">
            <p>{{ $totalInteractions }}</p>
            <p>Interactions</p>
            <i class="nav-icon fas fa-tasks fa-2x"></i>
            <hr>
            <form action="{{ route('interactions.index') }}" method="GET">
                <button type="submit" class="btn btn-dark">View interactions</button>
            </form>
        </div>

    </div>

    <div class="grid-layout">
        <div class="panel">
            @include('partials.chart')
        </div>

        <div class="panel">
            @include('partials.infoChart')
        </div>

        <div class="panel">
            @include('partials.myChart')
        </div>
      
        <div class="panel">
            @include('partials.summaryChart')
        </div>
    </div>
</div>
</div>

@endsection