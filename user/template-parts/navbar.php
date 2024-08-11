<nav class="navbar bg-info bg-gradient fixed-top mb-5">

<div class="container-fluid">

<button class="navbar-toggler d-flex bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
  <span class="navbar-toggler-icon"></span>
</button>
<h5 class="animated pulse infinite position-absolute mt-2 d-md-block d-none ps-3 text-light text-decoration-none ms-5">TechEase: Technical Assistance for End-User Problems</h5>

<div class="offcanvas offcanvas-start" id="offcanvasDarkNavbar" tabindex="-1" aria-labelledby="offcanvasDarkNavbarLabel">

<div class="offcanvas-header">
    <button type="button" class="btn-close btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div><hr class="border border-2 border-muted">

<div class="offcanvas-body">
<div class="text-dark">Dashboard</div><hr class="border border-1 border-dark">


<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
<p><?= $full_name ?></p>

<li class="nav-item mb-3">
 <a href="index" class="nav-link fw-bolder" type="button">Home</a>
</li>

<li class="nav-item mb-3">
 <a href="records" class="nav-link fw-bolder" type="button">Records</a>
</li>

<li class="nav-item mb-3">
 <a href="department" class="nav-link fw-bolder" type="button">Department</a>
</li>
	
<li class="nav-item mb-3">
<a href="../logout" type="button" class="nav-link fw-bolder">Logout</a>
</li>

</ul>

</div>

</div>

</div>

</nav>
