<!DOCTYPE html>
<html>
<head>
<title>Cloud</title>
<?php echo $this->tag->javascriptInclude('js/jquery.min.js'); ?>
<?php echo $this->tag->javascriptInclude('js/bootstrap.min.js'); ?>
<?php echo $this->tag->javascriptInclude('js/script-cfb.js'); ?>


<?php echo $this->tag->stylesheetLink('css/bootstrap.min.css'); ?>
<?php echo $this->tag->stylesheetLink('css/styles.css'); ?>
<?php echo $this->tag->stylesheetLink('css/styles-cfb.css'); ?>
<?php echo $this->tag->stylesheetLink('css/styles-jfu.css'); ?>

</head>
<meta charset="UTF-8">
<body>
	<nav class="navbar navbar-default" id="mainNav">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#mainNav">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#" target="_self">Cloud</a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="collapse-mainNav">
				<ul class="nav navbar-nav navbar-nav">
					<li id='mainNav-navzone-1-li-1'><a id='mainNav-navzone-1-link-1'
						href="#">Créer un Disque</a></li>
					<li id='mainNav-navzone-1-li-2'><a id='mainNav-navzone-1-link-2'
						href="#">Mes disques</a></li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container-fluid -->
	</nav>
	<div class="bs-docs-header">
		<div class="container">
			<div class="header">
				<h1>Cloud</h1>
				<p>Online Storage and Backup for Small Businesses.</p>
				<div class="pull-right" id="divInfoUser"><?php echo $infoUser; ?></div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="second-header"></div>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php echo $q['breadcrumb']; ?>
				<div id="message"></div>
					<div id="content">
						<?php echo $this->getContent(); ?>
					</div>
			</div>
		</div>
	</div>
</body>
</html>
