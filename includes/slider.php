<div id="carouselExampleCaptions" class="carousel slide">
  <div class="noire"></div>
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <div class="overlay"></div>
      <img src="../assets/images/banner-2.jpg" style="max-height: 700px;" class="d-block w-100 zoom-in" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Conseils en Immigration et visa</h5>
        <div class="d-flex align-items-center justify-content-center gap-4">
          <button class="btn btn-danger col-md-3 p-3">Evaluation</button>
          <button class="btn btn-light col-md-3 p-3">Consultation</button>
        </div>
      </div>
    </div>
    <div class="carousel-item">
    <div class="overlay"></div>
      <img src="assets/images/banner-3.jpg" style="max-height: 700px;" class="d-block w-100 zoom-in" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Conseils en Immigration et visa</h5>
        <div class="d-flex align-items-center justify-content-center gap-4">
          <button class="btn btn-danger col-md-3 p-3">Evaluation</button>
          <button class="btn btn-light col-md-3 p-3">Consultation</button>
        </div>
      </div>
    </div>
    <div class="carousel-item">
    <div class="overlay"></div>
      <img src="../assets/images/banner-1.jpg" style="max-height: 700px;" class="d-block w-100 zoom-in" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Conseils en Immigration et visa</h5>
        <div class="d-flex align-items-center justify-content-center gap-4">
          <button class="btn btn-danger col-md-3 p-3">Evaluation</button>
          <button class="btn btn-light col-md-3 p-3">Consultation</button>
        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<style>
  button .btn{
    border-radius: 0;
  }
  .carousel-item {
    position: relative;
  }
  .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: black;
    opacity: 0.6;
    z-index: 1;
  }
  .carousel-caption {
    position: absolute;
    z-index: 10;
    top: 50%;
    transform: translateY(-50%);
  }
  .carousel-caption h5 {
    margin-bottom: 20px;
    font-size: 5rem;
  }
  .carousel-caption .btn {
    border-radius: 0;
  }
  .zoom-in {
    animation: zoomIn 15s ease-in;
  }

  @keyframes zoomIn {
    0% {
      transform: scale(1);
    }
    50% {
      transform: scale(1.1);
    }
    100% {
      transform: scale(1);
    }
  }
</style>