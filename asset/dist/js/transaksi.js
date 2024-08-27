    // Script code Anda di sini
    document.getElementById('tambahBarang').addEventListener('click', function() {
        let sku = document.querySelector('select[name="sku"]').value;
        let nama_barang = document.querySelector('input[name="nama_barang"]').value;
        let harga = document.querySelector('input[name="harga"]').value;
        let qty = document.querySelector('input[name="qty"]').value;
        let total_harga = document.querySelector('input[name="total_harga"]').value;

        if (sku && qty) {
            let tabelBarang = document.getElementById('tabelBarang');
            let newRow = tabelBarang.insertRow();
            newRow.innerHTML = `
                <td>${tabelBarang.rows.length}</td>
                <td>${sku}</td>
                <td>${nama_barang}</td>
                <td>${harga}</td>
                <td>${qty}</td>
                <td>${total_harga}</td>
                <td><button type="button" class="btn btn-danger btn-sm">Hapus</button></td>
            `;
            // Tambahkan logika perhitungan subtotal dan lainnya di sini
        }
    });
