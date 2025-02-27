<style>
.dropdown .btn {
    background-color: transparent !important;
    border: none !important;
    color: inherit;
    box-shadow: none !important;
}
</style>


<div class="list-group border-0 ">
    <div class="mx-auto d-block mt-5">
        <img src="images/logo.png" width="50px" />
    </div>
    <span class="mx-auto d-block mb-3 fw-bold">Community Note</span>
    <a href="gallery.php" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
       <i class="fa-solid fa-house me-3 ps-3"></i> Home 
    </a>
    
    <a href="gallery.php" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
        <i class="fa-solid fa-bookmark me-3 ps-3"></i> Bookmarks 
    </a>
    
    <a href="gallery.php" class="list-group-item list-group-item-action border-0 mb-2 rounded-pill d-flex align-items-center fw-bold">
        <i class="fa-solid fa-user me-3 ps-3"></i> Profile 
    </a>
    
    <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-list-ul me-3 ps-3"></i><span class="fw-bold">More</span>
    </button>
    <ul class="dropdown-menu text-white">
        <li><a class="dropdown-item active" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Separated link</a></li>
    </ul>
    </div>

    <a href="post.php"class="btn btn-primary rounded-pill mx-auto px-4 mt-2">Post</a>
</div>

<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
