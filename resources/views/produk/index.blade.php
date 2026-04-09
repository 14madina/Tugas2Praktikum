@extends('layout.app')

@section('content')

<h2>Data Produk</h2>

<button class="btn btn-primary mb-3" onclick="tambah()">Tambah</button>

<table id="table" class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
</table>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Form Produk</h5>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id">
        <input class="form-control mb-2" id="nama" placeholder="Nama">
        <input class="form-control mb-2" id="harga" placeholder="Harga">
        <input class="form-control mb-2" id="stok" placeholder="Stok">
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onclick="simpan()">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
let table;

$(document).ready(function(){
    table = $('#table').DataTable({
        processing: true,
        ajax: {
            url: '/produk/data',
            dataSrc: 'data'
        },
        columns: [
            { data: 'nama' },
            { data: 'harga' },
            { data: 'stok' },
            {
                data: null,
                render: function(data){
                    return `
                    <button onclick="edit(${data.id})" class="btn btn-warning btn-sm">Edit</button>
                    <button onclick="hapus(${data.id})" class="btn btn-danger btn-sm">Delete</button>
                    `;
                }
            }
        ]
    });
});

// tambah data
function tambah(){
    $('#id').val('');
    $('#nama').val('');
    $('#harga').val('');
    $('#stok').val('');
    new bootstrap.Modal(document.getElementById('modal')).show();
}

// simpan (create + update)
function simpan(){
    $.post('/produk/store', {
        _token: '{{ csrf_token() }}',
        id: $('#id').val(),
        nama: $('#nama').val(),
        harga: $('#harga').val(),
        stok: $('#stok').val()
    }, function(){
        table.ajax.reload();
    });
}

// edit data
function edit(id){
    $.get('/produk/edit/' + id, function(data){
        $('#id').val(data.id);
        $('#nama').val(data.nama);
        $('#harga').val(data.harga);
        $('#stok').val(data.stok);
        new bootstrap.Modal(document.getElementById('modal')).show();
    });
}

// hapus data
function hapus(id){
    if(confirm('Yakin hapus data?')){
        $.get('/produk/delete/' + id, function(){
            table.ajax.reload();
        });
    }
}
</script>

@endsection