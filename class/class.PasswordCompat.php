<?php 


/**
* Password Compat : PHP 5.5
*/
class PasswordCompat
{
	
	function __construct()
	{

		if (!defined('PASSWORD_BCRYPT')) {
           define('PASSWORD_BCRYPT', 1);
           define('PASSWORD_DEFAULT', PASSWORD_BCRYPT);
           define('PASSWORD_BCRYPT_DEFAULT_COST', 10);
       }

       if(self::Binary_check()){
       }else{
         echo "<div style='padding:10px; text-align:center; color:#FFF; background:#F00'>:: PassowdCompat not suported ::</div>";
     }
 }


 static function password_hash($password, $algo = PASSWORD_DEFAULT, array $options = array()) {
    if (!function_exists('crypt')) {
        trigger_error("Crypt must be loaded for password_hash to function", E_USER_WARNING);
        return null;
    }
    if (is_null($password) || is_int($password)) {
        $password = (string) $password;
    }
    if (!is_string($password)) {
        trigger_error("password_hash(): Password must be a string", E_USER_WARNING);
        return null;
    }
            // $algo = (int) $algo;
            // if (!is_int($algo)) {
            //     trigger_error("password_hash() expects parameter 2 to be long, " . gettype($algo) . " given", E_USER_WARNING);
            //     return null;
            // }
    $resultLength = 0;
    switch ($algo) {
        case PASSWORD_BCRYPT:
        $cost = PASSWORD_BCRYPT_DEFAULT_COST;
        if (isset($options['cost'])) {
            $cost = $options['cost'];
            if ($cost < 4 || $cost > 31) {
                trigger_error(sprintf("password_hash(): Invalid bcrypt cost parameter specified: %d", $cost), E_USER_WARNING);
                return null;
            }
        }
                    // The length of salt to generate
        $raw_salt_len = 16;
                    // The length required in the final serialization
        $required_salt_len = 22;
        $hash_format = sprintf("$2y$%02d$", $cost);
                    // The expected length of the final crypt() output
        $resultLength = 60;
        break;
        default:
        trigger_error(sprintf("password_hash(): Unknown password hashing algorithm: %s", $algo), E_USER_WARNING);
        return null;
    }
    $salt_requires_encoding = false;
    if (isset($options['salt'])) {
        switch (gettype($options['salt'])) {
            case 'NULL':
            case 'boolean':
            case 'integer':
            case 'double':
            case 'string':
            $salt = (string) $options['salt'];
            break;
            case 'object':
            if (method_exists($options['salt'], '__tostring')) {
                $salt = (string) $options['salt'];
                break;
            }
            case 'array':
            case 'resource':
            default:
            trigger_error('password_hash(): Non-string salt parameter supplied', E_USER_WARNING);
            return null;
        }
        if (self::Binary_strlen($salt) < $required_salt_len) {
            trigger_error(sprintf("password_hash(): Provided salt is too short: %d expecting %d", self::Binary_strlen($salt), $required_salt_len), E_USER_WARNING);
            return null;
        } elseif (0 == preg_match('#^[a-zA-Z0-9./]+$#D', $salt)) {
            $salt_requires_encoding = true;
        }
    } else {
        $buffer = '';
        $buffer_valid = false;

        if (function_exists('random_bytes') && !defined('PHALANGER')) {
            $buffer = random_bytes($raw_salt_len);
            if ($buffer) {
                $buffer_valid = true;
            }
        }elseif(function_exists('mcrypt_create_iv') && !defined('PHALANGER')){
            $buffer = mcrypt_create_iv($raw_salt_len, MCRYPT_DEV_URANDOM);
            if ($buffer) {
                $buffer_valid = true;
            }
        }
        if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {
            $buffer = openssl_random_pseudo_bytes($raw_salt_len);
            if ($buffer) {
                $buffer_valid = true;
            }
        }
        if (!$buffer_valid && @is_readable('/dev/urandom')) {
            $f = fopen('/dev/urandom', 'r');
            $read = self::Binary_strlen($buffer);
            while ($read < $raw_salt_len) {
                $buffer .= fread($f, $raw_salt_len - $read);
                $read = self::Binary_strlen($buffer);
            }
            fclose($f);
            if ($read >= $raw_salt_len) {
                $buffer_valid = true;
            }
        }
        if (!$buffer_valid || self::Binary_strlen($buffer) < $raw_salt_len) {
            $bl = self::Binary_strlen($buffer);
            for ($i = 0; $i < $raw_salt_len; $i++) {
                if ($i < $bl) {
                    $buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
                } else {
                    $buffer .= chr(mt_rand(0, 255));
                }
            }
        }
        $salt = $buffer;
        $salt_requires_encoding = true;
    }
    if ($salt_requires_encoding) {
        $base64_digits =
        'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
        $bcrypt64_digits =
        './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

        $base64_string = base64_encode($salt);
        $salt = strtr(rtrim($base64_string, '='), $base64_digits, $bcrypt64_digits);
    }
    $salt = self::Binary_substr($salt, 0, $required_salt_len);

    $hash = $hash_format . $salt;

    $ret = crypt($password, $hash);

    if (!is_string($ret) || self::Binary_strlen($ret) != $resultLength) {
        return false;
    }

    return $ret;
}

static function password_get_info($hash) {
    $return = array(
        'algo' => 0,
        'algoName' => 'unknown',
        'options' => array(),
    );
    if (self::Binary_substr($hash, 0, 4) == '$2y$' && self::Binary_strlen($hash) == 60) {
        $return['algo'] = PASSWORD_BCRYPT;
        $return['algoName'] = 'bcrypt';
        list($cost) = sscanf($hash, "$2y$%d$");
        $return['options']['cost'] = $cost;
    }
    return $return;
}


static function password_needs_rehash($hash, $algo, array $options = array()) {
    $info = password_get_info($hash);
    if ($info['algo'] != $algo) {
        return true;
    }
    switch ($algo) {
        case PASSWORD_BCRYPT:
        $cost = isset($options['cost']) ? $options['cost'] : PASSWORD_BCRYPT_DEFAULT_COST;
        if ($cost != $info['options']['cost']) {
            return true;
        }
        break;
    }
    return false;
}

static function password_verify($password, $hash) {
    if (!function_exists('crypt')) {
        trigger_error("Crypt must be loaded for password_verify to function", E_USER_WARNING);
        return false;
    }
    $ret = crypt($password, $hash);
    if (!is_string($ret) || self::Binary_strlen($ret) != self::Binary_strlen($hash) || self::Binary_strlen($ret) <= 13) {
        return false;
    }

    $status = 0;
    for ($i = 0; $i < self::Binary_strlen($ret); $i++) {
        $status |= (ord($ret[$i]) ^ ord($hash[$i]));
    }

    return $status === 0;
}

static function Binary_strlen($binary_string) {
    if (function_exists('mb_strlen')) {
        return mb_strlen($binary_string, '8bit');
    }
    return strlen($binary_string);
}

static function Binary_substr($binary_string, $start, $length) {
    if (function_exists('mb_substr')) {
        return mb_substr($binary_string, $start, $length, '8bit');
    }
    return substr($binary_string, $start, $length);
}

static function Binary_check() {
    static $pass = NULL;

    if (is_null($pass)) {
        if (function_exists('crypt')) {
            $hash = '$2y$04$usesomesillystringfore7hnbRJHxXVLeakoG8K30oukPsA.ztMG';
            $test = crypt("password", $hash);
            $pass = $test == $hash;
        } else {
            $pass = false;
        }
    }
    return $pass;
}


}
