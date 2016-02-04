<?php

namespace Sugarcrm\PasswordHash;

/**
 *
 * Generate password hashes compatible with SugarCRM 7.7 and up. This library
 * can be embedded in other tooling.
 *
 * Both BCRYPT and SHA2 are supported. Consult the SugarCRM's documentation to
 * learn more about the configuration options and the re-hashing functionality.
 *
 */
class Hash
{
    const VERSION = "1.0";

    /**
     * Generate bcrypt hash
     * @param string $password
     * @param number $cost
     * @return string
     */
    public function generateBcrypt($password, $cost = 10)
    {
        return password_hash(md5($password), PASSWORD_BCRYPT, array('cost' => $cost));
    }

    /**
     * Generate SHA-256 hash
     * @param string $password
     * @param number $rounds
     */
    public function generateSha256($password, $rounds = 5000)
    {
        return $this->generateSha2($password, $rounds, 5);
    }

    /**
     * Generate SHA-512 hash
     * @param string $password
     * @param number $rounds
     */
    public function generateSha512($password, $rounds = 5000)
    {
        return $this->generateSha2($password, $rounds, 6);
    }

    /**
     * Generate SHA-2 hash
     * @param string $password
     * @param number $rounds
     * @param number $algo 5 = SHA-256, 6 = SHA-512
     */
    protected function generateSha2($password, $rounds, $algo)
    {
        $salt = sprintf('$%d$rounds=%d$%s',
            $algo,
            $rounds,
            $this->getRandom(16)
        );

        return crypt(md5($password), $salt);
    }

    /**
     * Generate secure random number
     * @param size $bytes
     * @return string
     */
    protected function getRandom($bytes)
    {
        $random = base64_encode(mcrypt_create_iv($bytes, MCRYPT_DEV_URANDOM));

        // binary safe substring
        if (function_exists('mb_substr')) {
            return mb_substr($random, 0, $bytes, '8bit');
        }
        return substr($random, 0, $length);
    }
}
