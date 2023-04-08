<!-- Navbar for title -->
<nav class = "navbar navbar-expand-lg navbar-dark bg-dark">
	<div class = "container-fluid">

		<a class = "navbar-brand" href = "<?= route(""); ?>">
			<img src = "<?= htmlspecialchars(image("icon_website.png")) ?>" alt = "Website Icon" width = "50" height = "50" class = "d-inline-block align-text-top">
			<p>Kristal Framework</p>
		</a>

	</div>
</nav>


<!-- Sticky navbar for links -->
<nav class = "navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
	<div class = "container-fluid">

		<button class = "navbar-toggler" type = "button" data-bs-toggle = "collapse" data-bs-target = "#main_nav" aria-controls = "navbarSupportedContent" aria-expanded = "false" aria-label = "Toggle navigation">
			<span class = "navbar-toggler-icon"></span>
		</button>

		<div class = "collapse navbar-collapse" id = "main_nav">
			<ul class = "navbar-nav navigation-links justify-content-center">

				<!-- Links -->
				<li class = "nav-item"><a class = "nav-link" page = "home.php" href = "<?= getURL(""); ?>" translationKey = "nav_home"></a></li>
                <li class = "nav-item"><a class = "nav-link" page = "about.php" href = "<?= getURL("about"); ?>" translationKey = "nav_about"></a></li>
                <li class = "nav-item"><a class = "nav-link" page = "theme.php" href = "<?= getURL("theme"); ?>" translationKey = "nav_theme"></a></li>
				<li class = "nav-item"><a class = "nav-link" page = "mail.php" href = "<?= getURL("mail"); ?>" translationKey = "nav_mail"></a></li>

			</ul>
		</div>

	</div>

	<!-- language settings -->
	<div id = "language-container">
		<a class = "nav-link select-language" id = "fi-button" role="button" switchLanguage = "fi">FI</a>
		<a class = "nav-link select-language" id = "en-button" role="button" switchLanguage = "en">EN</a>
	</div>

</nav>


<!-- Activate correct navigation link -->
<script>$("[page='<?= $page ?>']").addClass("active");</script>