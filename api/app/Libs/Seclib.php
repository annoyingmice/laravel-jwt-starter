<?php

namespace App\Libs;

use Illuminate\Support\Facades\Storage;
use phpseclib3\Crypt\RSA;

class Seclib 
{   
    const RSA_PRIVATE = 'RSA_PRIVATE';
    const RSA_PUBLIC  = 'RSA_PUBLIC';
    /**
     * Execute command
     * @return void
     */
    public static function execute(): void
    {
        $private  = RSA::createKey();
        $public   = $private->getPublicKey();
        
        // Write RSA KEYS
        (new Seclib)->write(Seclib::RSA_PRIVATE, $private);
        (new Seclib)->write(Seclib::RSA_PUBLIC, $public);
    }
    
    /**
     * Get the private key
     * @return string|null
     */
    public static function privateKey(): string|null
    {
        $filepath = 'rsa/'.Seclib::RSA_PRIVATE;
        if (Storage::disk('local')->exists($filepath))
        {
            return Storage::disk('local')->get($filepath);
        }
        
        return null;
    }
    
    /**
     * Get the public key
     * @return string|null
     */
    public static function publicKey(): string|null
    {
        $filepath = 'rsa/'.Seclib::RSA_PUBLIC;
        if (Storage::disk('local')->exists($filepath))
        {
            return Storage::disk('local')->get($filepath);
        }
        
        return null;
    }
        
    /**
     * Write file to storage
     * @param string $filename
     * @param string $content
     * @return void
     */
    private function write(string $filename, string $content): void
    {
        Storage::disk('local')->put('rsa/'.$filename, $content);
    }
}