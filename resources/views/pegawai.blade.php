<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="judul text-center" > Data Pegawai </h3>
            </div>
            <div class="card-body">
                <a href="javascript:void(0)" class="btn btn-info" id="tombol-tambah">Tambah PEGAWAI</a>
                <br><br>
                <table id="pegawai" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                </table>
            </div> 
        </div>
    </div>

<!--  MODAL FORM TAMBAH/EDIT-->
<div class="modal fade" id="tambah-edit-modal" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-12">

                            <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Nama Pegawai</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai"
                                        value="" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Jenis Kelamin</label>
                                <div class="col-sm-12">
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control required">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">E-mail</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" id="email" name="email" value=""
                                        required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Alamat</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="alamat" id="alamat" required></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-offset-2 col-sm-12">
                            <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                                value="create">Simpan
                            </button>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<!-- MODAL KONFIRMASI DELETE-->

<div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Jika menghapus Pegawai maka</b></p>
                <p>*data pegawai tersebut hilang selamanya, apakah anda yakin?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                    Data</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#pegawai').DataTable({
        processing : true,
        serverSide : true,
        ajax : {
            url: "{{ route('pegawai.index') }}",
            type: 'GET'
             },
             columns: [
                     {data:'nama_pegawai', name:'nama_pegawai'},
                     {data:'jenis_kelamin', name:'jenis_kelamin'},
                     {data:'email', name:'email'},
                     {data:'alamat', name:'alamat'},
             ],
             order: [[0,'asc']]
        });
    });

    $('body').on('click', '.edit-post', function () {
            var data_id = $(this).data('id');
            $.get('pegawai/' + data_id + '/edit', function (data) {
                $('#modal-judul').html("Edit Post");
                $('#tombol-simpan').val("edit-post");
                $('#tambah-edit-modal').modal('show');

                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id);
                $('#nama_pegawai').val(data.nama_pegawai);
                $('#jenis_kelamin').val(data.jenis_kelamin);
                $('#email').val(data.email);
                $('#alamat').val(data.alamat);
            })
        });
</script>

</body>
</html>
