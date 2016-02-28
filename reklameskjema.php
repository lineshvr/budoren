<html lang="no">
<head>
 <title>Kontaktskjema | BUDOREN.NO</title>
			<meta charset="utf-8">
			<script type="text/javascript" src="js/loginvalidation.js"></script>

</head>
<body>
    <br />
  <p>&nbsp;</p>
<h1>Kontaktskjema</h1>
<p>&nbsp;</p>
<p>&nbsp;</p>
Navn og adresse
<p>&nbsp;</p>
<table style="width: 100%">
	<tr>
		<td class="auto-style1" style="width: 307px">Fornavn
		<span class="auto-style2"><span lang="no-bok">*</span></span></td>
		<td style="width: 14px">&nbsp;</td>
		<td>
		<form method="post">
			<input name="Text1" type="text" /></form>
		</td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 307px">Etternavn
		<span class="auto-style2">*</span></td>
		<td style="width: 14px">&nbsp;</td>
		<td>
		<form method="post">
			<input name="Text2" type="text" /></form>
		</td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 307px">E-post
		<span class="auto-style2">*</span></td>
		<td style="width: 14px">&nbsp;</td>
		<td>

			<input name="Text3" type="text" />
		</td>
	</tr>
	<tr>
		<td class="auto-style1" colspan="3">
		<hr style="width: 67%" class="auto-style2"></td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 307px">
		<h4><br />
		<br />
		</h4>
		<h4><br />
		Min henvendelse</h4>
		</td>
		<td style="width: 14px">
		<h4></h4>
		</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 307px">Saken gjelder <span>*</span></td>
		<td style="width: 14px">&nbsp;</td>
		<td>
		<form method="post">
			<textarea name="TextArea1" style="width: 548px; height: 210px"></textarea></form>
		</td>
	</tr>
	<tr>
		<td class="auto-style1" style="width: 307px">&nbsp;</td>
		<td style="width: 14px">&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
	<h1>Reklamasjonsskjema</h1>
	
	<form id="reklSkjema" action="" class="form" method="post">
		<fieldset id="prodOppl">
		<legend>Produktopplysninger</legend>
		<label for="WebProduct">Produkttype/smak <span>*</span></label><input id="WebProduct" autocomplete="off" class="ac_input" name="WebProduct" type="text"><br>
		<label for="ProductionSite">Meierinummer <span>*</span></label>
		<img id="ProductionSiteInfo" alt="Hjelp" class="infoButton infoButtonShow" src="http://www.tine.no/binary?id=168386"><br>
		<label for="HoldbarhetDato">Holdbarhetsdato <span>*</span></label><input id="HoldbarhetDato" name="HoldbarhetDato" type="text"><br>
		<label for="ProductionCode">Produksjonskode <span>*</span></label><input id="ProductionCode" class="required1" name="ProductionCode" type="text"><br>
		<label for="Emballasje">Pakningstørrelse</label><input id="Emballasje" name="Emballasje" type="text"><br>
		<label for="PurchaseLocation">Kjøpested</label><input id="PurchaseLocation" name="PurchaseLocation" type="text"><br>
		<label for="BankAccount">Kontonummer <span>*</span></label><input id="BankAccount" class="text" name="BankAccount" type="text"><br>
		<label for="Body">Beskrivelse <span>*</span></label><textarea id="Body" cols="20" name="Body" rows="1"></textarea></fieldset>
		<fieldset id="personOppl">
		<legend>Navn og adresse</legend>
		<label for="PersonFirstName">Fornavn <span>*</span></label><input id="PersonFirstName" class="text" name="PersonFirstName" type="text"><br>
		<label for="PersonLastName">Etternavn <span>*</span></label><input id="PersonLastName" class="text" name="PersonLastName" type="text"><br>
		<label for="CompanyStreetAddress">Adresse <span>*</span></label><input id="CompanyStreetAddress" class="text" name="CompanyStreetAddress" type="text"><br>
		<label for="CompanyPostalCode">Postnummer <span>*</span></label><input id="CompanyPostalCode" class="text" name="CompanyPostalCode" type="text"><br>
		<label for="CompanyRegion">Poststed <span>*</span></label><input id="CompanyRegion" class="text" name="CompanyRegion" type="text"><br>
		<label for="MailAddress">E-postadresse <span>*</span></label><input id="MailAddress" class="text" name="MailAddress" type="text"></fieldset></form>
</body>

</html>
