let id_siswa, table_rekap_pembayaran

  
$('.form-pembayaran').on('submit', function(e){
    e.preventDefault();
    var data = $('.form-pembayaran').serialize()
    var action = e.target.action
    $.ajax({
        url: action,
        method: 'POST',
        data: data,
        dataType: "JSON",
        statusCode:{
            200 : function(response){
                iziToast.success({
                    title: 'Berhasil!',
                    message: 'Pembayaran Berhasil dilakukan',
                    position: 'topRight'
                  });
                $('#siswa-select2').val(null).trigger('change');
                $('#tagihan-siswa-select2').val(null).trigger('change');
                $('#nominal').val(0)
                $('#potongan').val(0)
                $('#terbayar').val(0)
                $('#bayar').val(0)
                $('siswa-select2').select('open')
            },
            403 : function(response){
                iziToast.error({
                    title: 'Error!',
                    message: response.responseJSON.message,
                    position: 'topRight'
                  });
            },
            400 : function(response){
                iziToast.error({
                    title: 'Error!',
                    message: response.responseJSON.message,
                    position: 'topRight'
                  });
            },
            404 : function(response){
                iziToast.error({
                    title: 'Error!',
                    message: response.responseJSON.message,
                    position: 'topRight'
                  });
            },
            500: function(response){
                iziToast.error({
                    title: 'Error!',
                    message: 'Server Error',
                    position: 'topRight'
                  });
            }
        }
    })
    return false;
})

$('#form-periode').on('submit', function(e){
    e.preventDefault()
    refreshTableRekap()

    $.ajax({
        url: '/tagihan/pembayaran/total',
        method: 'GET',
        data: $('#form-periode').serialize(),
        dataType: 'JSON',
        success: function(response){
            $('#total-pembayaran').html(response.total)
        }
    })
    return false
})

function tagihanSiswaSelect2(){
    $('#tagihan-siswa-select2').select2({
        ajax: {
            url: "/siswa/tagihans/" + id_siswa +'?status_tagihan=0',
            processResults: function(response){
                return {
                    results: response.tagihan.map(function(tagihan){
                        return{
                            id: tagihan.id,
                            text: tagihan.keterangan,
                            nominal: tagihan.nominal,
                            potongan: tagihan.pivot.potongan,
                            terbayar: tagihan.pivot.bayar
                        }
                    })
                }
            }
        }
    })
}

function rubahPembayaran(e){
   var id = e.getAttribute("data-id")

    swal({
        title: 'Masukan Nominal Pembayaran?',
        content: {
        element: 'input',
        attributes: {
          placeholder: 'total bayar',
          value: e.getAttribute('data-total'),
          type: 'text',
        },
        },
      }).then((data) => {
        $.ajax({
            url: '/tagihan/pembayaran/' + id,
            method: 'POST',
            data: { _token: csrf_token, _method: 'PUT', nominal: data },
            dataType: 'JSON',
            success: function(response){
                swal({
                    title: 'Berhasil',
                    text: 'Pembayaran Berhasil Di Rubah',
                    icon: 'success'
                })
                refreshTableRekap()
            },
            error : function(err){
                swal({
                    title: 'Error',
                    text: err.responseJSON.message,
                    icon: 'error'
                })
            }
        })
      });
}

function refreshTableRekap(){
    if(! $.fn.DataTable.isDataTable('#table-rekap-pembayaran')){
        table_rekap_pembayaran =  $('#table-rekap-pembayaran').DataTable({
            ajax: '/tagihan/pembayaran/data?' + $('#form-periode').serialize(),
            processing: true,
            serverside: true,
            order: [
                [0, 'desc'],
            ],
            columns: [
                { data: 'tanggal', name: 'tanggal' }, 
                { data: 'tagihan_siswa.siswa.nama', name: 'tagihan_siswa.siswa.nama' }, 
                { data: 'tagihan_siswa.siswa.kelas.tingkat', name: 'tagihan_siswa.siswa.kelas.tingkat' }, 
                { data: 'tagihan_siswa.siswa.kelas.nama', name: 'tagihan_siswa.siswa.kelas.nama' }, 
                { data: 'tagihan_siswa.tagihan.keterangan', name: 'tagihan_siswa.tagihan.keterangan' }, 
                { data: 'total', name: 'total' }, 
                { data: 'aksi', orderable: false, seaarchable: false }
            ]
        })
    }else{
        table_rekap_pembayaran.ajax.url('/tagihan/pembayaran/data?' + $('#form-periode').serialize()).load()
    }
}

function hapusPembayaran(e){
    var id = e.getAttribute('data-id')

    swal({
        title: 'Yakin Pembayarannya mau di hapus?',
        text: 'Jika di hapus kamu harus input kembali untuk mengembalikannya!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: '/tagihan/pembayaran/' + id,
                method: 'POST',
                data: {_token: csrf_token, _method: 'DELETE'},
                dataType: 'JSON',
                success: function(resoponse){
                    swal({
                        title: 'Berhasil',
                        text: 'Pemabayaran Berhasil diHapus',
                        icon: 'success'
                    })
                    refreshTableRekap()
                },
                error: function(err){
                    swal({
                        title: 'Error',
                        text: err.responseJSON.message,
                        icon: 'error',
                    })
                }
            })
        } else {
            swal('Ok Kalo gak jadi!');
        }
      });
}

$('#siswa-select2').on('select2:select', function(e){
    id_siswa = e.params.data.id
    tagihanSiswaSelect2()
    $('#tagihan-siswa-select2').select2('open')
})
$('#tagihan-siswa-select2').on('select2:select', function(e){
    var data_tagihan = e.params.data;
    $('#nominal').val(data_tagihan.nominal)
    $('#potongan').val(data_tagihan.potongan)
    $('#terbayar').val(data_tagihan.terbayar)
    $('#bayar').val(parseInt(data_tagihan.nominal) - parseInt(data_tagihan.potongan) - parseInt(data_tagihan.terbayar))
    $('#bayar').focus();
    $('#bayar').select();
})

$('.singledatepicker').daterangepicker({
    singleDatePicker : true,
    showDropDowns: true,
    drops: 'up',
    opens: 'center',
    locale: {
        format: 'YYYY-MM-DD'
    }
})