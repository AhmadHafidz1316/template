<x-layout>

    <x-card>

        <div class="flex justify-between items-center">
            <span class="text-4xl">Product</span>
                <a href="">
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

                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="p-4">
                        <img src="" class="w-16 md:w-32 max-w-full max-h-full"
                            alt="">
                    </td>
                    <td class="px-6 py-4 text-gray-900 dark:text-white">

                    </td>
                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        Rp
                    </td>
                    <td class="px-6 py-4 text-gray-900 dark:text-white">

                    </td>

                        <td class="px-6 py-4 space-x-3">
                            <div class="flex gap-5">
                                <a href=""
                                    class="font-medium text-blue-300 dark:text-blue-500 hover:underline">
                                    Edit
                                </a>
                                <button data-modal-target="modal-muehe item-id"
                                    data-modal-toggle="modal-muehe item-id"
                                    class="font-medium text-yellow-300 dark:text-yellow-500 hover:underline">
                                    Update Stock
                                </button>
                                <form action="" method="POST">
                                    <button type="submit"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </td>
                </tr>

                <!-- Modal Update Stock -->
                <div id="modal-muehe item-id"
                    class="hidden fixed inset-0 z-50  items-center justify-center bg-transparent bg-opacity-50 backdrop-blur-sm">
                    <div class="bg-white dark:bg-gray-800 rounded-lg w-full max-w-md shadow-lg p-6 relative">
                        <button type="button" data-modal-hide="modal-muehe item-id"
                            class="absolute top-3 right-3 text-gray-400 hover:text-gray-700 dark:hover:text-white">
                            &times;
                        </button>
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Update Stok -
                            </h2>
                        <form action="" method="POST" class="space-y-4">
                            <div>
                                <label for="stok-muehe item-id"
                                    class="block text-sm text-gray-600 dark:text-gray-300 mb-1">Jumlah Stok</label>
                                <input type="number" name="stok" id="stok-muehe item-id"
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
            @endif
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
