<?php include 'db.php';

class Brand
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DB::getConnection();
    }


    public function create_brand()
    {
        $query = $this->pdo->prepare('');
    }
};
