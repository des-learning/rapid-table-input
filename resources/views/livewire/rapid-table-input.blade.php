<div class="flex gap-2" x-data="{
    nama: '',
    harga: 0,
    quantity: 0,
    lastrow: $wire.items.length,
    update: false,
    editrow: -1,
    get total() {
        return this.harga * this.quantity;
    }
}">
    <input type="text" placeholder="nama barang" x-model="nama" x-ref="input_nama" autofocus />
    <input type="number" placeholder="harga barang" x-model="harga" />
    <input type="number" placeholder="quantity barang" x-model="quantity" />
    <span x-text="total"></span>
    <button type="button" @click="if (update) {
    if (editrow < 0) {
        return;
    }

    const index = $wire.items.findIndex(x => x.row === editrow);
    if (index < 0) {
        return;
    }
    $wire.items.splice(index, 1, { row: editrow, nama: nama, harga: harga, quantity: quantity, total: total });
    editrow = -1;
    update = false;
} else {
    $wire.items.push({ row: lastrow++, nama: nama, harga: harga, quantity: quantity, total: total });
}
nama = '';
harga = '';
quantity = '';
$refs.input_nama.focus();" x-text="update ? 'Update' : 'Tambah'">Tambah</button>
    <button wire:click="save">Save</button>

    <div class="flex flex-vertical gap-2">
        <p>nama barang: <span x-text="nama"></span></p>
        <p>harga barang: <span x-text="harga"></span></p>
        <p>quantity barang: <span x-text="quantity"></span></p>
        <p>total: <span x-text="total"></span></p>
    </div>

    <div class="flex">
        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>action</th>
            </tr>
            <template x-for="item in $wire.items">
                <tr>
                    <td x-text="item.row"></td>
                    <td x-text="item.nama"></td>
                    <td x-text="item.harga"></td>
                    <td x-text="item.quantity"></td>
                    <td x-text="item.total"></td>
                    <td>
                        <button type="button" @click="if (confirm('yakin di hapus?')) {
                        const index = $wire.items.findIndex(x => x.row === item.row);
                        if (index < 0) {
return;
}
                        $wire.items.splice(index, 1);
                        }">Delete</button>
                        <button type="button" @click="nama = item.nama; harga = item.harga; quantity = item.quantity; editrow = item.row; update = true; $refs.input_nama.focus()">Edit</button>
                    </td>
                </tr>
            </template>
        </table>
    </div>
</div>
