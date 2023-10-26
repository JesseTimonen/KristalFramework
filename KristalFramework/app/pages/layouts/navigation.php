<nav class="navbar bg-dark border-bottom navbar-expand-lg bg-body-tertiary border-body" data-bs-theme="dark">
	<div class="container-fluid">
		<a class="navbar-brand" href="#">Kristal Framework</a>

		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" page="home.php" href="<?= route(""); ?>">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" page="theme.php" href="<?= route("theme"); ?>">Change Theme</a>
				</li>
			</ul>
      
			<!-- Language settings -->
			<ul class="navbar-nav ml-auto justify-content-end">
				<li class="nav-item" id="fi-button"><a class="nav-link select-language" switchLanguage="fi">FI</a></li>
				<li class="nav-item" id="en-button"><a class="nav-link select-language" switchLanguage="en">EN</a></li>
			</ul>
     
		</div>
	</div>
</nav>


<!-- Activate correct navigation link -->
<!-- (add page attribute to your navigation links with page file name as it's value, for example page="home.php") -->
<script>$("[page='<?= $page ?>']").addClass("active");</script>