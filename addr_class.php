<?php

class addr_class {

# Parses one-field street addresses in one go

$types = '(?:av|aly|arc|avda|ave|blf|bd|bnd|bch|bl|blfs|br|brk|byp|blvd|byu|'
.'clb|clf|clfs|cm|cmn|cor|cres|crk|crst|ctr|cyn|cswy|cmns|crse|cv|cir|ct|cts|'
.'curv|dl|dr|drs|dv|est|ests|ext|expy|fld|fls|flt|frk|frg|fry|frst|fwy|gdn|'
.'grn|gdns|grns|gln|grv|gtwy|hbr|hl|hls|hwy|holw|hts|hvn|inlt|is|isle|jct|knl|'
.'knls|land|ldg|lgts|lf|lk|lks|ln|lndg|loop|mall|mews|mdw|mdwd|mdws|ml|mls|'
.'mnr|mtn|opas|orch|oval|park|pkwy|pass|pl|pike|path|pt|pln|plz|pne|pnes|prt|'
.'psge|pts|radl|rd|rdg|riv|rnch|row|rst|rte|rue|run|sq|spg|spgs|spur|shr|'
.'shrs|skwy|smt|st|sta|strm|stra|trl|ter|tpke|trce|trfy|trwy|vw|vis|vlg|vly|'
.'wls|walk|way|xing|xrd)';

//streetaddr patterns
public function __construct(){

	$this->p1 = "%\d+ $types \w$%i";  //300 AVE D
	  
	$this->p2 = "%\d+ \w+ $types \w$%i"; //714 N AVE O

	$this->p3 = "%\d+ $types [A-Z] (?:APT|UNIT|#) (?:\w+|\d+)%i"; //1507 AVE S APT 206

	$this->p4 = "%\d+ [A-Z]+ $types$%i"; //101 SE ST

	$this->p5 = "%\d+ [A-Z]+ $types \w+$%i" ; // 1234 E ST NW

	$this->p6 = "%\d+ [A-Z]+ [A-Z] $types$%i"; // 1430 N N ST

	$this->p7 = "%\d+ [A-Z] $types (?:APT|UNIT|#) (?:\w+|\d+)%i";  // 1234 E ST APT 201
	  
	$this->p8 = "%\d+ [A-Z] $types $types$%i"; //139 W WAY DR  
	    
	$this->p9 = "%\d+ [A-Z]+ $types [A-Z]+ (?:APT|UNIT|TRLR|#) (?:\w+|\d+)%i"; //513 E AVE E APT 2 and 513 NE AVE SW # 2 or 1648 E AVE SE # B
	  
	$this->p10 = "%\d+ [A-Z]+ $types (?:APT|UNIT|TRLR|#) (?:\w+|\d+)%i";  // 835 E AVE APT F
	    
	$this->p11 = "%\d+ [1/2] [A-Z]+ $types $types%i";  // 1518 1/2 E BLVD AVE
 }
  
function addrswitch ($streetaddr) {
    $debug = TRUE;
  
	if (preg_match($this->p1,$streetaddr)) {
	  $str = explode(' ',$streetaddr);
	  //300 AVE D
	  $row['num'] = $str[0];
	  $row['predir']= '';
	  $row['streetname'] = $str[1].' '.$str[2];
	  $row['streettype'] = '';
	  $row['postdir'] = '';
	  $row['suitetype'] = '';
	  $row['suiteno']= '';
	  
	  if ($debug === TRUE) {
	    echo 'p1'."\n";
	  }
	  
	  return $row;
	} 

	if (preg_match($this->p2,$streetaddr)) {
	  $str = explode(' ',$streetaddr);
	  //714 N AVE O
	  $row['num'] = $str[0];
	  $row['predir']= $str[1];
	  $row['streetname'] = $str[2].' '.$str[3];
	  $row['streettype'] = '';
	  $row['postdir'] = '';
	  $row['suitetype'] = '';
	  $row['suiteno']= '';
	  
	  if ($debug === TRUE) {
	    echo 'p2'."\n";
	  }
	  
	  return $row;
	}

	//
	if (preg_match($this->p3,$streetaddr)){
	  $str = explode(' ',$streetaddr);
	  //1507 AVE S APT 206
	  $row['num'] = $str[0];
	  $row['predir']= '';
	  $row['streetname'] = $str[1].' '.$str[2];
	  $row['streettype'] = '';
	  $row['postdir'] = '';
	  $row['suitetype'] = $str[3];
	  $row['suiteno']= $str[4];
	 
	  if ($debug === TRUE) {
	    echo 'p3'."\n";
	  }
	  
	  return $row;
	}

	if (preg_match($this->p4,$streetaddr)){
	  $str = explode(' ',$streetaddr); 
	  //101 SE ST
	  $row['num'] = $str[0];
	  $row['predir']= '';
	  $row['streetname'] = $str[1];
	  $row['streettype'] = $str[2];
	  $row['postdir'] = '';
	  $row['suitetype'] = '';
	  $row['suiteno']= '';
	  
	  if ($debug === TRUE) {
	    echo 'p4'."\n";
	  }
	  
	  return $row;
	}
	if (preg_match($this->p5,$streetaddr)){
	  $str = explode(' ',$streetaddr);
	  //1234 E ST NW
	  $row['num'] = $str[0];
	  $row['predir']= '';
	  $row['streetname'] = $str[1];
	  $row['streettype'] = $str[2];
	  $row['postdir'] = $str[3];
	  $row['suitetype'] = '';
	  $row['suiteno']= '';
	  
	  if ($debug === TRUE) {
	    echo 'p5'."\n";
	  }
	  
	  return $row;
	  
	}

	if (preg_match($this->p6,$streetaddr)) {
	  $str = explode(' ',$streetaddr);
	  //1430 N N ST
	  $row['num'] = $str[0];
	  $row['predir']= $str[1];
	  $row['streetname'] = $str[2];
	  $row['streettype'] = $str[3];
	  $row['postdir'] = '';
	  $row['suitetype'] = '';
	  $row['suiteno']= '';
	  
	  if ($debug === TRUE) {
	    echo 'p6'."\n";
	  }
	  return $row;
	}

	if (preg_match($this->p7,$streetaddr)) {
	  $str = explode(' ',$streetaddr);
	  //1507 E ST APT 206
	  $row['num'] = $str[0];
	  $row['predir']= '';
	  $row['streetname'] = $str[1];
	  $row['streettype'] = $str[2];
	  $row['postdir'] = '';
	  $row['suitetype'] = $str[3];
	  $row['suiteno']= $str[4];
	  
	  if ($debug === TRUE) {
	    echo 'p7'."\n";
	  }
	  
	  return $row;
	} // end

	if (preg_match($this->p8,$streetaddr)) {
	  $str = explode(' ',$streetaddr);
	  //139 W WAY DR
	  $row['num'] = $str[0];
	  $row['predir']= $str[1];
	  $row['streetname'] =  $str[2] ;
	  $row['streettype'] = $str[3];
	  $row['postdir'] = '';
	  $row['suitetype'] = '';
	  $row['suiteno']= '';
	   
	  if ($debug === TRUE) {
	    echo 'p8'."\n";
	  }
	  return $row;
	}

	if (preg_match($this->p9,$streetaddr)) {
	  $str = explode(' ',$streetaddr);
	  //513 E AVE E APT 2 and 513 NE AVE SW # 2 
	  $row['num'] = $str[0];
	  $row['predir']= $str[1];
	  $row['streetname'] =  $str[2].' '.$str[3] ;
	  $row['streettype'] = '';
	  $row['postdir'] = '';
	  $row['suitetype'] = $str[4];
	  $row['suiteno']= $str[5];
	 
	  if ($debug === TRUE) {
	    echo 'p9'."\n";
	  }
	  
	  return $row;
	}
	if (preg_match($this->p10,$streetaddr)) {
	  $str = explode(' ',$streetaddr);
	  // 835 E AVE APT F
	  $row['num'] = $str[0];
	  $row['predir']= '';
	  $row['streetname'] =  $str[1];
	  $row['streettype'] = $str[2];
	  $row['postdir'] = '';
	  $row['suitetype'] = $str[3];
	  $row['suiteno']= $str[4];
	 
	  if ($debug === TRUE) {
	    echo 'p10'."\n";
	  }
	  
	  return $row;
	}
	if (preg_match($this->p11,$streetaddr)) {
	  $str = explode(' ',$streetaddr);
	  // 1518 1/2 E BLVD AVE
	  $row['num'] = $str[0].' '.$str[1];
	  $row['predir']= $str[2];
	  $row['streetname'] =  $str[3];
	  $row['streettype'] = $str[4];
	  $row['postdir'] = '';
	  $row['suitetype'] = '';
	  $row['suiteno']= '';
	 
	  if ($debug === TRUE) {
	    echo 'p11'."\n";
	  }
	  
	  return $row;
	}
}
 
}
?>