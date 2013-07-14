<?php include('./header.php'); ?>
	<body>
		<div id="container" class="container">
                  <div class="menu-panel">
		    <h3>Table of Contents</h3>
		       <ul id="menu-toc" class="menu-toc">
			<li class="menu-toc-current"><a href="#item1">Welcome</a></li>
			<li><a href="#item2">Find Things Around!</a></li>
			<li><a href="#item3">Emergency Numbers!</a></li>
			<li><a href="#item4">Hot? or Not?</a></li>
                        <li><a href="#item5">Facebook</a></li>
                       </ul>
			<div><a href="#">Hack by Super Sonic</a></div>
			</div>

			<div class="bb-custom-wrapper">
				<div id="bb-bookblock" class="bb-bookblock">
					<?php include('./content-first.php'); ?>
					<?php include('./content-third.php'); ?>
                                        <?php include('./content-fifth.php'); ?>
					<?php include('./content-fourth.php'); ?>
					<?php include('./facebook.php'); ?>
				</div>

				<nav>
					<span id="bb-nav-prev">&larr;</span>
					<span id="bb-nav-next">&rarr;</span>
				</nav>

				<span id="tblcontents" class="menu-button">Table of Contents</span>

			</div>

		</div><!-- /container -->
<?php include('footer.php'); ?>
