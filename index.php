<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

$this->setFrameMode(true);
?>
<link rel="stylesheet" href="/css/style.css">

<?
if($_POST["OK_PLUS"]) {
	CModule::IncludeModule('iblock'); 
	$ELEMENT_ID = $_POST['ELEM_ID'];  
	$PROPERTY_CODE = "VOUTES_PLUS";  
	$PROPERTY_VALUE = $_POST["PLUSES_NUM"];  
	CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
	echo "<script>alert('Ваш голос добавлен!')</script>";
};

if($_POST["OK_MINUS"]) {
	CModule::IncludeModule('iblock'); 
	$ELEMENT_ID = $_POST['ELEM_ID'];  
	$PROPERTY_CODE = "VOUTES_MINUS";  
	$PROPERTY_VALUE = $_POST["MINUSES_NUM"];  
	CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
	echo "<script>alert('Ваш голос добавлен!')</script>";
};

?>


 <div class="all-list">
        <?php
		
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PREVIEW_PICTURE","DATE_ACTIVE_FROM","PROPERTY_*");//
		$arFilter = Array("IBLOCK_ID"=>"7", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		
		$count_printed = 0;

while($ob = $res->GetNextElement()){ 
	$fields = $ob->GetFields();
	$count_printed++ ;
?>
	 <div class="list-item"> <?
	 
	 $arProps = $ob->GetProperties();
	if ($fields['PREVIEW_PICTURE']) { 
		?>
		<div style="background-image: url('<? CFile::GetPath($fields['PREVIEW_PICTURE']) ?>');">
		</div>
		<?
	};
		
	?> 
	<div class="elem" style="<? if ($count_printed > 10) {?>display:none<? } ?>"> 
		<div class="description">
	<?
		if ($fields['NAME']) echo "<h5>".$fields['NAME']."</h5>";
		echo "<br>";
		if ($arProps["SHORT"]["VALUE"]) echo $arProps["SHORT"]["VALUE"];
		?>
		</div>
		<div class="votes">
		<form action="" method="post" enctype="multipart/form-data" style="display: inline-block;">
			<div class="minus"> 
				<input type="hidden" name="ELEM_ID" value="<? echo $fields['ID']; ?>">
				<input type="hidden" name="MINUSES_NUM" value="<? if ($arProps["VOUTES_MINUS"]["VALUE"] > 0 ) echo ((int)$arProps["VOUTES_MINUS"]["VALUE"] - 1); else echo '0'; ?>">
				<input type="submit" value="-" name="OK_MINUS"> 
			</div>
		</form>
			<div class="minus-num"> <? if ($arProps["VOUTES_MINUS"]["VALUE"]) echo $arProps["VOUTES_MINUS"]["VALUE"]; ?> </div>
			<div class="plus-num"> <? if ($arProps["VOUTES_PLUS"]["VALUE"]) echo $arProps["VOUTES_PLUS"]["VALUE"]; ?> </div>
		<form action="" method="post" enctype="multipart/form-data" style="display: inline-block; ">
			<div class="plus"> 
				<input type="hidden" name="ELEM_ID" value="<? echo $fields['ID']; ?>">
				<input type="hidden" name="PLUSES_NUM" value="<? echo ((int)$arProps["VOUTES_PLUS"]["VALUE"] + 1); ?>">
				<input type="submit" value="+" name="OK_PLUS">
			</div>
		</form>
		</div>
	</div> 

	</div>
	<?
} ?>
		
 
 
</div>
<input id="show_more" type="button" value="Показать еще" >
    
 <script src="/js/script.js"></script>
