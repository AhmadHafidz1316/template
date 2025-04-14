<x-layout>
    <x-card>
        <div class="flex w-full justify-between">
            <div class="flex">
                <button type="button"
                    class="items-end justify-end text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Unduh
                </button>
                <a href="{{ route('transactions') }}">
                    <button type="button"
                        class="items-end justify-end text-white bg-gray-500 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                        Kembali
                    </button>
                </a>
            </div>
            <div class="justify-end items-end ">
                <span>Invoice - # {{ $transaction->id }}</span>
                <br>
                <span>{{ $transaction->created_at->format('d F Y') }}</span>
            </div>
        </div>

        <x-table :headers="['Produk', 'Harga', 'Quantity', 'Sub Total']">
            @foreach ($transaction->detail as $item)
            <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        {{ $item->product->nama_produk }}
                    </td>
                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        Rp {{ number_format($item->product->harga) }}
                    </td>
                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        {{ $item->quantity }}
                    </td>
                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        Rp {{ number_format($item->sub_total) }}
                    </td>
                </tr>
            @endforeach
        </x-table>
        <br>
        <div class="w-full flex">
            <div class="flex-grow bg-gray-100 p-10">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">POINT DIGUNAKAN</th>
                        <th scope="col">KASIR</th>
                        <th scope="col">KEMBALIAN</th>
                        <th scope="col">TOTAL BAYAR</th>
                        <th scope="col">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>{{ $transaction->used_point ?? 0 }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>Rp. {{ number_format($transaction->total_return) }}</td>
                        <td>Rp. {{ number_format($transaction->total_payment) }}</td>
                        <td>Rp. {{ number_format($transaction->total_price) }}</td>
                      </tr>
                    </tbody>
                  </table>
                <table>

                </table>
            </div>
            <div class="w-1/4 bg-gray-800 text-white p-10 flex justify-between">

                <span class="text-2xl">Rp. {{ number_format($transaction->total_price) }}</span>
            </div>
        </div>


    </x-card>
</x-layout>
