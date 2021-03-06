<script src="<?= base_url('assets/template'); ?>/libs/jquery/jquery-migrate.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/libs/jquery-ui/jquery-ui.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/libs/jquery-ui/jquery.ui.autocomplete.scroll.min.js"></script>
<script src="<?= base_url('assets/template'); ?>/js/autocomplete.js"></script>
<style>
    .ui-autocomplete {
        z-index: 2147483647;
    }

    .modal-dialog {
        max-width: 1000px;
        margin: 1.75rem auto;
    }

    .input-group-text {
        width: 12rem;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row div_alert">
            <?php if ($this->session->flashdata('success')) {
                echo '<div class="alert alert-success" role="alert">' . $this->session->flashdata('success') . '</div>';
                unset($_SESSION['success']);
            } elseif ($this->session->flashdata('error')) {
                echo '<div class="alert alert-danger" role="alert">' . $this->session->flashdata('error') . '</div>';
                unset($_SESSION['error']);
            }
            ?>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-6 col-sm-6 col-xs-12">
                                <h4 class="header-title mt-0 mb-3">Data Dalam Peminjaman</h4>
                            </div>
                            <div class="col-xl-6 col-sm-6 col-xs-12">
                                <button class="btn float-end btn-outline-success rounded-pill waves-effect waves-light btn-xs" id="btn_inputPeminjaman"><i class="mdi mdi-plus me-1"></i>Input Peminjaman</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-2 col-sm-2 col-xs-12">
                                <div class="dataTables_length"></div>
                                <select id="datatable_length" name="datatable_length" aria-controls="datatable" class="form-select form-select-sm">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-xl-10 col-sm-10 col-xs-12">
                                <div id="datatable_filter" class="float-end dataTables_filter"><input type="search" class="form-control form-control-sm datatable_filter" placeholder="NISN, Judul, Nama" aria-controls="datatable"></div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Buku Dipinjam</th>
                                        <th>Tanggal Peminjaman</th>
                                        <th>Peminjam</th>
                                        <th>Petugas</th>
                                        <th>Denda Hari</th>
                                        <th>Total Denda</th>
                                        <th class="text-center">Tools</th>
                                    </tr>
                                </thead>
                                <tbody class="tbody_peminjaman_buku" id="tbody_peminjaman_buku">
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12 col-md-5 hidden-xs">
                                <div class="dataTables_info" id="datatable_info_peminjaman" role="status" aria-live="polite"></div>
                            </div>
                            <!-- Paginate -->
                            <div class="col-sm-12 col-md-7 clearfix">
                                <div class="dataTables_paginate paging_simple_numbers pagination-rounded" id="pagination_peminjaman">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Peminjaman -->
    <div class="modal fade" id="modalAddPeminjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Input Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_add_buku" enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>transaksi/peminjaman/insertPeminjaman">
                        <div class="form-group row">
                            <label for="input_nisn" class="col-sm-3 col-form-label">ID ANGGOTA</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_nisn" name="input_nisn" placeholder="search by nisn anggota" required>
                                <input type="hidden" class="form-control" id="input_iduser" name="input_iduser">
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_nama" name="input_nama" placeholder="Nama Anggota" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-1">
                            <label for="input_judul_buku" class="col-sm-3 col-form-label">Judul Buku</label>
                            <div class="col-sm-9">
                                <textarea name="input_judul_buku" id="input_judul_buku" class="form-control" rows="3" required="required" placeholder="Cari judul buku yang akan di pinjam..."></textarea>
                                <input type="hidden" class="form-control" id="input_idbuku" name="input_idbuku">
                                <!-- <div id="div_input_idbuku"></div> -->
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_tgl_peminjaman" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_tgl_peminjaman" name="input_tgl_peminjaman" required>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-sm btn-primary btn_save_buku" style="float: right;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pengembalian Buku -->
    <div class="modal fade" id="modalAddPengembalian" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Input Pengembalian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_add_buku" enctype="multipart/form-data" method="POST" action="<?= base_url(); ?>transaksi/pengembalian/insertPengembalian">
                        <div class="form-group row">
                            <label for="input_nisn_pengembalian" class="col-sm-3 col-form-label">ID ANGGOTA</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_nisn_pengembalian" name="input_nisn_pengembalian" placeholder="search by nisn anggota" disabled>
                                <input type="hidden" class="form-control" id="input_iduser_pengembalian" name="input_iduser_pengembalian">
                                <input type="hidden" class="form-control" id="input_tgl_pengembalian" name="input_tgl_pengembalian">
                                <input type="hidden" class="form-control" id="input_id_peminjaman" name="input_id_peminjaman">
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_nama_pengembalian" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="input_nama_pengembalian" name="input_nama_pengembalian" placeholder="Nama Anggota" disabled>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group row mt-1">
                            <label for="input_judul_buku_pengembalian" class="col-sm-3 col-form-label">Buku Kembali</label>
                            <div class="col-sm-9">
                                <div class="form-group div_buku_dikembalikan">
                                    <input type="hidden" class="form-control" id="input_jumlah_buku_kembali" name="input_jumlah_buku_kembali">
                                    <!-- <select multiple id="input_buku_dikembalikan" name="input_buku_dikembalikan[]">
                                    </select> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_buku_hilang" class="col-sm-3 col-form-label">Buku Hilang</label>
                            <div class="col-sm-9">
                                <div class="form-group div_buku_hilang">
                                    <!-- <select multiple id="input_buku_hilang" name="input_buku_hilang[]">
                                    </select> -->
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-1">
                            <label for="input_denda_telat" class="col-sm-3 col-form-label">Data Denda</label>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Total hari telat</span>
                                            <input type="text" class="form-control" id="input_jml_hari_telat" name="input_jml_hari_telat" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Biaya Denda Telat</span>
                                            <input type="text" class="form-control" id="input_denda_telat" name="input_denda_telat" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Jml Buku Hilang</span>
                                            <input type="text" class="form-control" id="input_jumlah_buku_hilang" name="input_jumlah_buku_hilang" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Biaya Denda Buku Hilang</span>
                                            <input type="text" class="form-control" id="input_denda_buku_hilang" name="input_denda_buku_hilang" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mt-1">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Total Harus Dibayar</span>
                                            <input type="text" class="form-control" id="input_total_denda" name="input_total_denda" aria-describedby="basic-addon1" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-sm btn-primary btn_save_buku" style="float: right;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.btn-close').on('click', function() {
            location.reload();
        });

        function getDateNow() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;
            return today;
        }

        setTimeout(function() {
            $(".div_alert").fadeOut('slow');
        }, 2000);
        var limit = $('select[name="datatable_length"]').val();

        $('input[name="input_tgl_peminjaman"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('Y-M-D') + ' to ' + end.format('Y-M-D'));
        });


        $('select[name="datatable_length"]').on('change', function() {
            let limit = $(this).val();
            // console.log(limit);
            loadPagination(limit);
        });
        loadPagination(limit);

        $(".datatable_filter").keyup(function(e) {
            e.preventDefault();
            let keyword = $(this).val();
            // console.log(keyword)
            loadFilter(keyword);
        });

        $('#pagination_peminjaman').on('click', 'a', function(e) {
            e.preventDefault();
            let limit = $('#datatable_length').val();
            let offset = $(this).attr('data-ci-pagination-page');
            loadPagination(limit, offset);
        });

        // Load filter
        function loadFilter(keyword) {
            $.ajax({
                url: '<?= base_url(); ?>transaksi/peminjaman/getData',
                type: 'POST',
                data: {
                    keyword: keyword,
                    limit: limit,
                    url_pagination: 'DataPeminjamanBuku'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {

                    // console.log(response);
                    let limit = response.data.limit_per_page;
                    let data_peminjaman = response.data.peminjaman;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;
                    $('#pagination_peminjaman').html(response.pagination);
                    createTable(data_peminjaman, total_data, limit, offset);
                }
            });
        }

        // Load pagination
        function loadPagination(limit, offset) {
            offset = typeof offset !== 'undefined' ? offset : 0;
            let page = offset * limit;
            $.ajax({
                url: '<?= base_url(); ?>transaksi/peminjaman/getData/' + offset,
                type: 'POST',
                data: {
                    offset: offset,
                    limit: limit,
                    // page: page,
                    url_pagination: 'DataPeminjamanBuku'
                },
                serverSide: true,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    let limit = response.data.limit_per_page;
                    let data_peminjaman = response.data.peminjaman;
                    let total_data = response.data.total_data;
                    let offset = response.data.current_page;
                    $('#pagination_peminjaman').html(response.data.pagination_link);
                    $('ul.pagination li a').addClass('page-link');
                    createTable(data_peminjaman, total_data, limit, offset);
                }
            });
        }

        function createTable(data_peminjaman, total_data, limit, offset) {
            console.log(data_peminjaman);
            let html = ``;
            offset = Number(offset);
            $('table#tbody_buku').empty();

            if (data_peminjaman != 0) {
                let numEnd = Number(limit) + Number(offset);
                if (parseInt(total_data) < parseInt(numEnd)) {
                    $('#datatable_info_peminjaman').html(`<strong>${offset+1}</strong>-<strong>${total_data}</strong> dari <strong>${total_data}</strong> Data`);
                } else {
                    $('#datatable_info_peminjaman').html(`<strong>${offset+1}</strong>-<strong>${numEnd}</strong> dari <strong>${total_data}</strong> Data`);
                }
                let no = 1;
                $.each(data_peminjaman, function(k, item) {
                    html += `<tr>`;
                    html += `<td><small>${no}</small></td>`;
                    html += `<td>`;
                    $.each(item.buku_dipinjam, function(j, item_buku) {
                        html += `<i style="font-size:11px; font-weight: bold;">- ${item_buku.judul_buku}</i><br>`;
                    });
                    html += `</td>`;
                    html += `<td><small>${item.tanggal_pinjam} s/d ${item.tanggal_kembali}</small></td>`;
                    // html += `<td>${item.tanggal_kembali}</td>`;
                    html += `<td><small>${item.nama_anggota}</small></td>`;
                    html += `<td><small>${item.nama_petugas}</small></td>`;
                    html += `<td><small>${item.jml_hari_denda}</small></td>`;
                    html += `<td><small>Rp.${parseInt(item.denda_telat).toLocaleString()}</small></td>`;
                    if (item.denda_status != 0) {
                        html += `<td class="text-center"><button class="btn btn-danger waves-effect waves-light btn-xs btnToolsPeminjaan" data-idbuku="${item.id_buku}" data-peminjam="${item.id_anggota}" data-denda="${item.denda_telat}" data-id="${item.id_peminjaman}">Input Pengembalian</button></td>`;
                    } else {
                        html += `<td class="text-center"><button class="btn btn-info waves-effect waves-light btn-xs btnToolsPeminjaan" data-idbuku="${item.id_buku}" data-peminjam="${item.id_anggota}" data-denda="${item.denda_telat}" data-id="${item.id_peminjaman}">Input Pengembalian</button></td>`;
                    }
                    html += `</tr>`;
                    no++;
                });
            } else {
                html += `<tr>`;
                html += `<td colspan="7" class="text-center"><i>Tidak ada data</i></td>`;
                html += `</tr>`;
            }
            $('.tbody_peminjaman_buku').html(html);
            $('.btnToolsPeminjaan').click(function() {
                let id = $(this).data('id');
                // let denda = $(this).data('denda');
                // let id_buku = $(this).data('idbuku');
                // let id_anggota = $(this).data('peminjam');
                // console.log(id);
                // console.log(denda);
                // console.log(id_buku);
                // console.log(id_anggota);
                $.ajax({
                    url: '<?= base_url(); ?>transaksi/peminjaman/getDataById',
                    type: 'post',
                    dataType: "json",
                    serverSide: true,
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        var data = response.data;
                        var buku_dipinjam = data.buku_dipinjam.length;
                        var jml_hari_telat = data.jml_hari_denda;
                        var buku_kembali = 0;
                        var denda_telat = data.biaya_denda_telat;
                        var total_denda_telat = buku_dipinjam * denda_telat * jml_hari_telat;
                        // buku hilang
                        var jml_buku_hilang = 0;
                        var denda_buku_hilang = data.biaya_denda_hilang;
                        var total_denda_buku_hilang = jml_buku_hilang * denda_buku_hilang;

                        var total_denda = total_denda_telat + total_denda_buku_hilang;


                        console.log(response);
                        $('#input_iduser_pengembalian').val(data.id_anggota);
                        $('#input_tgl_pengembalian').val(getDateNow());
                        $('#input_id_peminjaman').val(data.id_peminjaman);
                        $('#input_nisn_pengembalian').val(data.nisn);
                        $('#input_nama_pengembalian').val(data.nama_anggota);
                        $('#input_judul_buku_pengembalian').val(data.judul_buku);
                        $('#input_jml_hari_telat').val(data.jml_hari_denda);
                        $('#input_denda_telat').val(total_denda_telat);
                        $('#input_jumlah_buku_hilang').val(jml_buku_hilang);
                        $('#input_denda_buku_hilang').val(total_denda_buku_hilang);
                        $('#input_jumlah_buku_kembali').val(buku_dipinjam);
                        $('#input_total_denda').val(total_denda);
                        $.each(data.buku_dipinjam, function(k, item) {
                            $('.div_buku_dikembalikan').append(`<input type="hidden" class="form-control" name="input_buku_dipinjam[]" value="${item.id_buku}">`);
                            $('.div_buku_dikembalikan').append(`<input class="form-check-input input_buku_dikembalikan" type="checkbox" value="${item.id_buku}" id="input_buku_dikembalikan_${item.id_buku}" name="input_buku_dikembalikan[]" checked>
                            <label class="form-check-label" for="input_buku_dikembalikan${item.id_buku}">${item.judul_buku}</label><br for="input_buku_dikembalikan${item.id_buku}">`);
                            $('.div_buku_hilang').append(`<input class="form-check-input input_buku_hilang" type="checkbox" value="${item.id_buku}" id="input_buku_hilang_${item.id_buku}" name="input_buku_hilang[]">
                            <label class="form-check-label" for="input_buku_hilang_${item.id_buku}">${item.judul_buku}</label><br for="input_buku_hilang_${item.id_buku}">`);
                        });

                        $('#input_buku_hilang').selectize({
                            plugins: ["remove_button"],
                            maxItems: null,
                            delimiter: ',',
                            persist: true,
                            create: function(input) {
                                return {
                                    value: input,
                                    text: input
                                }
                            }
                        });

                        $('.input_buku_dikembalikan').on('click', function() {
                            let checked = $(this).is(':checked');
                            let id_buku = $(this).val();
                            buku_kembali = $('.div_buku_dikembalikan input:checkbox:checked').length;
                            $('#input_jumlah_buku_kembali').val(buku_kembali);
                            total_denda_telat = buku_kembali * denda_telat * jml_hari_telat;
                            jml_buku_hilang = buku_dipinjam - buku_kembali;
                            total_denda_buku_hilang = jml_buku_hilang * denda_buku_hilang;
                            total_denda = total_denda_telat + total_denda_buku_hilang;
                            $('#input_denda_telat').val(total_denda_telat);
                            $('#input_jumlah_buku_hilang').val(jml_buku_hilang);
                            $('#input_denda_buku_hilang').val(total_denda_buku_hilang);
                            $('#input_total_denda').val(total_denda);
                            if (checked == false) {
                                $('#input_buku_hilang_' + id_buku).prop('checked', true);
                                // $('#input_buku_hilang_' + id_buku).removeAttr("disabled");
                            } else {
                                $('#input_buku_hilang_' + id_buku).prop('checked', false);
                                // $('#input_buku_hilang' + id_buku).addAttr("disabled");
                            }
                        });
                    }
                });
                $('#modalAddPengembalian').modal('show');
            });
        }

        $('#btn_inputPeminjaman').click(function() {
            $('#modalAddPeminjaman').modal('show');
        });

        // Auto complete user
        $('#input_nisn').autocomplete({
            maxShowItems: 5,
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: '<?= base_url(); ?>manajemen/user/getDataForAutoComplete',
                    type: 'post',
                    dataType: "json",
                    serverSide: true,
                    data: {
                        filter: '4',
                        search: request.term
                    },
                    success: function(res) {
                        response(res.data_autocomplete);
                    }
                });
            },
            select: function(event, ui) {
                // Set selection
                $('#input_nisn').val(ui.item.value); // display the selected text
                $('#input_iduser').val(ui.item.id); // save selected id to input
                $('#input_nama').val(ui.item.label); // save selected id to input
                return false;
            },
            focus: function(event, ui) {
                $("#input_nisn").val(ui.item.value);
                $('#input_iduser').val(ui.item.id);
                $("#input_nama").val(ui.item.label);
                return false;
            },
        });
        // multyple autocomplete
        $("#input_judul_buku").autocomplete({
            source: function(request, response) {
                var searchText = extractLast(request.term);
                $.ajax({
                    url: '<?= base_url(); ?>manajemen/buku/getDataForAutoComplete',
                    type: 'post',
                    dataType: "json",
                    serverSide: true,
                    data: {
                        search: searchText
                    },
                    success: function(res) {
                        // console.log(res);
                        response(res.data);
                    }
                });
            },
            select: function(event, ui) {
                var terms = split($('#input_judul_buku').val());

                terms.pop();

                terms.push(ui.item.value);

                terms.push("");
                $('#input_judul_buku').val(terms.join("\n"));

                // Id buku
                terms = split($('#input_idbuku').val());
                terms.pop();
                terms.push(ui.item.id);
                terms.push("");
                $('#input_idbuku').val(terms.join("\n"));

                return false;
            }

        });

    });

    function split(val) {
        return val.split(/\n\s*/);
    }

    function extractLast(term) {
        return split(term).pop();
    }
</script>