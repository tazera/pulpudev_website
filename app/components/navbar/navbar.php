<link rel="stylesheet" href="/components/navbar/styles.css">
<style>
	/* Fix for mobile navbar underline issue */
	@media (max-width: 991px) {
		.navbar-nav .nav-link {
			display: inline-block;
			width: auto;
			text-align: center;
		}

		.dropdown-item {
			width: auto;
			display: inline-block;
			text-align: center;
		}

		.navbar-collapse.text-center .navbar-nav {
			align-items: center;
		}
	}
</style>
<nav class='navbar fixed-top navbar-expand-lg <?php echo $_SESSION['theme'] == "dark" ? "navbar-dark" : "navbar-light"; ?> bg-body-tertiary w-100 px-2'
	style='transition: transform 0.3s; font-size: <?php echo $font_size; ?>;'>
	<div class='container-fluid'>
		<a class='navbar-brand d-flex align-items-center' href="<?php echo $logo['href']; ?>">
			<img src="<?php echo $logo['image-path']; ?>" alt="<?php echo $logo['alt']; ?>" width="50" height="50"
				style="height: <?php echo $logo['height-in-px']; ?>px; border-radius: <?php echo $logo['border-radius']; ?>; border: <?php echo $logo['border']; ?>;">
			<span style="margin-left: 10px; font-weight: bold;"><?php echo $logo['companyName']; ?></span>
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
			aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class='collapse navbar-collapse text-center' id='navbarScroll'>
			<ul class='navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll' style='--bs-scroll-height: 300px;'>
				<?php
				# Anchors
				foreach ($anchors as $anchor) {
					$background = "";
					$effect = "menu-link";
					if (isset($anchor['highlight-color'])) {
						$background = "background-color: {$anchor['highlight-color']}; border-radius: 10px;";
						$effect = "nav-orange-button nav-orange-button rounded-pill px-3 py-2";
					}
					if (isset($anchor['dropdown-anchors']) == false) {
						echo "
	<li class='nav-item'>
		<a class='nav-link $effect active' aria-current='page' href='{$anchor['href']}' style='$background'>{$anchor['phrase']}</a>
	</li>
	";
					} else {
						echo "
	<li class='nav-item dropdown'>
		<a class='nav-link $effect dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
			{$anchor['phrase']}
		</a>
		<ul class='dropdown-menu'>
	";
						foreach ($anchor['dropdown-anchors'] as $subanchor) {
							echo "
		<li><a class='nav-link menu-link dropdown-item' href='{$subanchor['href']}'>
			{$subanchor['phrase']}
		</a></li>
		";
						}
						echo "
		</ul>
	</li>
	";
					}
				}

				# Languages
				echo "
				<li class='nav-item dropdown me-2'>
					<a class='nav-link dropdown-toggle' href='/components/navbar/change_language.php?language={$_SESSION['language']}' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
						<img src='/images/languages/{$_SESSION['language']}.webp' alt='{$_SESSION['language']}'  style='height: 22px; width: 22px; border-radius: 10px;'>
					</a>
					<ul class='dropdown-menu'>
";
				foreach ($languages as $language) {
					echo "
						<li><a class='dropdown-item' href='/components/navbar/change_language.php?language={$language['ISO_CODE']}'>
							<img src='/images/languages/{$language['ISO_CODE']}.webp' alt='{$language['NAME']}' style='height: 22px; width: 22px; border-radius: 10px;'>
							{$language['NAME']}
						</a></li>
	";
				}
				echo "
					</ul>
				</li>
";
				?>
			</ul>
		</div>
	</div>
</nav>
<script src="/components/navbar/script.js"></script>