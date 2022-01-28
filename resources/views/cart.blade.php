@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="mb-3">Cart Items</h4>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                @if(session('cart'))
                    <table id="cart" class="table table-hover">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $total = 0; @endphp
                        @foreach(session('cart') as $id => $item)
                            @php $total += $item['qty'] * $item['price'] @endphp
                            <tr data-id="{{ $id }}">
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['price'] }}</td>
                                <td style="width:20%">
                                    <input type="number" class="form-control updateQty qty" value="{{ $item['qty'] }}" style="width:40%">
                                </td>
                                <td>{{ number_format($item['qty'] * $item['price'], 2) }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-danger remove"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="5" class="text-right"><h3><strong>Total {{ number_format($total, 2) }}</strong></h3></td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">
                                <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>Continue Shopping</a>
                                <button type="button" class="btn btn-success checkout">Checkout</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                @else
                    <div class="alert alert-info">Səbət boşdur</div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.updateQty').on('change', function (e) {
            e.preventDefault();
            var id = $(this).parents('tr').attr('data-id');
            var qty = $(this).parents('tr').find('.qty').val();
            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "POST",
                data: {_token:'{{ csrf_token() }}',id:id,qty:qty},
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $('.remove').click(function (e) {
            e.preventDefault();
            var id = $(this).parents('tr').attr('data-id');
            if (confirm("Silmək istədiyinizdən əminsinizmi ?")) {
                $.ajax({
                    url: '{{ route('cart.delete') }}',
                    method: "DELETE",
                    data: {_token:'{{ csrf_token() }}',id:id},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });

        $('.checkout').click(function (e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('cart.checkout') }}',
                method: "POST",
                data: {_token:'{{ csrf_token() }}'},
                success: function (response) {
                    window.location.href = '/';
                }
            });
        });
    </script>
@endsection
