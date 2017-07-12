<?php
$iIdUser = $_SESSION['iduser'];
$User = new Tomekuser();
$arrUser = $User->get($iIdUser);
$strRole = $arrUser['role'];
if( isset($_POST['logout']) )
{
	session_destroy();
	header("Location: " . $GLOBALS['HOST'] . "login/n/");
	die();
}

if (isset($_POST['signin']) && !empty($_POST['letztesshotinge']) ) 
{
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$tmp_name=$_FILES["fileToUpload"]['tmp_name'];
$name = $_FILES["fileToUpload"]["name"];
$iRand=rand(1, 99);
$test2=move_uploaded_file($tmp_name, "$target_dir/$iRand$name");
$fo1="$target_dir$iRand$name";
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
$Model=new Modele();	
$iIdKundeNew=$Model->createModele($_POST['vorname'],$_POST['nachname'],$_POST['geburstag'],$_POST['strasse'],$_POST['ort'],$_POST['plz'],$_POST['telefon'],
$_POST['email'],$_POST['bereiche'],$_POST['kosten'],$_POST['letztesshotinge'],$_POST['grosse'],$_POST['gewicht'],$_POST['augen'],
$_POST['konfektion'],$_POST['brust'],$_POST['taille'],$_POST['bh'],$_POST['haare'],$_POST['hufte'],$_POST['sedcard'],
$_POST['bewertung'],$_POST['notizien'],$fo1,'fo2','fo3','fo4',$iIdUser);	
if(!empty($iIdKundeNew))
?>
<script>
alert("Neue Model is angelegt!");
</script>
								
<?php					
}

 
require("templates/_doctype.php");
require("templates/_navi.php");
?>
<h1>Neu Modele </h1>

<form action="" method="post" enctype="multipart/form-data">
  	<fieldset>
  		<legend>Persönliche Informationen</legend>
  		
  		<table>
  			<tr>
  				<td width="15" ><label>Vorname:</td><td width="15"><input type="vorname" name="vorname" value="" /></label></td>
  				<td width="15" > <label>Nachname:</td><td width="15"><input type="nachname" name="nachname" value="" /></label></td>
  			    <td width="15"><label>Geburstag:</td><td width="15">
  			    	<input type="text" name="geburstag" id="datum_zahlung" value="<?php echo($_POST['zahlungsdatum'])?>" />
  			    	
  		    </tr>
  			<tr>
  				<td width="15"><label>Strasse:</td><td width="15"><input type="strasse" name="strasse" value="" /></label></td>
  				<td width="15"><label>Ort:</td><td width="15"><input type="ort" name="ort" value="" /></label></td>
  				<td width="15"><label>PLZ:</td><td width="15"><input type="plz" name="plz" value="" /></label></td>
  			</tr>
  			<tr>
  			    <td width="15"><label>Telefon:</td><td width="15"><input type="telefon" name="telefon" placeholder="Telefon..." value="" /></label></td>
  			    <td width="15"><label>Email:</td><td width="15"><input type="email" name="email" value="" placeholder="Email..." /></label></td>
  			</tr>
  	    </table>
  		
  	</fieldset>
  	</br></br>
  	<fieldset>
  		<legend>Shoting Informationen</legend>
  		<table>
  			<tr>
  				<td width="15" ><label>Bereiche:</td><td width="15">
  <select name="bereiche">
  <option value="portrait">Portrait</option>
  <option value="akt">Akt</option>
  <option value="teilakt">Teilakt</option>
  <option value="fashion">Fashion</option>
  <option value="business">Business</option>
  <option value="event">Event</option>
  <option value="werbung">Werbung</option>
  </select>
  </label></td>
  				<td width="15" > <label>Kosten:</td><td width="15"><input type="kosten" name="kosten" value="" /></label></td>
  			    <td width="15"><label>Letztes Shoting:</td><td width="15">
  			    	<input type="text" name="letztesshotinge" id="datum_zahlung1" value="<?php echo($_POST['zahlungsdatum'])?>" />
  			    	
  			    </label></td>
  			</tr>
  	    </table>
  		
  	</fieldset>
  	</br></br>
  		<fieldset>
  		<legend>Model Informationen</legend>
  		<table>
  			<tr>
  			    <td width="15" ><label>Grosse:</td><td width="15"><input type="grosse" name="grosse" value="" /></label></td>
  				<td width="15" > <label>Konfektion:</td><td width="15">
  				 <select name="konfektion">
				  <option value="32=XS">32=XS</option>
				  <option value="34=XS">34=XS</option>
				  <option value="36=XS">36=XS</option>
				  <option value="38=S">38=S</option>
				  <option value="40=M">40=M</option>
				  <option value="42=M">42=M</option>
				  <option value="44=L">44=L</option>
				  <option value="64=L">64=L</option>
				  <option value="48=XL">48=XL</option>
				  <option value="50=XL">50=XL</option>
				  <option value="52=XXL">52=XXL</option>
				  <option value="54=XXL">54=XXL</option>
				  <option value="56=XXXL">56=XXXL</option>
				  <option value="58=XXXL">58=XXXL</option>
				  </select>
  				</td>
  			    <td width="15"><label>BH:</td><td width="15">
  			    	
  			      <select name="bh">
				  <option value="A-63-67">A-63-67</option>
				  <option value="A-68-72">A-68-72</option>
				  <option value="B-73-77">B-73-77</option>
				  <option value="C-78-82">C-78-82</option>
				  <option value="D-83-87">D-83-87</option>
				  <option value="E-88-92">E-88-92</option>
				  <option value="F-93-97">F-93-97</option>
				  <option value="H-103-107">H-103-107</option>
				  <option value="I-108-112L">I-108-112</option>
				  <option value="J-113-117">J-113-117</option>
				  <option value="K-118-122">K-118-122</option>
				  <option value="I-123-127">I-123-127</option>
				  </select>
  			    </td>
  			    <td width="15"><label>Schuhe:</td><td width="15">
  			    	<select name="schuhe">
				  <option value="35">35</option>
				  <option value="36">36</option>
				  <option value="37">37</option>
				  <option value="38">38</option>
				  <option value="39">39</option>
				  <option value="40">40</option>
				  <option value="41">41</option>
				  <option value="42">42</option>
				  <option value="43">43</option>
				  </select>
  			    	
  			    	</td>
  			</tr>
  			<tr>
  				<td width="15"><label>Gewicht:</td><td width="15"><input type="gewicht" name="gewicht" value="" /></label></td>
  				<td width="15"><label>Brust:</td><td width="15">
  					<select name="brust">
				  <option value="74-77">74-77</option>
				  <option value="78-81">78-81</option>
				  <option value="82-85">82-85</option>
				  <option value="86-89">86-89</option>
				  <option value="90-93">90-93</option>
				  <option value="94-97">94-97</option>
				  <option value="98-102">98-102</option>
				  <option value="103-107">103-107</option>
				  <option value="108-113">108-113</option>
				  
				  <option value="114-119">114-119</option>
				  <option value="120-125">120-125</option>
				  <option value="126-131">126-131</option>
				  <option value="132-137">132-137</option>
				  <option value="138-143">138-143</option>
				  </select>
  					</td>
  			    <td width="15"><label>Haare:</td><td width="15"><input type="haare" name="haare"  value="" /></label></td>
  			    <td width="15"><label>Sedcard:</td><td width="15"><input type="sedcard" name="sedcard" value=""  /></label></td>
  			
  			</tr>
  			<tr>
  				
  			    <td width="15"><label>Augen:</td><td width="15"><input type="augen" name="augen"  value="" /></label></td>
  			    <td width="15"><label>Taille:</td><td width="15">
  			    		<select name="taille">
				  <option value="60-62">60-62</option>
				  <option value="63-65">63-65</option>
				  <option value="66-69">66-69</option>
				  <option value="70-73">70-73</option>
				  <option value="74-77">74-77</option>
				  <option value="78-81">78-81</option>
				  <option value="82-85">82-85</option>
				  <option value="86-90">86-90</option>
				  <option value="91-95">91-95</option>
				  <option value="96-102">96-102</option>
				  <option value="103-108">103-108</option>
				  <option value="109-114">109-114</option>
				  <option value="115-121">115-121</option>
				  <option value="122-134">122-134</option>
				  </select>
  			    	</td>
  				<td width="15"><label>Hufte:</td>
  					<td width="15">
  				  <select name="hufte">
				  <option value="84-87">84-87</option>
				  <option value="88-91">88-91</option>
				  <option value="92-95">92-95</option>
				  <option value="96-98">96-98</option>
				  <option value="99-101">99-101</option>
				  <option value="102-104">102-104</option>
				  <option value="105-108">105-108</option>
				  <option value="109-112">109-112</option>
				  <option value="113-116">113-116</option>
				  <option value="117-121">117-121</option>
				  <option value="122-126">122-126</option>
				  <option value="127-132">127-132</option>
				  <option value="133-138">133-138</option>
				  <option value="193-144">193-144</option>
				  </select>
  						</td>
  			    <td width="15"><label>Bewertung:</td><td width="15">
  			    	<select name="bewertung">
				  <option value="Positiv">Positiv</option>
				  <option value="Negativ">Negativ</option>
				  <option value="*****">*****</option>
				  <option value="****">****</option>
				  <option value="***">***</option>
				  <option value="**">**</option>
				  <option value="*">*</option>
				 </select>
  			    	
  			    	
  			    	</td>
  			
  			</tr>
  	    </table>
  	</fieldset>
  	<fieldset>
  		<legend> Notizien</legend>
  		<table>
  			
  			<tr>
  				
  			    <td ><textarea type="notizien" name="notizien" value="" placeholder="Notizien..." rows="8" cols="120">
</textarea></td>
<td>
	<input type="file" name="fileToUpload" id="fileToUpload">
</td>
  			  
  			</tr>
  			<tr><td align="center"><input type="submit" name="signin" value="ModelErstellen" /></td></tr>
  	    </table>
  	
  			
  		
  	</fieldset>
  </form>
<?php
require("templates/_footerjs.php");
?>



<script type="text/javascript" language="JavaScript">
$.datepicker.setDefaults( $.datepicker.regional[ "de" ] );
$('input#datum_zahlung').datepicker();
$('input#datum_zahlung1').datepicker();
$(document).ready(function() {
	$("#rechjanein").change(function() {
		$(".recheinblenden").toggle();
	 });
});
</script>

