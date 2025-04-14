<x-layout>

    <x-card>

        <div class="flex justify-between items-center">
            <span class="text-4xl">Product</span>
                <a href="{{ route('createProduct') }}">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Tambah Produk
                    </button>
                </a>
        </div>
        <br>
        <form method="GET" >
            <input type="text" name="search" placeholder="Cari..." value="" class="mb-4 px-4 py-2 border rounded w-1/3">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Cari</button>
        </form>

        <x-table :headers="['', 'Nama Produk', 'Harga', 'Stok']">
            @foreach ($products as $product)
                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="{{ 'storage/'.$product->gambar }}" class="w-16 md:w-32 max-w-full max-h-full"
                            alt="{{ $product->nama_produk }}">
                    </td>
                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        {{ $product->nama_produk }}
                    </td>
                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        Rp {{ number_format($product->harga) }}
                    </td>
                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        {{ $product->stok }}
                    </td>

                        <td class="px-6 py-4 space-x-3">
                            <div class="flex gap-5">
                                <a href="{{ route('editProduct', $product->id) }}"
                                    class="font-medium text-blue-300 dark:text-blue-500 hover:underline">
                                    Edit
                                </a>
                                <button data-modal-target="modal-{{ $product->id }}"
                                    data-modal-toggle="modal-{{ $product->id }}"
                                    class="font-medium text-yellow-300 dark:text-yellow-500 hover:underline">
                                    Update Stock
                                </button>
                               <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal-{{ $product->id }}" data-bs-target="modal-{{ $product->id }}">
                                Launch static backdrop modal
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-{{ $product->id }}" data-bs-backdrop="modal-{{ $product->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div></div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                                <form action="{{ route('deleteProduct', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </td>
                </tr>

                <!-- Modal Update Stock -->
                <div id="modal-{{ $product->id }}"
                    class="hidden fixed inset-0 z-50  items-center justify-center bg-transparent bg-opacity-50 backdrop-blur-sm">
                    <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-md shadow-lg p-6 relative">
                        <button type="button" data-modal-hide="modal-{{ $product->id }}"
                            class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 dark:hover:text-white">
                            &times;
                        </button>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Update Stok -
                            </h2>
                        <form action="" method="POST" class="space-y-4">
                            <div>
                                <label for="stok-{{ $product->id }}"
                                    class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Jumlah Stok</label>
                                <input type="number" name="stok" id="stok-{{ $product->id }}"
                                    value="" required
                                    class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 focus:ring focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <br>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal fade" id="modal-{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          ...
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach

        </x-table>
        <div class="mt-4">
            <div>Product Links</div>
        </div>

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
