"use strict"
let table_siswa 

$("#tambah-status-siswa").fireModal({
    title: 'Tambah Siswa',
    body: $("#form-tambah-siswa"),
    footerClass: 'bg-whitesmoke',
    autoFocus: true,
    onFormSubmit: function(modal, e, form) {
      // Form Data
      let form_data = $(e.target).serialize();
     
      $.ajax({
        url: 'siswa/status',
        method: 'POST',
        data: form_data,
        dataType: 'JSON',
        success: function(response){
          iziToast.success({
            title: 'Yey!',
            message: "Data Berhasil di tambahkan",
            position: 'topRight'
          });
          $(e.target)[0].reset()
        },
        error: function(error){
          var errorParse = JSON.parse(error.responseText)
          if(errorParse.errors != null || typeof errorParse.errors != "undefined"){
            var error_message = errorParse.errors.keterangan[0]
          }else{
            var error_message = "Terdapat Kesalahan Server"
          }

          iziToast.error({
            title: 'Sorry!',
            message: error_message,
            position: 'topRight'
          });
        }
      })
      form.stopProgress();
      e.preventDefault();
    },
    shown: function(modal, form) {
      
    },
    buttons: [
      {
        text: 'Tambah',
        submit: true,
        class: 'btn btn-primary btn-shadow',
        handler: function(modal) {
        }
      }
    ]
  });
  
function siswaSelect(){
  $('#siswa-select2').select2({
    ajax: {
      url: '/siswa/data',
      data: function(params){
        let query = {
          'search[value]': params.term,
          'columns[0][name]': 'nama',
          'columns[1][name]': 'kelas.nama'
        }

        return query

      },
      processResults: function(response){
        return {
          results: response.data.map(function(siswa){
            return {
              id: siswa.id,
              text: siswa.nama + " (" + siswa.kelas.tingkat + " "+ siswa.kelas.nama + ")"
            }
          })
        }
      }
    }
  })
}
function statusSiswaSelect2(){
  $('#status-siswa-select2').select2({
    ajax: {
      url : '/siswa/status/data',
      processResults: function(data){
        return {
          results: data.map(function(status){
            return {
              id: status.id,
              text: status.keterangan
            }
          })
        }
      }
    }
  })
}

function deleteSiswa(id){
  swal({
    title: 'Yakin ?',
    text: 'Siswa akan berstaus non aktif setelah ini!',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: '/siswa/' + id,
        data: {_method: 'DELETE', '_token': csrf_token},
        method: 'POST',
        success : function(response){
          refreshTableSiswa()
          swal('Siswa berhasil di nonaktifkan!', {
            icon: 'success',
          });
        },
        error : function(responses){
          swal(responses.responseJSON.message, {
            icon: 'error',
          });
        }
      })
    } else {
      swal('Oke!');
    }
  });
} 

function restoreSiswa(id){
  swal({
    title: 'Yakin ?',
    text: 'Siswa akan berstatus aktif kembali setelah ini!',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
        url: '/siswa/restore/' + id,
        data: {_method: 'POST', '_token': csrf_token},
        method: 'POST',
        success : function(response){
          refreshTableSiswa()
          swal('Siswa berhasil di aktifkan kembali!', {
            icon: 'success',
          });
        },
        error : function(responses){
          swal(responses.responseJSON.message, {
            icon: 'error',
          });
        }
      })
    } else {
      swal('Oke!');
    }
  });
} 

function refreshTableSiswa(){
  var url = '/siswa/data'
  if(nonaktif){
     url = url + '?nonaktif=true'
  }

  if($.fn.dataTable.isDataTable('#table-siswa')){
    table_siswa.ajax.reload()
  }else{
    table_siswa = $('#table-siswa').DataTable({
      processing: true,
      serverside: true,
      ajax: url,
      columns: [
        {data: 'nis', name: 'nis'},
        {data: 'nama', name: 'nama'},
        {data: 'status.keterangan', name: 'status.keterangan'},
        {data: 'kelas.tingkat', name: 'kelas.tingkat'},
        {data: 'kelas.nama', name: 'kelas.nama'},
        {data: 'aksi', orderable: false, searchable: false}
      ],
      order: 3,
      columnDefs: [
        {
          targets: [5],
          className: 'text-right'
        }
      ]
    })
  }
}
