/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

document.getElementById('add-obat-button').addEventListener('click', function() {
    var container = document.getElementById('obat-container');
    var newRow = document.createElement('div');
    newRow.className = 'form-row';
    newRow.innerHTML = `
        <div class="form-group col-md-3">
            <label>R/</label>
            <input type="number" name="r[]" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>Nama Obat</label>
            <input type="text" name="nama_obat[]" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>Total Obat Fornas</label>
            <input type="number" name="total_obat_fornas[]" class="form-control">
        </div>
        <div class="form-group col-md-3">
            <label>Total Item</label>
            <input type="number" name="total_item[]" class="form-control">
        </div>
    `;
    container.appendChild(newRow);
});

function removeObatRow(index) {
    var row = document.getElementById('obat-row-' + index);
    row.parentNode.removeChild(row);
}

