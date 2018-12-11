<?php

include('includes/header.php');

?>

<div class="container">

	<header class="flex">
		<p class="mx-auto">Soli'bank</p>
	</header>

	<h1>Welcome on your bank application</h1>

	<form class="newAccount" action="../controllers/index.php" method="post">
		<label>Sélectionner un type de compte</label>
		<select class="" name="name" required>
			<option value="" disabled>Choisissez le type de compte à ouvrir</option>
			<?php 
				foreach(Account::nameList as $type)
				{
			?>
					<option value="<?= $type ?>"><?= $type ?></option>
			<?php
									
				}  
			?>
		</select>
		<input type="submit" name="new" value="Ouvrir un nouveau compte">
	</form>

	<?php
		/**
		 * Display error if there is one.
		 */
		if(isset($errors))
		{
	?>		
			<p class="text-center"><?= $errors ?></p>
	<?php
		}
	?>
	<hr>

	<div class="main-content flex">

	<!-- We generate this HTML for each Account in database -->

	<?php 
		foreach($accounts as $account)
		{
	?>

		<div class="card-container">

			<div class="card">
				<h3><strong><?= $account->getName(); ?></strong></h3>
				<div class="card-content">


					<p>Somme disponible : <?= $account->getBalance(); ?> €</p>

					<!-- Formulaire pour dépot/retrait -->
					<h4>Dépot / Retrait</h4>
					<form action="index.php" method="post">
						<input type="hidden" name="id" value=" <?= $account->getId();?>"  required>
						<label>Entrer une somme à débiter/créditer</label>
						<input type="number" name="balance" placeholder="Ex: 250" required>
						<input type="submit" name="payment" value="Créditer">
						<input type="submit" name="debit" value="Débiter">
					</form>


					<!-- Formulaire pour virement -->
			 		<form action="index.php" method="post">

						<h4>Transfert</h4>
						<label>Entrer une somme à transférer</label>
						<input type="number" name="balance" placeholder="Ex: 300"  required>
						<input type="hidden" name="idDebit" value="<?= $account->getId(); ?>" required>
						<label for="">Sélectionner un compte pour le virement</label>
						<select name="idPayment" required>
							<option value="" disabled>Choisir un compte</option>
							<?php
								/**
								 * For each $targableAccount from $accounts that isn't $accound from first loop, we create a new option.  
								 */ 
								foreach($accounts as $targableAccount)
								{
									if($account->getName() != $targableAccount->getName())
									{
							?>
										<option value="<?= $targableAccount->getId(); ?>"><?= $targableAccount->getName(); ?></option>	
							<?php		
									}
							?>
							<?php	
								} 
							?>
						</select>
						<input type="submit" name="transfer" value="Transférer l'argent">
					</form>

					<!-- Formulaire pour suppression -->
			 		<form class="delete" action="index.php" method="post">
				 		<input type="hidden" name="id" value="<?= $account->getId(); ?>"  required>
				 		<input type="submit" name="delete" value="Supprimer le compte">
			 		</form>

				</div>
			</div>
		</div>

	<?php 
		} 
	?>

	</div>

</div>

<?php

include('includes/footer.php');

 ?>
