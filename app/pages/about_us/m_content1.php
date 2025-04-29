<br><br><br><br><br>
<div class="pt-5 pb-5">
<?php                                                                                                                                                                        
$content_info = [                                                                                                                                                            
	'id' => '',                                                                                                                                                          
	'header' => $_SESSION['phrases']['about-company'],                                                                                                                
	'classes' => 'justify-content-center text-center',                                                                                                                   
	'contents' => [                                                                                                                                                      
		[                                                                                                                                                            
			'type' => 'text', # text or function                                                                                                                 
			'classes' => 'text-center col-md-10',                                                                                                                
			'content' => $_SESSION['phrases']['services-paragraph'],                                                                                             
			'function_name' => '',                                                                                                                               
			'arguments' => []                                                                                                                                    
		],                                                                                                                                                           
	]                                                                                                                                                                    
];                                                                                                                                                                           
content($content_info);                                                                                                                                                      
?>
</div>
