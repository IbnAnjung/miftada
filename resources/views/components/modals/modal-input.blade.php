<form class="form-horizontal" id="form-{{ $id }}">
<div class="modal fade" tabindex="-1" role="dialog" id="{{ $id }}" style="display: none;" aria-hidden="true">       
  <div class="modal-dialog modal-md" role="document">         
    <div class="modal-content">           
      <div class="modal-header">            
          <h5 class="modal-title">{{ $title }}</h5>             
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">               
            <span aria-hidden="true">×</span>             
          </button>           
        </div>           
        <div class="modal-body">
          {{ $slot }}          
        </div>           
      <div class="modal-footer bg-whitesmoke">
        <button type="submit" class="btn btn-primary btn-shadow" id="">Simpan</button>
      </div>         
    </div>       
  </div>    
</div>
</form>