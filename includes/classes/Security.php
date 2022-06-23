<?php

/**
 * Security Class &mdash;
 * Holds Methods to Encryption, Decription and Encryption Key Genertion
 * @author Muhammad Saif
 * @link m.saifmumtaz@gmail.com
 * @copyright 2022 Muhammad Saif
 */

class Security
{

    private $public_key;
    private $private_key;


    public $salt;
    /**
     * Secure User Input
     * 
     * @param string $string User Typed String 
     */
    public static function input_secure($string, $br = true, $strip = 0)
    {
        $string = trim($string);
        $string = preg_replace("/&#?[a-z0-9]+;/i", "", $string);
        $string = htmlspecialchars($string, ENT_QUOTES);
        if ($br == true) {
            $string = str_replace('\r\n', " <br>", $string);
            $string = str_replace('\n\r', " <br>", $string);
            $string = str_replace('\r', " <br>", $string);
            $string = str_replace('\n', " <br>", $string);
        } else {
            $string = str_replace('\r\n', "", $string);
            $string = str_replace('\n\r', "", $string);
            $string = str_replace('\r', "", $string);
            $string = str_replace('\n', "", $string);
        }
        if ($strip == 1) {
            $string = stripslashes($string);
        }
        $string = str_replace('&amp;#', '&#', $string);
        return $string;
    }

    public static function int_only($string)
    {
        $string = preg_replace('/[^\d+$]/', "", $string);
        return $string;
    }

    /**
     * CSRF Token Generation
     *  
     * @return string $token CSRF Protection Token
     */

    public static function create_csrftoken()
    {
        // create token
        $token = bin2hex(random_bytes(16));
        //Save in Session
        $_SESSION['csrf_token'] = $token;
        //create hidden field
        echo "<input type='hidden' name='csrf_token' value='$token'/>";
    }

    /**
     * Validate CSRF Token
     *
     * @param string $token
     * @return bool true|false
     */
    public static function validate_csrftoken($token)
    {
        //Validate Token
        return isset($_SESSION["csrf_token"]) && $_SESSION["csrf_token"] == $token;
    }

    /**
     * Generate Unique UUID V5
     *
     * @param string $data
     * @return string uuid
     */
    public static function guidv4($data = null)
    {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 0);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    /**
     * Get an AES key from a static password and a secret salt
     * 
     * @param string $password Your weak password here
     * @param int $keysize Number of bytes in encryption key
     */
    public function getKeyFromPassword($password, $keysize = 32)
    {
        $salt = base64_encode(openssl_random_pseudo_bytes(32));

        $key = hash_pbkdf2(
            'sha384',
            $password,
            $salt,
            120000, // Number of iterations
            $keysize,
            false
        );

        return array("key" => $key, "salt" => $salt);
    }

    /**
     * Generate Random Key for Encryption 
     * @param int $keysize Keysize in Bytes.
     */
    public static function generateRandomKey($keysize)
    {
        return bin2hex(random_bytes($keysize));
    }

    /**
     * Regenerate AES key from a static password and a secret salt
     * 
     * @param string $password Your weak password here
     * @param string $salt Your Previous Generated Salt
     * @param int $keysize Number of bytes in encryption key
     */
    public function getKeyFromPasswordAndSalt($password, $salt, $keysize = 32)
    {
        return hash_pbkdf2(
            'sha384',
            $password,
            $salt,
            120000, // Number of iterations
            $keysize,
            false
        );
    }

    //  AES Encrypt Method
    /**
     * AES-GCM Encryption Text Function Default Set to AES-128-GCM
     * @param mixed $text String you want to encrypt
     * @param mixed $encryption_key Encryption Key 
     * @param int $options Options for openssl 
     * @return (string|false)
     */
    public static function aes_gcm_encrypt($text, $encryption_key, $ciphering_method = "aes-256-gcm", $options = OPENSSL_RAW_DATA)
    {
        $iv_length = openssl_cipher_iv_length($ciphering_method);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $tag = bin2hex(random_bytes(4));
        // return $tag;

        $encrypted = openssl_encrypt(
            $text,
            $ciphering_method,
            $encryption_key,
            $options,
            $iv,
            $tag
        );
        // return $tag;

        // return $encrypted;
        return base64_encode($iv . $tag . $encrypted);
    }

    /**
     * AES-GCM Decryption Text Function Default Set to AES-128-GCM
     * 
     * @param array|string $encrypted Array Of encrypted string and iv value
     * @param mixed $decryption_key Key used to Encrypt string
     * @param int $options Options for open ssl
     * @return false|string 
     */
    public static function aes_gcm_decrypt($encrypted, $decryption_key, $ciphering_method = "AES-256-GCM", $options = OPENSSL_RAW_DATA)
    {
        $data = base64_decode($encrypted);
        $iv_length = openssl_cipher_iv_length($ciphering_method);
        $iv = substr($data, 0, $iv_length);
        $tag = substr($data, $iv_length, 16);
        $text = substr($data, $iv_length + 16);
        $decrypted = openssl_decrypt(
            $text,
            $ciphering_method,
            $decryption_key,
            $options,
            $iv,
            $tag
        );
        if ($decrypted == false) {
            return false;
        } else {
            return $decrypted;
        }
    }

    /**
     * Genrate RSA KEY FOR Public/Private Key Encryption
     *
     * @param integer $user_id
     * @param integer $key_size
     * @return string|array Return Public Key or Error Array
     */
    public function generateRSAKey($privateKeyPath, $user_id, $key_size = 2048)
    {

        $privatefile = $privateKeyPath . bin2hex(random_bytes(3)) . '_' . $user_id . '.pkcs8';
        $config = [
            "digest_alg" => "sha512",
            "private_key_bits" => $key_size,
            "private_key_type" => OPENSSL_KEYTYPE_RSA
        ];
        $config_priv = [];
        /* Uncomment these codes for Windows if configuration error
            $openssl_conf = "c:/xampp/php/extras/openssl/openssl.cnf";
            $config["config"] = $openssl_conf;
            $config_priv["config"] = $openssl_conf;
        */
        $res = openssl_pkey_new($config);
        if (!$res) {
            return ['error' => "openssl_pkey_new: " . openssl_error_string()];
        }
        // Get private key
        openssl_pkey_export($res, $privatekey, "", $config_priv);
        if (!$privatekey) {
            return ['error' => "openssl_pkey_export: " . openssl_error_string()];
        }
        file_put_contents($privatefile, $privatekey);
        // Get public key
        $pkeydetails = openssl_pkey_get_details($res);
        if (!$pkeydetails) {
            return ['error' => "openssl_pkey_get_details: " . openssl_error_string()];
        }
        $publickey = $pkeydetails["key"];


        return $publickey;
    }
}
