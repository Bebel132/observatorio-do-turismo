<?php
User::getToken();
Utils::redirect('./admin',2);
?>
<div class="pagelogin">
	<div class="box">
		<div class="loading"> <i></i> </div>
		<span class="text-info"> <i class="fas fa-shield-alt"></i> Creating token...</span>
	</div>
</div>
<script>appLoaded();</script>