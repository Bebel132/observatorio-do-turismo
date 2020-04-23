<?php 
if( isset($_SESSION['tentativas_dt']) ){
	$now = date('Y-m-d H:i:s');
	$wait  = date('Y-m-d H:i:s',strtotime($_SESSION['tentativas_dt'].'+ '.LOGIN_TENTATIVAS_WAIT));
	if($now > $wait){
		unset($_SESSION['tentativas_dt']);
		unset($_SESSION['tentativas_n']);
		$msg = 'Só um instante..';
		Utils::redirect('./admin',3);
	}else{
		$msg = '<i class="fas fa-ban"></i> <br> Você está temporariamente impedido de tentar novamente. <br>';
	}
}else{
	$msg = 'O que você faz por aqui?';
	Utils::redirect('./admin',3);
}
?>
<div class="pagelogin">
	<div class="box">
		<span class="text-danger">
			<?=$msg?>
		</span>
		<div class="text-warning" id="counter"></div>
	</div>
</div>

<script>
	var countDownDate = new Date("<?=$wait?>").getTime();
	var x = setInterval(function() {
		var now = new Date().getTime();
		var distance = countDownDate - now;
		var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
		var seconds = Math.floor((distance % (1000 * 60)) / 1000);
		if(minutes < 10){ minutes = '0'+minutes; }
		if(seconds < 10){ seconds = '0'+seconds; }
		document.getElementById("counter").innerHTML = minutes + ":" + seconds;
		if (distance < 0) {
			clearInterval(x);
			document.getElementById("counter").innerHTML = "Reloading..";
			showLoading();
			setTimeout(function(){
				window.location.href = window.location.href;
			}, 2000);
		}
	}, 1000);
</script>