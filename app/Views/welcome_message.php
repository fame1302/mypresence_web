<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Welcome to My Presence</title>
	<meta name="description" content="The small framework with powerful features">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico" />
	<!-- Custom fonts for this template-->
	<link href="<?= base_url(); ?>/sb_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= base_url(); ?>/sb_admin/css/sb-admin-2.min.css" rel="stylesheet">
	<link href="<?= base_url(); ?>/css/style.css" rel="stylesheet">
	<!-- STYLES -->

	<style>
		* {
			padding: 0;
			margin: 0;
		}

		html {
			height: 100%;
		}

		main {
			display: grid;
			grid-template-columns: 1fr;
			grid-template-rows: 1fr;
			height: 100%;
			width: 100%;
			justify-items: center;
			align-items: center;

		}

		header {
			font-size: 3em;
		}

		nav {
			display: grid;
			grid-template-columns: 1fr 1fr 1fr;
			margin-top: 50px;
			grid-template-areas: ". login .";
			gap: 20px;
		}

		nav>a {
			grid-area: login;
		}
	</style>
</head>

<body>

	<main class="bg-primary">
		<div>
			<header class="text-white">
				<span class="fa fa-calendar-alt"></span>
				<b>MyPresence</b>
			</header>
			<nav>
				<a class="btn btn-success text-gray-900" href="<?= base_url(); ?>/login">Login</a>
			</nav>
		</div>
	</main>

</body>

</html>