<?php defined('YV_LiteShop') or die ('Restricted Access!'); 

// Admin Pagination layout


// build array containing links to all pages
$tmp = [];
for($p=1, $i=0; $i < $num_results; $p++, $i += $NUMPERPAGE) {
  if($page == $p) {
    // current page shown as bold, no link
    $tmp[] = [
    	'is_active'=>true,
    	'content' => '
	    	<li class="page-item active">
		      <a class="page-link" href="#">
		        <b>'.$p.'</b>
		      </a>
		    </li>'
    ];		    
  } else {	
  	$linkextra_1 = $linkextra;

  	if ($p === 1 ) {    	
    	$lEnd_1 = '';
    	$linkextra_1 = substr($linkextra_1, 0, strlen($linkextra_1)-5);
    } else {
    	$lEnd_1 = "page_num=" . $p;    	
    }	  

    $tmp[]=[
    	'is_active' => false,
    	'content' => '
	    	<li class="page-item">
	        <a class="page-link" href="'.$this_page.'?'.$linkextra_1.$lEnd_1.'">'.$p.'</a>
	      </li>'
    ];

  }
}

// сокращаем кол-во ссылок (optional)
for($i = count($tmp) - 3; $i > 1; $i--) {
  if(abs($page - $i - 1) > 2) {
    unset($tmp[$i]);
  }
}


// показываем навигацию по страницам, если данные покрывают более чем 1 стр
if(count($tmp) > 1) {
  $html .= '
  <div class="card-footer py-4">
   	<nav aria-label="...">
     	<ul class="pagination justify-content-end mb-0">';



  if($page > 1) {
    // display 'Prev' link
     if (($page - 1) === 1 ) {    	
    	$lEnd = '';
    	$linkextra = substr($linkextra, 0, strlen($linkextra)-5);
    } else {
    	$lEnd = "page_num=" . ($page - 1);    	
    }
    $html .= '
    <li class="page-item">
      <a class="page-link" href="'.$this_page.'?'.$linkextra.$lEnd.'" tabindex="-1">
        <i class="fas fa-angle-left"></i>        
      </a>
    </li>';     
  } 

  $lastlink = 0;
  foreach($tmp as $i => $link) {  	
    if($i > $lastlink + 1) {
    	// where one or more links have been omitted
      $html .= '<li class="page-item"><a class="page-link" href="#"> ... </a></li>';
    }
    $html .= $link['content'];
    $lastlink = $i;
  }

  if($page <= $lastlink) {
    // display 'Next' link
    $html .= '
    <li class="page-item">
      <a class="page-link" href="'.$this_page.'?'.$linkextra.'page_num='.($page + 1).'">
        <i class="fas fa-angle-right"></i>        
      </a>
    </li>';
  }


  $html .= 
			'</ul>
	  </nav>
	</div>';
}



?>