@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    Create Transactions
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'transactions.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('transactions.fields')
                </div>
          <!--Dropdown for payment method-->
                <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            @foreach($paymentMethods as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select><br><br>

            </div>
            

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('transactions.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
