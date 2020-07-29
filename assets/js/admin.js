$(document).on('click', '#btnUbahStaff', function(){
  var id = $(this).attr('data-id');
  $.ajax({
      url: "../api/UbahStaff?id="+id+"&sid="+Math.random(),
      type: "GET",
      success: function (ajaxData){
        $("#ModalEdit").html(ajaxData);
        $("#ModalEdit").modal('show',{backdrop: 'true'});
        var obj = jQuery.parseJSON(ajaxData);
        $('#id_staff').val(obj['id_staff'])
        $('#nip_staff').val(obj['nip_staff'])
        $('#nama_staff').val(obj['nama_staff'])
        $('#email').val(obj['email'])
        $('#no_hp').val(obj['no_hp'])
        $('#kategori_staff').val(obj['kategori_staff'])
        $('#old_image').val(obj['foto'])
      }
  })
})

$(document).on('click', '#btnUbahKategori', function(){
  var id = $(this).attr('data-id');
  $.ajax({
      url: "../api/UbahKategoriBerita?id="+id+"&sid="+Math.random(),
      type: "GET",
      success: function (ajaxData){
        $("#ModalEdit").html(ajaxData);
        $("#ModalEdit").modal('show',{backdrop: 'true'});
        var obj = jQuery.parseJSON(ajaxData);
        $('#id_kategori').val(obj['id_kategori'])
        $('#nama_kategori').val(obj['nama_kategori'])
      }
  })
})

$(document).on('click', '#btnUbahBerita', function(){
  var id = $(this).attr('data-id');
  $.ajax({
      url: "../api/UbahBerita?id="+id+"&sid="+Math.random(),
      type: "GET",
      success: function (ajaxData){
        $("#ModalEdit").html(ajaxData);
        $("#ModalEdit").modal('show',{backdrop: 'true'});
        var obj = jQuery.parseJSON(ajaxData);
        $('#id_berita').val(obj['id_berita'])
        $('#kategori_id').val(obj['kategori_id'])
        $('#nama_berita').val(obj['nama_berita'])
        CKEDITOR.instances.editor2.setData(obj['isi_berita']);
        $('#tgl_berita').val(obj['tgl_berita'])
        $('#old_image').val(obj['foto_berita'])
      }
  })
})

$(document).on('click', '#btnHapus', function(event){
  
  var id = $(this).data('id')

  $('#id-data').val(id)
})

