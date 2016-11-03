//=====================================================================||
//               NOP Design JavaScript Shopping Cart                   ||
//                                                                     ||
// For more information on SmartSystems, or how NOPDesign can help you ||
// Please visit us on the WWW at http://www.nopdesign.com              ||
//                                                                     ||
// Javascript portions of this shopping cart software are available as ||
// freeware from NOP Design.  You must keep this comment unchanged in  ||
// your code.  For more information contact FreeCart@NopDesign.com.    ||
//                                                                     ||
// JavaScript Shop Module, V.4.4.0                                     ||
//=====================================================================||

function CheckForm( theform )
{
	var bMissingFields = false;
	var strFields = "";
	
	if( theform.b_first.value == '' ){
		bMissingFields = true;
		strFields += "     Commande : Prnom\n";
	}
	if( theform.b_last.value == '' ){
		bMissingFields = true;
		strFields += "     Commande : Nom\n";
	}
	if( theform.b_addr.value == '' ){
		bMissingFields = true;
		strFields += "     Commande : Adresse 1\n";
	}
	if( theform.b_city.value == '' ){
		bMissingFields = true;
		strFields += "     Commande : Ville\n";
	}
	if( theform.b_zip.value == '' ){
		bMissingFields = true;
		strFields += "     Commande : Code postal\n";
	}
	if( theform.b_email.value == '' ){
		bMissingFields = true;
		strFields += "     Commande : Email\n";
	}
		
	if( bMissingFields ) {
		alert( "Vous devez complter les champs suivants avant de continuer :\n" + strFields );
		return false;
	}
	
	return true;
}

//=====================================================================||
//               Vrifie les champs du formulaire Checkout             ||
//=====================================================================||

