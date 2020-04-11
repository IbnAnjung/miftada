"use strict"
let table_tagihan
let table_daftar_tagihan_siswa
let actived_tagihan_on_edit;

function refreshTableTagihanDataTable(){
	if($.fn.dataTable.isDataTable('#table-tagihan')){
		table_tagihan.ajax.reload()
	}else{
		table_tagihan = $('#table-tagihan').DataTable({
			ajax: '/tagihan/data',
			serverside: true,
			processing: true,
			columns : [
				{data: 'DT_RowIndex', orderColumn:false, searchable:false},
				{data: 'tanggal_terbit', name: 'tanggal_terbit'},
				{data: 'nominal', name: 'nominal'},
				{data: 'total_tagihan', orderable: false, searchable: false },
				{data: 'total_bayar', orderable: false, searchable: false},
				{data: 'aksi', orderable: false, searchable: false}
			],
			columnsDefs: [
				{
					targets: [2,3,4],
					className: 'text-right'
				}
			]
		})
	}
}

function refreshTableDaftarSiswaTagihanDataTable(id_tagihan){
	if($.fn.dataTable.isDataTable("#table-daftar-tagihan-siswa")){
		table_daftar_tagihan_siswa.ajax.reload()
	}else{
		table_daftar_tagihan_siswa = $("#table-daftar-tagihan-siswa").DataTable({
			ajax: "/tagihan/data/" + id_tagihan,
			serverside: true,
			processing: true,
			columns: [
			  { data:'nis', name:'nis'},
			  { data:'nama', name:'nama'},
			  { data:'potongan', name:'potongan'},
			  { data:'bayar', name:'bayar'}, 
			  { data: 'edit', orderable:false, searchable: false}
			]
		})
	}
}

function batalkanTagihan(e){
	  swal({
		  title: 'Kamu Yakin?',
		  text: 'Jika DiBatalkan, kamu akan menghapus semua tagihan terhadap siswa, dan tagihan akan di hilangkan.',
		  icon: 'warning',
		  buttons: true,
		  dangerMode: true,
	  })
	  .then((willDelete) => {
		  if(willDelete){
			let id_tagihan = $(e).data('id');
			$.ajax({
				url: '/tagihan/' + id_tagihan,
				metod: 'POST',
				data: {
					_token : csrf_token,
					_method: 'DELETE',
					id: id_tagihan,  
				},
				dataType: 'JSON',
				success: function(responses){
					swal({
						icon: success,
						text: 'Kamu berhasil membatalkan tagihan'
					})
					refreshTableTagihanDataTable()
				}
			})
		  }else{
			  swal('Oke!')
		  }
	  })
}

$('#form-potongan-siswa').on('submit', function(e){
	e.preventDefault();
	let data = $('#form-potongan-siswa').serialize()
	let url = $('#form-potongan-siswa')[0].action
	simpanPotongan(url, data)
})

$('#form-potongan-status-siswaa').on('submit', function(e){
	e.preventDefault();
	let data = $('#form-potongan-status-siswaa').serialize()
	let url = $('#form-potongan-status-siswaa')[0].action
	simpanPotongan(url, data)
})

$('#form-modal-edit-tagihan-siswa').on('submit', function(e){
	e.preventDefault();
	let data = {
		siswa: [actived_tagihan_on_edit.idsiswa],
		id_tagihan: actived_tagihan_on_edit.idtagihan,
		_token: csrf_token,
		nominal: document.getElementById('potongan').value
	}
	let url = '/tagihan/potongan/rubah/siswa/' + data.id_tagihan

	simpanPotongan(url, data)
})

$(document).on('click', '.edit-tagihan-siswa', function(){
  actived_tagihan_on_edit = $(this).data();
  
  document.getElementById('nama-tagihan').value=actived_tagihan_on_edit.namatagihan
  document.getElementById('nama-siswa').value=actived_tagihan_on_edit.namasiswa
  document.getElementById('total-tagihan').value=actived_tagihan_on_edit.totaltagihan
  document.getElementById('potongan').value=actived_tagihan_on_edit.potongan
  $('#modal-edit-tagihan-siswa').modal('show');
})

$('#modal-edit-tagihan-siswa').on('hidden.bs.modal', function (e) {
	actived_tagihan_on_edit = '';
	refreshTableDaftarSiswaTagihanDataTable(id_tagihan)
})

function simpanPotongan(url, data){
   $.ajax({
	   url: url,
	   method: "POST",
	   data: data,
	   dataType: "JSON",
	   success: function(responses){
		swal('Berhasil merubah potongan!', {
			icon: 'success',
		  });
		  console.log(responses)         
	   },
	   error: function(responses){
		swal(responses.responseJSON.message, {
			icon: 'error',
		  });
	   } 
   })
}