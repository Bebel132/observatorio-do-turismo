<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require_once __DIR__."/../libs/PHPMailer/vendor/autoload.php";

// Instantiation and passing `true` enables exceptions
/**
 * Mailler from PHPMailer
 */
class Mailer
{

	var $mail;
	var $layout;
	
	function __construct()
	{

		$mail = new PHPMailer();

		$mail->SMTPAuth = false;
		$mail->Host = SMTP_HOST;
		$mail->Port = SMTP_PORT; 

		$mail->IsHTML(true); 

		$mail->Subject = "Subject";
		$mail->Body = "Body";

		$this->mail = $mail;

		$layout = null;

	}

	public function smtp($username=null, $password=null) 
	{
		$this->mail->IsSMTP(); 
		// $this->mail->SMTPSecure = 'tls';
		$this->mail->SMTPAutoTLS = false; 
		$this->mail->SMTPAuth = true; 
		$this->mail->Username = ($username)?$username:'sistema@'.$_SERVER['HTTP_HOST'];
		$this->mail->Password = ($password)?$password:'123456789'; 
	}

	public function isEmail($email) {

		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';

		if (preg_match($regex, $email))
			return true;
		else
			return false;
	}

	public function setLayout($layout){
		$this->layout = $this->to_utf8($layout);
	}

	public function setDe($email,$nome = null)
	{
		if($nome) $nome = $this->to_iso8859($nome);
		$this->mail->From = $email; 
		$this->mail->FromName = ($nome)?$nome:$email;
	}

	public function addEmail($func,$email,$nome = null)
	{

		if($nome) $nome = $this->to_iso8859($nome);

		if(is_array($email))
			$emails = $email;
		else
			$emails = explode(',', $email);

		if(count($emails)>1){
			foreach ($emails as $email => $email2) {

				if(is_numeric($email)){
					$this->mail->{$func}($email2);
				}else{
					$this->mail->{$func}($email,$email2);
				}

			}
		}else{
			if($nome)
				$this->mail->{$func}($emails[0], $nome);
			else
				$this->mail->{$func}($emails[0]);
		}

	}

	public function addPara($email,$nome = null)
	{
		$this->addEmail('AddAddress',$email,$nome);
	}

	public function addReplyTo($email,$nome = null)
	{
		$this->addEmail('addReplyTo',$email,$nome);
	}

	public function addCC($email,$nome = null)
	{
		$this->addEmail('AddCC',$email,$nome);
	}

	public function addBCC($email,$nome = null)
	{
		$this->addEmail('AddBCC',$email,$nome);
	}

	public function clearEmails()
	{
		$this->mail->ClearAllRecipients();
	}

	public function addFile($fileuri,$filename=null)
	{

		if(is_array($fileuri) && isset($fileuri['tmp_name']) && isset($fileuri['name']) ){
			$fileuri = $fileuri['tmp_name'];
			$filename = $fileuri['name'];
		}

		if($filename)
			$this->mail->AddAttachment($fileuri, $filename);
		else
			$this->mail->AddAttachment($fileuri);

	}

	public function addMidia($pathfile)
	{
		$Mailer->addFile($pathfile);
	}

	public function clearFiles()
	{
		$this->mail->ClearAttachments();
	}

	
	public function setSubject($subject)
	{
		$this->mail->Subject = $this->to_iso8859($subject);
	}

	public function to_iso8859($string)
	{
		if(Utils::utf8_detect($string))
			$string = Utils::utf8_decode($string);
		return $string;
	}

	public function to_utf8($string)
	{
		if(!Utils::utf8_detect($string))
			$string = Utils::utf8_encode($string);
		return $string;
	}

	public function arrayToTable($arr)
	{

		if(!is_array($arr) && !is_object($arr)){
			return $arr;
		}else{

			$bgcolor = '#FFFFFF';
			$temp = '<table style="width:100%;border:1px solid #CCC;color:#666">';

			foreach ($arr as $k => $v) {

				$bgcolor = ($bgcolor=='#FFFFFF')?'#F9F9F9':'#FFFFFF';

				$temp .= '<tr>';
				$temp .= '<td bgcolor="'.$bgcolor.'">'.$k.': </td>';
				if(is_array($v) || is_object($v)){
					$temp .= '<td bgcolor="'.$bgcolor.'">';
					$temp .= $this->arrayToTable($v);
					$temp .= '</td>';
				}else{
					$temp .= '<td bgcolor="'.$bgcolor.'">'.$v.'</td>';
				}
				$temp .= '</tr>';
			}
			$temp .= '</table>';
		}

		return $temp;

	}


	public function setBody($Body)
	{

		$Body = $this->arrayToTable($Body);

		if($this->layout){
			$msgHtml = $this->layout;
			$msgHtml = str_replace('{MENSAGEM}', $Body, $msgHtml);
		}else{
			$msgHtml = $Body;
		}

		$msgHtml = $this->to_iso8859($msgHtml);

		$this->mail->Body = $msgHtml;
	}

	public function send()
	{
		return $this->mail->send();
	}

}