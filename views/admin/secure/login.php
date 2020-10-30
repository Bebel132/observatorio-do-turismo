<div class="pagelogin">
	<div class="box">
		<span class="logo">
			<?php FrontEnd::resource('logo.svg'); ?>
		</span>
		<form method="post">
			<div class="form-group">

				<?php 
				Log::set('ip',$_SERVER['REMOTE_ADDR']);
				$showform = true;
				$username = '';
				if(count($_POST)>0 && isset($_POST['username']) && isset($_POST['password'])){
					$username = $_POST['username'];
					if(User::singon($_POST['username'],$_POST['password'],$_POST['token'])){
						FrontEnd::alert('Sucesso! Redirecionando..','success',false);
<<<<<<< HEAD
						// FrontEnd::alert('Sincronizando. Isso pode demorar um pouco. Aguarde!','warning',false);
						delSession('ni_f2040_total');
						delSession('ni_memoria');
						Utils::redirect('./',1);
=======
						Utils::redirect(FrontEnd::raiz().'admin',1);
>>>>>>> release/v1.2
						$showform = false;
					}else{
						foreach (User::$error as $erro) {
							FrontEnd::alert($erro,'danger');
						}
					}
				}

				$tentativas = isset($_SESSION['tentativas_n'])?$_SESSION['tentativas_n']:false;
				$token = User::getToken();

				if($showform){
					?>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-user"></i></div>
						</div>
						<input type="text" class="form-control form-control-sm" placeholder="Username" name="username" value="<?=$username?>" required>
					</div>

					<div class="input-group mb-2">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-key"></i></div>
						</div>
						<input type="password" class="form-control form-control-sm" placeholder="Senha" name="password" required>
					</div>

					<button class="btn btn-info btn-sm form-control">ENTRAR</button>

				<?php } ?>

			</div>

			<span class="text-success">
				<i class="fas fa-shield-alt"></i> Token active
			</span>

			<?php if($tentativas){ ?>
				<div class="text-danger">
					<?=$tentativas?> tentativas restantes
				</div>
			<?php } ?>

			<input type="hidden" name="token" value="<?=$token?>">
		</form>
	</div>

<<<<<<< HEAD
</div>
=======
</div>
>>>>>>> release/v1.2
