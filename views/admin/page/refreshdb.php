<?php 

if(APPLICATION_ENV=='production'){
	// DatabaseSi::create();
}else{
	DatabaseSi::recreate();
}