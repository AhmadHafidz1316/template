<x-layout>

    <x-card>
        <form id="transactionForm" action="" method="post">
            @csrf
            <div class="w-full flex">
                <input type="hidden" id="payment_clean" name="total_payment_clean" />


                <div class="w-1/2">
                    <h6 class="text-3xl">Produk yang dipilih</h6>
                    <br>

                    <input type="hidden" name="total_price" value="" />
                        <div class="mb-4">
                            <div></div>
                            <div class="flex justify-between">
                                <div>Rp. </div>
                                <div>Rp. </div>
                            </div>
                        </div>

                        <div class="flex justify-between">
                        <h6 class="text-2xl">Total</h6>
                        <h6 class="text-2xl">Rp. </h6>
                    </div>
                </div>

                <div class=" w-1/2 p-10">
                    <div>Member Status<span class="text-red-400"> Dapat juga membuat member</span></div>
                    <select id="member" name="member"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Bukan Member</option>
                        <option value="MEMBER">Member</option>
                    </select>
                    <br>
                    <div id="hp" class="hidden">
                        <div>No Telepon<span class="text-red-400"> (daftar/gunakan member)</span></div>
                        <input type="number" id="no_hp"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            name="no_hp" />
                        <br>
                    </div>
                    <div>Total Bayar</div>
                    <input type="text" id="payment"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        oninput="formatRupiah(this); checkPayment();" name="total_payment"
                        data-total="" />

                    <span class="text-red-300 hidden" id="bayar">Jumlah bayar kurang</span>
                    <br>
                    <div class="flex w-full justify-end">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Tambah Pembelian
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </x-card>

</x-layout>

<script>
    
    document.getElementById("member").addEventListener("change", function() {
        let phoneInput = document.getElementById('hp')
        if (this.value === 'MEMBER') {
            phoneInput.classList.remove('hidden');
        } else {
            phoneInput.classList.add('hidden');
        }
    });

    const paymentField = document.getElementById('payment');
    const paymentClean = document.getElementById('payment_clean');
    const bayarSpan = document.getElementById('bayar');
    const total = parseInt(paymentField.dataset.total);

    function formatRupiah(input) {
        let angka = input.value.replace(/[^\d]/g, '');
        if (!angka) {
            input.value = '';
            return;
        }
        let formatted = new Intl.NumberFormat('id-ID').format(angka);
        input.value = `Rp ${formatted}`;
    }

    function checkPayment() {
        let bayar = paymentField.value.replace(/[^\d]/g, '');
        bayar = parseInt(bayar) || 0;

        // Update hidden input
        paymentClean.value = bayar;

        // Cek apakah cukup
        if (bayar < total) {
            bayarSpan.classList.remove('hidden');
        } else {
            bayarSpan.classList.add('hidden');
        }
    }

    document.getElementById('transactionForm').addEventListener('submit', function(e) {
        const bayar = parseInt(paymentClean.value) || 0;

        if (bayar < total) {
            e.preventDefault(); // Mencegah form submit

            Swal.fire({
                icon: 'warning',
                title: 'Pembayaran Kurang!',
                text: 'Jumlah bayar masih kurang dari total belanja.',
                confirmButtonText: 'Oke'
            });

            return false;
        }
    });

    // Jalankan saat input berubah
    paymentField.addEventListener('input', function() {
        formatRupiah(this);
        checkPayment();
    });

    // Jalankan sekali di awal
    checkPayment();
</script>
