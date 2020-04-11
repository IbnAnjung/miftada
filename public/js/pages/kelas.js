"use strict"

const url_data_kelas = 'kelas/data' 
const url_inactivating_kelas = 'kelas/';
const url_restore_kelas = 'restore/';

let tableKelas, tableKelasNonAktif, table_siswa_dalam_kelas, error

function kelasSelect2(){
    $('#kelas-select2').select2({
        ajax: {
          url: "/kelas/data",
          data : function(params){
            var query = {
              'search[value]': params.term,
              'columns[0][name]': 'nama',
              'columns[1][name]': 'tingkat'
            }
    
            return query
          },
          processResults: function (response, param) {
            return {
              results : response.data.map(function(kelas){
                return {
                  id: kelas.id,
                  text: 'Kelas ' + kelas.tingkat + ' ' + kelas.nama
                }
              })
            }
          }
        }
    })
}

function refreshTableKelas(){
    if($.fn.dataTable.isDataTable('#table-master-kelas')){
        tableKelas.ajax.reload();    
    }else{        
        tableKelas = $('#table-master-kelas').DataTable({
            ajax : url_data_kelas,
            columns: [
                {data: 'tingkat', 'name': 'tingkat'},
                {data: 'nama', 'name': 'name'},
                {data: 'total_siswa', orderable: false, searchable: false},
                {data: 'aksi', orderable: false, searchable:false}
            ],
            columnDefs: [
                {
                    targets: [2,3],
                    className: 'text-right'
                }
            ]
        })
    }
}

function refreshTableKelasNonAktif(){
    if($.fn.dataTable.isDataTable('#table-master-kelas-nonaktif')){
        tableKelasNonAktif.ajax.reload()
    }else{
        tableKelasNonAktif = $('#table-master-kelas-nonaktif').DataTable({
            ajax: 'nonaktif/data',
            columns: [
                {data: 'tingkat', 'name': 'tingkat'},
                {data: 'nama', 'name': 'name'},
                {data: 'total_siswa', orderable: false, searchable: false},
                {data: 'aksi', orderable: false, searchable:false}
            ],
            columnDefs: [
                {
                    targets: [2,3],
                    className: 'text-right'
                }
            ]
        })
    }
}

function refreshTableSiswaDalamKelas(idKelas){
    table_siswa_dalam_kelas = $('#table-siswa-dalam-kelas').DataTable({
        ajax: 'data/' + 'siswa/' + idKelas,
        columns: [
            {data: 'nis', name: 'nis'},
            {data: 'nama', name: 'name'},
            {data: 'status.keterangan', name: 'status.keterangan'},
            {data: 0, orderable: false, searchable: false}
        ]
    })
}

function inactivatingKelasConfirmating(id){
    swal({
        title: 'Kamu Yakin, Ingin Menonaktifkan Kelas Ini?',
        text: 'Aksi ini akan menonaktifkan seluruh siswa yang ada di dalamnya!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            inactivatingKelas(id)
        } else {
        swal('Oke!');
        }
      });
}

function inactivatingKelas(id){
    $.ajax({
        url: url_inactivating_kelas + id,
        method: 'DELETE',
        data: {_token:csrf_token},
        success: function(response){
            if(!response.status){
                swal('Aduh! ' + response.error , {
                    icon: 'warning',
                  });
            }else{
                swal('Wow! Kelas Berhasil Dinonaktifkan' , {
                    icon: 'success',
                  });
                refreshTableKelas();
            }
            
        },
        error: function(){
            swal('Aduh! Terjadi kesalahan sob', {
                icon: 'warning',
              });
        }
    })
}

function restoreKelasConfirmating(id){
    swal({
        title: 'Kamu Yakin, Ingin Mengaktifkan Kelas Ini?',
        text: 'Aksi ini akan mengaktifkan seluruh siswa yang ada di dalamnya!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            restoreKelas(id)
        } else {
        swal('Oke!');
        }
      });
}

function restoreKelas(id){

    $.ajax({
        url: url_restore_kelas + id,
        method: 'POST',
        data: {_token:csrf_token},
        success: function(response){
            if(!response.status){
                swal('Aduh! ' + response.error , {
                    icon: 'warning',
                  });
            }else{
                swal('Wow! Kelas Berhasil Dinonaktifkan' , {
                    icon: 'success',
                  });
                refreshTableKelasNonAktif();
            }
            
        },
        error: function(){
            swal('Aduh! Terjadi kesalahan sob', {
                icon: 'warning',
              });
        }
    })

}
