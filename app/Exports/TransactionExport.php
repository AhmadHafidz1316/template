<?php

namespace App\Exports;

use App\Models\Transactions;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromArray, WithHeadings
{
    protected $filter;

    // Menambahkan konstruktor untuk menerima filter
    public function __construct($filter)
    {
        $this->filter = $filter;
    }

    public function array(): array
    {
        $product = [];

        $transactionsQuery = Transactions::with('detail.product', 'user', 'customer');

        if ($this->filter == 'day') {
            $transactionsQuery->whereDate('created_at', Carbon::today());
        } elseif ($this->filter == 'week') {
            $transactionsQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($this->filter == 'month') {
            $transactionsQuery->whereMonth('created_at', Carbon::now()->month);
        }

        $transactions = $transactionsQuery->get();

        foreach ($transactions as $transaction) {
            $product[] = [
                'Nama Pelanggan' => $transaction->customer->name ?? 'NON-MEMBER',
                'Tanggal Penjualan' => $transaction->created_at->format('d F Y'),
                'Total Harga' => 'Rp. ' . number_format($transaction->total_price),
                'Dibuat Oleh' => $transaction->user->name,
            ];
        }

        return $product;
    }

    public function headings(): array
    {
        return [
            'Nama Pelanggan',
            'Tanggal Penjualan',
            'Total Harga',
            'Dibuat Oleh'
        ];
    }
}
