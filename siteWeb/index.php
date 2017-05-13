<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>Projet Annuel - DumbIT</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Coffee Break Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<script src="js/jquery.min.js"></script>
<!---- start-smoth-scrolling---->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
		</script>
<!--start-smoth-scrolling-->
</head>
<body>
	<!--header-top-starts-->
	<div class="header-top">
		<div class="container">
			<div class="head-main">
				<a href="index.php"><img src="images/logo.png" alt="" width="100px" /></a>
			</div>
		</div>
	</div>
	<!--header-top-end-->
	<!--start-header-->
	<div class="header">
		<div class="container">
			<div class="head">
			<div class="navigation">
				 <span class="menu"></span> 
					<ul class="navig">
						<li><a href="index.php"  class="active">Home</a></li>
						<li><a href="../bo/pages/index.php">Back-Office</a></li>
					</ul>
			</div>
			<div class="header-right">
				<div class="search-bar">
					<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
					<input type="submit" value="">
				</div>
				<ul>
					<li><a href="#"><span class="fb"> </span></a></li>
					<li><a href="#"><span class="twit"> </span></a></li>
					<li><a href="#"><span class="pin"> </span></a></li>
					<li><a href="#"><span class="rss"> </span></a></li>
					<li><a href="#"><span class="drbl"> </span></a></li>
				</ul>
			</div>
				<div class="clearfix"></div>
			</div>
			</div>
		</div>	
	<!-- script-for-menu -->
	<!-- script-for-menu -->
		<script>
			$("span.menu").click(function(){
				$(" ul.navig").slideToggle("slow" , function(){
				});
			});
		</script>
	<!-- script-for-menu -->
	<!--banner-starts-->
	<div class="banner">
		<div class="container">
			<div class="banner-top">
				<div class="banner-text">
					<h2>Nouveau projet</h2>
					<h1>Programme de démineur en Langage C</h1>
					<div class="banner-btn">
						<a href="#">en savoir plus</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--banner-end-->
	<br>
	<!--team-starts-->
	<div class="team">
		<div class="container">
		<div class="team-top heading">
			<h3>NEWEST ARTICLE</h3>
		</div>
			<div class="team-bottom">
				<?php
					require "libIndex.php";
					displayNewestArticle(indexGetNewestArticle());
				?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--team-end-->
	<!--team-starts-->
	<div class="team">
		<div class="container">
		<div class="team-top heading">
			<h3>NEWEST PROJET</h3>
		</div>
			<div class="team-bottom">
				<?php
					displayNewestProjet(indexGetNewestProjet());
				?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--team-end-->
	<!--about-starts-->

	<!-- PARTIE pas du tout dynamique, mais c'est prévu. -->
	<div class="about">
		<div class="container">
			<div class="about-main">
				<div class="col-md-8 about-left">
					<div class="about-one">
						<p>Projet A l'honeur</p>
						<h3>Maquette en 3D d'une imprimante 3D qui imprime en 2D</h3>
					</div>
					<div class="about-two">
						<a href="single.html"><img src="images/imprimante3D" alt="" /></a>
						<p>Posté par <a href="#">Johnson</a> le 10 fév, 2017 <a href="#">commentaires(2)</a></p>
						<p>Cette imprimante est révolutionnaire.</p>
						<p>Soutenez notre projet. SVP. Abonnez-vous</p>
						<div class="about-btn">
							<a href="single.html">En savoir plus</a>
						</div>
						<ul>
							<li><p>Partager : </p></li>
							<li><a href="#"><span class="fb"> </span></a></li>
							<li><a href="#"><span class="twit"> </span></a></li>
							<li><a href="#"><span class="pin"> </span></a></li>
							<li><a href="#"><span class="rss"> </span></a></li>
							<li><a href="#"><span class="drbl"> </span></a></li>
						</ul>
					</div>	
				</div>
				<div class="col-md-4 about-right heading">
					<div class="abt-1">
						<h3>A propos de nous</h3>
						<div class="abt-one">
							<img src="images/s-3.jpg" alt="" />
							<p>Une jeune équipe d'étudiant à l'ESGI</p>
							<div class="a-btn">
								<a href="#">En savoir plus</a>
							</div>
						</div>
					</div>
					<div class="abt-2">
						<h3>Vous seriez peut-être intéressé</h3>

							<?php randomArticleInterest(indexGetNewestArticle());?>

					</div>
					<div class="abt-2">
						<h3>NEWS LETTER</h3>
						<div class="news">
							<form>
								<input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" />
								<input type="submit" value="S'abonner">
							</form>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>			
			</div>		
		</div>
	</div>
	<!--about-end-->
	<!--slide-starts-->
	<div class="slide">
		<div class="container">
			<div class="fle-xsel">
			<ul id="flexiselDemo3">
				<?php carousel(); ?>			
			</ul>
							
							 <script type="text/javascript">
								$(window).load(function() {
									
									$("#flexiselDemo3").flexisel({
										visibleItems: 5,
										animationSpeed: 1000,
										autoPlay: true,
										autoPlaySpeed: 3000,    		
										pauseOnHover: true,
										enableResponsiveBreakpoints: true,
										responsiveBreakpoints: { 
											portrait: { 
												changePoint:480,
												visibleItems: 2
											}, 
											landscape: { 
												changePoint:640,
												visibleItems: 3
											},
											tablet: { 
												changePoint:768,
												visibleItems: 3
											}
										}
									});
									
								});
								</script>
								<script type="text/javascript" src="js/jquery.flexisel.js"></script>
					<div class="clearfix"> </div>
			</div>
		</div>
	</div>	
	<!--slide-end-->
	<!--footer-starts-->
	<div class="footer">
		<div class="container">
			<div class="footer-text">
				<p>Projet Annuel ESGI 2016-2017</p>
			</div>
		</div>
	</div>
	<!--footer-end-->
</body>
</html>