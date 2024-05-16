<?php

class DataBaseConnection{
    private $db;

    public function __construct()
    {
        $dns='mysql:host=localhost;dbname=iksasocket';
        $username='cbsu_IKSA_ROOT';
        $password = '#Kyc@dmin1st3r23!';
        
        /*
        $dns='mysql:host=192.168.0.18;dbname=iksasocket';
        $username='IARA2';
        $password = 'iara20!';
        */
        // $dns='mysql:host=localhost;dbname=iksasocket';
        // $username='root';
        // $password = '';
        $option = [
            PDO::ATTR_PERSISTENT=>true,
            PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
        ];

        try{
            $this->db = new PDO($dns,$username,$password,$option);
        }catch(PDOException $e){
            echo 'Error de conexion: '.$e->getMessage();
        }
    }

    function connect(){
        if( $this->db != null)
        return $this->db;
    }
}
