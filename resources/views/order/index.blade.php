@extends('layouts.app')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="card">
        <div class="card-body">
            <h3>Cari Sifariş(lər)</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Tarix</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr data-id="{{ $order->id }}">
                            <td>{{ $order->getDate() }}</td>
                            <td>{{ $order->getStatus() }}</td>
                            <td>
                                <button type="button" title="Təsdiqlə" class="btn btn-success check"><i class="fas fa-check"></i></button>
                                <a href="{{ route('order.items', $order->id) }}" title="Ətraflı" class="btn btn-info"><i class="fas fa-info"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.check').click(function (e) {
            e.preventDefault();
            var id = $(this).parents('tr').attr('data-id');
            $.ajax({
                url: '{{ route('order.check') }}',
                method: "POST",
                data: {_token:'{{ csrf_token() }}',id:id},
                success: function (response) {
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
