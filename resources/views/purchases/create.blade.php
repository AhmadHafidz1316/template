<x-layout>
    <x-card>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="grid grid-cols-3 gap-4">

                    <input type="hidden" name="harga[product-id]" value="harga">
                    <input type="hidden" name="nama_produk[product-id]" value="">


                    <div
                        class="bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 flex">
                        <!-- Gambar -->
                        <img src="" class="w-1/3 object-cover rounded-l-lg"
                            alt="">

                        <!-- Konten -->
                        <div class="p-5 w-2/3 flex flex-col justify-between">
                            <a href="#">
                                <h5 class="mb-2 text-lg font-bold tracking-tight text-gray-900 dark:text-white">

                                </h5>
                            </a>
                            <p class="mb-3 text-sm text-gray-700 dark:text-gray-400">
                                Stok
                            </p>
                            <p class="mb-3 text-sm text-gray-700 dark:text-gray-400">
                                Rp.
                            </p>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <button
                                        class="minus inline-flex items-center justify-center h-6 w-6 p-1 me-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 1h16" />
                                        </svg>
                                    </button>
                                    <div>
                                        <input type="number" name="jumlah[product-id]"
                                            max="product-stock" data-stok="product-stock"
                                            data-harga="product-harga"
                                            class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            value="0" required readonly />

                                    </div>
                                    <button
                                        class="plus inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                        type="button">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 1v16M1 9h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <br>
                            <p class="subtotal mb-3 text-sm text-gray-700 dark:text-gray-400">
                                Rp. 0
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <br>
            <div class="flex flex-col-reverse">
                <button id="submitBtn" type="submit"
                    class="items-end justify-end text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Selanjutnya
                </button>

            </div>
        </form>
    </x-card>
</x-layout>

<script>
    const updateSubtotal = (input) => {
        const harga = parseInt(input.dataset.harga);
        const qty = parseInt(input.value);
        const subtotalElem = input.closest('.p-5').querySelector('.subtotal');
        subtotalElem.textContent = `Rp. ${(harga * qty).toLocaleString('id-ID')}`;

        const namaProdukInput = input.closest('.p-5').querySelector('input[name^="nama_produk"]');
        namaProdukInput.disabled = qty === 0;
    };

    document.querySelectorAll('.plus, .minus').forEach(btn => {
        btn.addEventListener('click', () => {
            const container = btn.closest('.flex');
            const input = container.querySelector('input[name^="jumlah"]');
            const stok = parseInt(input.dataset.stok);
            let qty = parseInt(input.value);

            if (btn.classList.contains('plus') && qty < stok) qty++;
            if (btn.classList.contains('minus') && qty > 0) qty--;

            input.value = qty;
            updateSubtotal(input);
        });
    });

    document.getElementById('submitBtn').addEventListener('click', (e) => {
        const total = [...document.querySelectorAll('input[name^="jumlah"]')]
            .reduce((sum, input) => sum + parseInt(input.value), 0);

        if (total === 0) {
            e.preventDefault();
            Swal.fire({
                title: 'Peringatan',
                text: 'Silakan pilih minimal satu produk sebelum melanjutkan!',
                icon: "warning",
                confirmButtonText: 'OK'
            });
        }
    });
</script>




@if (session('error'))
    <script>
        Swal.fire({
            title: 'Error',
            text: '{{ session('error') }}',
            icon: "error",
            draggable: true
        });
    </script>
@endif
