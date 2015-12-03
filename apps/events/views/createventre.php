<p>result</p>
<?php 
if ( isset($_POST['nom']) and isset($_POST['mail']) and isset($_POST['theme'])
			and isset($_POST['type']) and isset($_POST['date_de']) and isset($_POST['time_de'])
		and isset($_POST['date_fi']) and isset($_POST['time_fi']) and isset($_POST['nbpl']) and isset($_POST['price'])
		and isset($_POST['mclef']) and isset($_POST['priv']) and isset($_POST['gpadm']) and isset($_POST['padm']) and isset($_POST['telorg'])
		and isset($_POST['blist']) and isset($_POST['norg']) and isset($_POST['nentr']) and isset($_POST['partn']) and isset($_POST['weborg'])
		and isset($_POST['reg']) and isset($_POST['adr']) and isset($_POST['code_p']) and isset($_POST['ville']) and isset($_POST['pays'])	
		and isset($_POST['descript']) and isset($_POST['bann']) and isset($_POST['comm']) and isset($_POST['nott']) and isset($_POST['sujet'])
		and isset($_POST['condi']))
		{
			
			echo('Evenement Créé');
		}
		else{
			echo('Erreur de Merde !');
		}
		?>