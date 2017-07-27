<?php 

class Pager{
	
	var $TotalRegs;
	var $PageRegs 			= 10;
	var $ActualPage			= 1;
	var $Destiny    		= "ListBody";
	var $Process 			= "process.abm.php";
	var $PagerID;
	var $Fields;
	var $SearcherHTML;
	var $WrapperInputClass 	= "SearchInputWrapper Left";
	var $WrapperLabelClass 	= "SearchLabelWrapper Left";
	var $FieldsPerRow 		= 4;
	var $WrapperMargin 		= 5;
	var $WrapperWidth 		= 100;
	var $Where 				= "";

	public function __construct($TotalRegs, $ActualPage=1,$Destiny="ListBody"){
		$this->TotalRegs 	= $TotalRegs;
		if($ActualPage>=1)$this->ActualPage	= $ActualPage;
		$this->Destiny = $Destiny;
		$this->PagerID = "Pager".$this->Destiny;
	}

	public function SetTotalRegs($Total)
	{
		$this->TotalRegs = $Total;
	}

	public function GetPagerID()
	{
		return $this->PagerID;	
	}


	public function SetDestiny($Destiny)
	{
		$this->Destiny = $Destiny;	
	}

	public function SetProcess($Process)
	{
		$this->Process = $Process;	
	}
	
	public function SetPageRegs($Regs){
		$this->PageRegs = $Regs;
	}

	public function SetActualPage($Page){
		$this->ActualPage = $Page;
	}
	
	public function CalculatePages(){
		$TotalPages	= ceil($this->TotalRegs/$this->PageRegs);
		return $TotalPages;
	}
	
	public function CalculateRegFrom(){
		return (($this->ActualPage-1)*$this->PageRegs);
	}
	
	public function CalculateRegTo(){
		return ($this->ActualPage*$this->PageRegs)-1;
	}

	public function GetPageRegs()
	{
		return $this->PageRegs;
	}
	
	public function GetRange(){
		return $this->CalculateRegFrom().",".$this->PageRegs;
	}

	public function InsertAjaxPager($ActiveClass="NormalPage AlterRed ActivePage",$InactiveClass="NormalPage BlueCyan",$PagerClass="Pager"){
		$Pages 		= $this->CalculatePages();
		$Hidden 	= $Pages==1? " Hidden" : "";
		$LiHidden 	= $Pages==1? 'style="display:none;"' : "";
		$PageList = '<ul id="'.$this->PagerID.'" class="'.$PagerClass.$Hidden.'" totalpages="'.$Pages.'" process="'.$this->Process.'" destiny="'.$this->Destiny.'" activeclass="'.$ActiveClass.'" inactiveclass="'.$InactiveClass.'">';
		for ($i=1; $i<=$Pages; $i++)
		{
			if($i==$this->ActualPage)
			{
				$PageList .= '<li class="'.$ActiveClass.' ActivePageLink" '.$LiHidden.' id="page'.$i.'" page="'.$i.'">'.$i.'</li>';
			}else{
				$PageList .= '<li class="'.$InactiveClass.' ActivePageLink" id="page'.$i.'" page="'.$i.'">'.$i.'</li>';
			}
		}
		$PageList .= '</ul>';
		
		return $PageList;
	}
	
	
	public function InsertPostPager(){
		$Pages = $this->CalculatePages();
		if($Pages>=1){	
			$PageList = '<ul>';
			for ($i=1; $i<=$Pages; $i++){
				if($i==$this->ActualPage){
					$PageList .= '<li class="ActivePage">'.$i.'</li>';
				}else{
					$PageList .= '<li><a href="'.basename($_SERVER['PHP_SELF']).'?page='.$i.$this->GetQueryString().'">'.$i.'</a></li>';
				}
			}
			$PageList .= '</ul>';
		}
		echo $PageList;
	}
	
	public function InsertLinkBack(){
		
		if($this->ActualPage!=1){
			return basename($_SERVER['PHP_SELF']).'?page='.($this->ActualPage-1).$this->GetQueryString();
		}else{
			return "";
		}
	}
	
	public function InsertLinkFoward(){
		$Pags = $this->CalculatePages();
		if($this->ActualPage!=$Pags){
			
			return basename($_SERVER['PHP_SELF']).'?page='.($this->ActualPage+1).$this->GetQueryString();	
		
		}else{
			return "";
		}
	}
	
	public function GetQueryString(){
		$newString = "";
		$parametros = explode('&',$_SERVER['QUERY_STRING']);
		for($i=0;$i<count($parametros); $i++){
			$nombre_parametro = explode('=',$parametros[$i]);
			if(strtolower($nombre_parametro[0])!="page")$newString .=  "&".$parametros[$i];	
		}
		return $newString;
	}

	public function InsertBtnBackAjax($Text="",$ClassOn="BtnBackOn BlueCyan",$ClassOff="BtnBackOff Gray"){
		$Pages = $this->CalculatePages();
		$Hidden = $Pages=="1"?	" Hidden" : "";
		$Class = $this->ActualPage!=1 && $this->TotalRegs>0? $ClassOn : $ClassOff;
		return '<div id="BtnBack'.$this->PagerID.'" class="BtnBack '.$Class.$Hidden.'" page="'.(intval($this->ActualPage)-1).'" classon="'.$ClassOn.'" classoff="'.$ClassOff.'">'.$Text.'</div>';
		
	}

	public function InsertBtnFowardAjax($Text="",$ClassOn="BtnFowardOn BlueCyan",$ClassOff="BtnFowardOff Gray"){
		$Pages = $this->CalculatePages();
		$Hidden = $Pages=="1"?	" Hidden" : "";
		$Class = $this->ActualPage<$Pages && $this->TotalRegs>0? $ClassOn : $ClassOff;
		return '<div id="BtnFoward'.$this->PagerID.'" class="BtnFoward '.$Class.$Hidden.'" page="'.(intval($this->ActualPage)+1).'" classon="'.$ClassOn.'" classoff="'.$ClassOff.'">'.$Text.'</div>';
		
	}
	
	public function InsertBtnBack($BackOn,$BackOff){
		
		if($this->ActualPage!=1 && $this->TotalRegs>0){
			echo '<a href="'.$this->InsertLinkBack().'"><div class="DivPageBackOn triggerAnterior" style="background-image:url('.$BackOn.');"></div><div class="tipAnterior">Anterior</div></a>';
		}else{
			echo '<div class="DivPageBackOff" style="background-image:url('.$BackOff.');"></div>';
		}
	}
	
	public function InsertBtnFoward($FowardOn,$FowardOff){
		$Pags = $this->CalculatePages();
		if($this->ActualPage!=$Pags && $this->TotalRegs>0){
			echo '<a href="'.$this->InsertLinkFoward().'"><div class="DivPageFowardOn triggerSiguiente" style="background-image:url('.$FowardOn.');"></div><div class="tipSiguiente">Siguiente</div></a>';	
		}else{
			echo '<div class="DivPageFowardOff" style="background-image:url('.$FowardOff.');"></div>';
		}
	}

	public function InsertRegSelect($Class="SelectRegPager Arial12px BlueCyan Bold",$ParentClass=" ")
	{
		
		$Regs = array();
		$Regs['5']	 = "5";
		$Regs['10']	 = "10";
		$Regs['15']	 = "15";
		$Regs['25']	 = "25";
		$Regs['50']	 = "50";
		$Regs['100'] = "100";

		return '<div id="select'.$this->PagerID.'" class="'.$ParentClass.'">'.insertElement('select','regsperpage',$this->PageRegs,"RegsPerPage ".$Class,'parentid="'.$this->PagerID.'"',$Regs).'</div>';
		
	}

	public function SetWrapperInputClass($Class)
	{
		$this->$WrapperInputClass	= $Class;
	}

	public function SetWrapperLabelClass($Class)
	{
		$this->$WrapperLabelClass	= $Class;
	}

	public function SetFieldsPerRow($Fields)
	{
		$this->FieldsPerRow = $Fields;
	}

	public function SetWrapperMargin($Margin)
	{
		$this->WrapperMargin = $Margin;
	}

	public function SetWrapperWidth($Width)
	{
		$this->WrapperWidth = $Width;
	}

	public function SetFields($Fields)
	{
		if(is_array($Fields))
		{
			foreach($Fields as $ID => $Field)
			{
				if(!$Field['input']) 		$Field['input'] 	= 'text';
				if(!$Field['type']) 		$Field['type'] 		= 'string';
				if(!$Field['condition']) 	$Field['condition'] = '%';
				if(!$Field['label']) 		$Field['label'] 	= $ID;
				if(!$Field['class']) 		$Field['class'] 	= 'InputSearcher Arial12px BlueCyan Bold';

				$Fields[$ID]	= $Field;
			}

			$this->Fields = $Fields;
			$this->MakeFields();
		}else{
			return false;
		}
	}

	public function MakeFields()
	{

		$Fields 	= $this->Fields;		
		$SearcherHTML = "";
		if(count($Fields)>0)
		{
			$i=1;
			$SearcherHTML .= '<div pagerid="'.$this->PagerID.'" destiny="'.$this->Destiny.'" process="'.$this->Process.'">';			
			foreach($Fields as $ID => $Field)
			{
				$SearcherHTML .= '<div class="Left" style="width:'.$this->GetWidth().'%;">';
					$SearcherHTML .= '<div class="'.$this->WrapperLabelClass.'">';
						$SearcherHTML .= $Field['label'];
					$SearcherHTML .= '</div>';
					$SearcherHTML .= '<div class="'.$this->WrapperInputClass.'">';
						$SearcherHTML .= insertElement($Field['input'],$ID,$Field['value'],"StartSearch ".$Field['class'],$Field['extra'],$Field['query'],$Field['first_value'],$Field['first_text']);
					$SearcherHTML .= '</div>';
					$SearcherHTML .= '<div class="Clear"></div>';
				$SearcherHTML .= '</div>';
				$i++;
				if($i>$this->FieldsPerRow)
				{
					$SearcherHTML .= '<div class="Clear"></div>';
					$i=1;
				}
			}
			if($i<=$this->FieldsPerRow) $SearcherHTML .= '<div class="Clear"></div>';
			
			$SearcherHTML .= '</div>';
		}
		$this->SearcherHTML = $SearcherHTML;
		return $this->SearcherHTML;

	}

	public function SetFieldValue($ID,$Value)
	{
		$this->Fields[$ID]['value'] = $Value;
	}

	public function GetFields()
	{
		return $this->Fields;
	}

	public function GetHTML()
	{
		return $this->SearcherHTML;
	}

	public function GetWidth()
	{
		return ceil(($this->WrapperWidth-$this->GetWidthMargin())/$this->FieldsPerRow);
	}

	public function GetWidthMargin($Margin=5)
	{
		return (($this->WrapperMargin*100)/$this->WrapperWidth/$this->FieldsPerRow);
	}

	public function SetWhere($SearchFields="",$Table)
	{
		$this->Where	= " AND ".FilterByField($SearchFields,$Table);	
	}

	public function GetWhere()
	{
		return $this->Where;
	}
		
}
		
?>