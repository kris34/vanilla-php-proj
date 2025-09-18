<?php include 'db.php';

// class brand: I use this class to easly do
// API operations across the whole application

class Brand
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DB::getConnection();
    }


    public function create_brand($name, $image, $rating)
    {
        $country = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'XX'; // default 'XX' if not set

        $check = $this->pdo->prepare("SELECT COUNT(*) FROM brands WHERE brand_name = :name AND country = :country");
        $check->bindParam(':name', $name, PDO::PARAM_STR);
        $check->bindParam(':country', $country, PDO::PARAM_STR);
        $check->execute();

        if ($check->fetchColumn() > 0) {
            return 'exists';
        }

        $query = $this->pdo->prepare(
            "INSERT INTO brands (brand_name, brand_image, rating, country) 
         VALUES (:name, :image, :rating, :country)"
        );
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->bindParam(':rating', $rating, PDO::PARAM_INT);
        $query->bindParam(':country', $country, PDO::PARAM_STR);

        return $query->execute();
    }



    public function get_brands()
    {
        $query = $this->pdo->prepare("SELECT * FROM brands");

        $query = $this->pdo->prepare("SELECT * FROM brands");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
};
