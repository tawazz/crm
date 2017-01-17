<?php

use Phinx\Seed\AbstractSeed;
require_once __DIR__.'/../app/config/db.config.php';
class EncryptPasswords extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $sql = "update passwords to base64 UPDATE `vault` SET `password` = TO_BASE64(`password`) WHERE 1 = 1";
        $vaults = HTTP\Models\Vault::all();
        foreach ($vaults as $vault) {
            if ((bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', base64_decode($vault->password)) == false){
                $vault->password = base64_encode($vault->password);
                $vault->save();
            }
        }
    }
}
