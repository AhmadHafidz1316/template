<x-layout>

    <x-card>

        <div class="flex justify-between items-center">
            @if (Auth::user()->role == 'admin')
            <a href="{{ route('createProduct') }}" class="p-5 mt-4">
                <button type="submit" class="btn btn-primary">
                    Tambah Produk
                </button>
            </a>
            @endif
        </div>
        <br>

        @foreach ($products as $product)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th><img src="{{ 'storage/' . $product->gambar }}" alt="{{ $product->nama_produk }}"></th>
                        <td>{{ $product->nama_produk }}</td>
                        <td>Rp {{ number_format($product->harga) }}</td>
                        <td>{{ $product->stok }}</td>
                        <td>
                            <a href="{{ route('editProduct', $product->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('deleteProduct', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Remove
                                </button>
                            </form>

                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#productModal{{ $product->id }}">
                                Update Stok
                            </button>
                            <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1"
                                aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="productModalLabel{{ $product->id }}">
                                                Update Product</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="{{ route('updateStock', $product->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="stok" min='0' value="{{ $product->stok }}">
                                            <button type="submit" class="btn btn-primary" >
                                            Update Stok
                                        </button>
                                        </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
        {{-- <div class="mt-4">
            <div>Product Links</div>
        </div> --}}

    </x-card>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: "success",
                draggable: true
            });
        </script>
    @endif
</x-layout>
