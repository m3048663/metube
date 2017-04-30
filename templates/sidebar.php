        <div class="col-sm-3 col-md-2 sidebar">
			<div class="top-navigation">
				<div class="t-menu">MENU</div>
				<div class="t-img">
					<img src="images/lines.png" alt="" />
				</div>
				<div class="clearfix"> </div>
			</div>
				<div class="drop-navigation drop-navigation">
				  <ul class="nav nav-sidebar">
					<li class="active"><a href="index.php" class="home-icon"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
					<li><a href="#" class="menu1"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>Video<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></li>
						<ul class="cl-effect-2">
							<li><a href="index.php?main=movies">Movies</a></li>                                             
							<li><a href="index.php?main=cartoons">Cartoons</a></li>
							<li><a href="index.php?main=sports">Sports</a></li> 
						</ul>
						<!-- script-for-menu -->
						<script>
							$( "li a.menu1" ).click(function() {
							$( "ul.cl-effect-2" ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
					<li><a href="#" class="menu"><span class="glyphicon glyphicon-film glyphicon-music" class="song-icon" aria-hidden="true"></span>Audio<span class="glyphicon glyphicon-menu-down" aria-hidden="true"></span></a></li>
						<ul class="cl-effect-1">
							<li><a href="index.php?main=songs">Songs</a></li>                                             
							<li><a href="index.php?main=talkshows">TalkShows</a></li>
						</ul>
						<!-- script-for-menu -->
						<script>
							$( "li a.menu" ).click(function() {
							$( "ul.cl-effect-1" ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
					<li><a href="index.php?main=image" class="song-icon"><span class="glyphicon glyphicon-music" aria-hidden="true"></span>Image</a></li>
					<li><a href="index.php?main=medias" class="news-icon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Medias</a></li>
					<li><a href="index.php?main=channels" class="news-icon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Channels</a></li>
					<li><a href="index.php?main=cloudtag" class="news-icon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>Cloudtag</a></li>
				  </ul>
				  <!-- script-for-menu -->
						<script>
							$( ".top-navigation" ).click(function() {
							$( ".drop-navigation" ).slideToggle( 300, function() {
							// Animation complete.
							});
							});
						</script>
					<div class="side-bottom">
						<div class="side-bottom-icons">
							<ul class="nav2">
								<li><a href="#" class="facebook"> </a></li>
								<li><a href="#" class="facebook twitter"> </a></li>
								<li><a href="#" class="facebook chrome"> </a></li>
								<li><a href="#" class="facebook dribbble"> </a></li>
							</ul>
						</div>
						<div class="copyright">
							<p>Copyright © 2015 My Play. All Rights Reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
						</div>
					</div>
				</div>
        </div>
