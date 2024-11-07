<!-- Header con imagen de fondo -->
<header class="bg-dark py-5 position-relative" style="background-image: url('https://noticaribepeninsular.com.mx/wp-content/uploads/2022/08/photo_5183831359846722237_y-1024x768.jpg'); background-size: cover; background-position: center;">
    <div class="container px-5 position-relative">
        <div class="row gx-5 justify-content-center">
            <div class="col-lg-6">
                <div class="text-center my-5">
                    <h1 class="display-5 fw-bolder text-white mb-2"><?php echo $title; ?></h1>
                    <p class="lead text-white-50 mb-4"><?php echo $info; ?></p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a class="btn btn-outline-light btn-lg px-4" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"><?php echo $modalBtnTitle ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $modalTitle; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php echo $modalContent; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<style>
    header::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Opacidad baja */
    }
</style>
