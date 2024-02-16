<div class="modal fade" id="modal{{ $idModal }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" >
  <div class="modal-dialog modal-lg" style="min-width:70%" role="document" >
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 font-weight-bold" id="tituloModal" ></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
       <form class="form-{{ $idModal }}" id="form-{{ $idModal }}" action="javascript:void(0);" method="PUT" enctype="multipart/form-data">

         @csrf
       <div class="container-fluid">
         {{ $slot}}
       </div>
        <div class="modal-footer d-flex justify-content-center">
          <div class="btn-group" role="group" aria-label="Acciones" id="footermodal" >
          </div>
          {{-- <button class="btn btn-default">Login</button> --}}
        </div>
      </form>
    </div>
  </div>
</div>
</div>
