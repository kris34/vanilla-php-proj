<?php
include 'db.php';

class Brand
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = DB::getConnection();
    }

    public function create_brand($name, $image, $rating)
    {
        try {
            if (empty($name) || empty($image) || $rating === null) {
                return ['status' => 'error', 'message' => 'Name, image, and rating are required'];
            }

            $country = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'XX';

            $check = $this->pdo->prepare("SELECT COUNT(*) FROM brands WHERE brand_name = :name AND country = :country");
            $check->bindParam(':name', $name, PDO::PARAM_STR);
            $check->bindParam(':country', $country, PDO::PARAM_STR);
            $check->execute();

            if ($check->fetchColumn() > 0) {
                return ['status' => 'exists', 'message' => 'Brand already exists in your country'];
            }

            $query = $this->pdo->prepare(
                "INSERT INTO brands (brand_name, brand_image, rating, country) 
                 VALUES (:name, :image, :rating, :country)"
            );

            $query->bindParam(':name', $name, PDO::PARAM_STR);
            $query->bindParam(':image', $image, PDO::PARAM_STR);
            $query->bindParam(':rating', $rating, PDO::PARAM_INT);
            $query->bindParam(':country', $country, PDO::PARAM_STR);

            if ($query->execute()) {
                return ['status' => 'success', 'message' => 'Brand created'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to create brand'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    public function get_brands($country = null)
    {
        try {
            if ($country) {
                $query = $this->pdo->prepare("SELECT * FROM brands WHERE country = :country");
                $query->bindParam(':country', $country, PDO::PARAM_STR);
                $query->execute();
            } else {
                $query = $this->pdo->prepare("SELECT * FROM brands");
                $query->execute();
            }

            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    public function delete_brand($id)
    {
        try {
            if (!$id) {
                return ['status' => 'error', 'message' => 'Brand ID is required'];
            }

            $query = $this->pdo->prepare("DELETE FROM brands WHERE id = :id");
            $query->bindParam(':id', $id, PDO::PARAM_INT);

            if ($query->execute()) {
                return ['status' => 'success', 'message' => 'Brand deleted'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to delete brand'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }


    public function update_brand($id, $name, $image, $rating)
    {
        try {
            if (!$id || empty($name) || empty($image) || $rating === null) {
                return ['status' => 'error', 'message' => 'ID, name, image, and rating are required'];
            }

            $country = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'XX';

            $query = $this->pdo->prepare(
                "UPDATE brands 
                 SET brand_name = :name, brand_image = :image, rating = :rating, country = :country
                 WHERE id = :id"
            );

            $query->bindParam(':name', $name, PDO::PARAM_STR);
            $query->bindParam(':image', $image, PDO::PARAM_STR);
            $query->bindParam(':rating', $rating, PDO::PARAM_INT);
            $query->bindParam(':country', $country, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_INT);

            if ($query->execute()) {
                return ['status' => 'success', 'message' => 'Brand updated'];
            } else {
                return ['status' => 'error', 'message' => 'Failed to update brand'];
            }
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}
