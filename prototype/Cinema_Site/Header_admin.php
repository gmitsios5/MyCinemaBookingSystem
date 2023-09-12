<!-- HEADER OF THE ADMIN PAGE WITH ALL THE ADMINS OPTIONS -->

<script src="responsive_head.js"></script>
<nav class="navbar navbar-expand-md navbar-dark fixed-top" id="banner">
	<div class="container">
		<!-- Brand -->
		<a class="navbar-brand" href="#top"><span>My</span>Cinema</a>

		<!-- Toggler/collapsibe Button -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Navbar links -->
		<div class="collapse navbar-collapse" id="collapsibleNavbar">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item" style="display:<?php echo $none_movies; ?>">
					<a class="nav-link" href="Movies.php">Movies</a>
				</li>
				<li class="nav-item" style="display: <?php echo $none_theaters; ?>">
					<a class="nav-link" href="admin_page.php#cinemaov">Theaters</a>
				</li>
				<li class="nav-item dropdown" style="display:<?php echo $none_uname; ?>">
					<a class="nav-link" href="#" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
						<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
						<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
					</svg>    <?php echo $uname_echo; ?></a>
					<div class="dropdown-menu">
						<form method="post" action="admin_page.php#add_movie_section">
							<button class="dropdown-item" name="user_profile"  style="display:<?php echo $add_movie_none;?>;">Add Movie</button>
						</form>
						<form method="post" action="admin_page.php#edit_movie_section">
							<button class="dropdown-item" name="user_profile"  style="display:<?php echo $add_movie_none;?>;">Edit Movie</button>
						</form>
						<form method="post" action="admin_page.php#create_cinema_hall_section">
							<button class="dropdown-item" name="user_profile"  style="display:<?php echo $add_movie_none;?>;">Create Cinema Hall</button>
						</form>
						<form method="post" action="admin_page.php#edit_cinema_hall_section">
							<button class="dropdown-item" name="user_profile"  style="display:<?php echo $add_movie_none;?>;">Edit Cinema Hall</button>
						</form>

						<form method="post" action="admin_page.php#add_projection_time_section">
							<button type="submit"  class="dropdown-item" name="user_profile" style="display:<?php echo $add_movie_none;?>">Add New Projection Date & Time </button>
						</form>
						<form method="post" action="admin_page.php#add_projection_section">
							<button type="submit"  class="dropdown-item" name="user_profile" style="display:<?php echo $add_movie_none;?>">Add New Projection to movie </button>
						</form>
						<form method="post">
							<input type="submit"  class="dropdown-item" name="logout" value="Log Out">
						</form>


					</div>
				</li>
			</div>

</ul>
</div>
</div>
</nav>

<div class="banner" style="height:100%;">

	<div class="banner-text" style="background-image:url('./Images/assets/cinema.jpg') ; background-repeat:no-repeat ; background-size:cover;">
		<div class="banner-heading">
			WELCOME TO My Cinema<?php echo "<h style='color:#ffc107;'>    ".$uname_echo."</h>" ?> ! ! !
		</div>
		<div class="banner-sub-heading">
			Book your ticket, and be ready for an extraordinary Cinema experience !
		</div>
		<div class="text-center">
			<!-- Button HTML (to Trigger Modal) -->
			<a href="#myModal" class="trigger-btn" data-toggle="modal"><button type="button" class="btn btn-warning text-dark btn-banner">LOGIN</button></a>
		</div>
		<div class="text-center">
			<!-- Button HTML (to Trigger Modal) -->
			<a href="#myModal2" class="trigger-btn" data-toggle="modal"><button type="button" class="btn btn-warning text-dark btn-banner">SIGN UP</button></a>
		</div>
	</div>
</div>
