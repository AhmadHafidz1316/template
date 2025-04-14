<x-layout>

    <x-card>

        <div class="flex justify-between items-center">
            <span class="text-4xl">Pembelian</span>

            @if (Auth::user()->role == 'staff')
                <a href="{{ route('createTransaction') }}">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Tambah Pembelian
                    </button>
                </a>
            @endif
        </div>

        <br>
        <div class="flex justify-between">
            <div>
                <form method="GET" class="flex gap-10">
                    <select id="pagi" name="pagi"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="5"{{ request('pagi') == '5' ? 'selected' : '' }}>5</option>
                        <option value="10"{{ request('pagi') == '10' ? 'selected' : '' }}>10</option>
                        <option value="20"{{ request('pagi') == '20' ? 'selected' : '' }}>20</option>
                        <option value="30"{{ request('pagi') == '30' ? 'selected' : '' }}>30</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Sort</button>
                </form>
            </div>

            <!-- Filter by Date (Day, Week, Month) -->
            <div class="flex gap-2 ">
                <form method="GET">
                    <input type="text" name="search" placeholder="Cari..." value="{{ request('search') }}"
                        class="mb-4 px-4 py-2 border rounded ">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Cari</button>
                </form>

                <form method="GET" class="flex gap-2">
                    <select name="filter_by" id="filter_by" class="px-4 py-2 border rounded">
                        <option value="week" {{ request('filter_by') == 'week' ? 'selected' : '' }}>Mingguan</option>
                        <option value="day" {{ request('filter_by') == 'day' ? 'selected' : '' }}>Harian</option>
                        <option value="month" {{ request('filter_by') == 'month' ? 'selected' : '' }}>Bulanan</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Filter</button>
                </form>

                <a href="{{ route('downloadExcel', ['filter_by' => request('filter_by')]) }}">
                    <button type="button" class="items-center font-medium text-blue-600 dark:text-red-500 hover:underline">
                        Cetak Excel
                    </button>
                </a>

            </div>
        </div>

        <!-- Transactions Table -->
        @foreach ($transactions as $transaction)
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Tanggal Penjualan</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Dibuat Oleh</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $transaction->customer->name ?? 'NON-MEMBER' }}</td>
                        <td>{{ $transaction->created_at->format('d F Y') }}</td>
                        <td>Rp. {{ number_format($transaction->total_price) }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>
                            <a href="{{ route('downloadPDF', $transaction->id) }}">
                                <button type="button" class="btn btn-danger">Unduh Bukti</button>
                            </a>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal{{ $transaction->id}}">
                                Lihat
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="productModal{{ $transaction->id}}" tabindex="-1"
                                aria-labelledby="productModalLabel{{ $transaction->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="productModalLabel{{ $transaction->id}}">
                                                Invoice</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($transaction->detail as $item)
                                                <span>{{$item->product->nama_produk}}</span>
                                                <span> Rp {{ number_format($item->product->harga) }}</span>
                                                <span>{{ $item->quantity }}</span>
                                                <span>Rp {{ number_format($item->sub_total) }}</span>
                                            @endforeach
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

        <div class="mt-4">
            <div>{{ $transactions->links() }}</div>
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
