<?php

namespace App\Models;

use Core\Database;
use Core\Model;
use PDO;

class Post extends Model
{
    private $title = null;
    private $description = null;
    private $cover = null;

    public function getAll()
    {
        $db = Database::getInstance();
        $stmt = $db->query('SELECT * FROM posts');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCurrentPost($id)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM posts WHERE id = :id LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();// check affected rows using rowCount
        if ($count == 1) {
            return $stmt->fetch();
        } else {
            return false;
        }

    }

    public function deleteCurrentPost($id)
    {
        $db = Database::getInstance();
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();// check affected rows using rowCount
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function savePost(array $postData, $cover = null)
    {
        $this->title        = $postData['title'];
        $this->description  = $postData['description'];
        $this->cover        = $cover;

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'cover' => $this->cover,
        ];

        $db = Database::getInstance();
        $sql = "INSERT INTO posts (title, description, cover) VALUES (:title, :description, :cover)";
        $stmt = $db->prepare($sql);

        $stmt->execute($data);
        return true;
    }
}
