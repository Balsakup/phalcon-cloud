	<div class="well well-lg">
		<div id="main">
			<fieldset>
				<legend>Interface provisoire de test</legend>
				<a class="btn btn-link" href="Index" data-ajax="Index">Accueil</a>
				<a class="btn btn-default" href="Users" data-ajax="Users">Utilisateurs</a>
				<a class="btn btn-default" href="Services" data-ajax="Services">Services</a>
				<a class="btn btn-default" href="Disques" data-ajax="Disques">Disques</a>
				<a class="btn btn-default" href="Tarifs" data-ajax="Tarifs">Tarifs</a>
				<a class="btn btn-default" href="Historiques" data-ajax="Historiques">Historiques</a>
			</fieldset>
			<fieldset>
				<legend>A implémenter (avec connexion nécessaire)</legend>
				<?php echo $q['btMyDisques']; ?>
				<?php echo $q['btScanOne']; ?>
				<?php echo $q['btCreateOne']; ?>
			</fieldset>
		</div>
		<div id="response"></div>
	</div>
	<?php echo $script_foot; ?>