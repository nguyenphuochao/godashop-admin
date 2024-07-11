<?php
class CategoryRepository extends BaseRepository
{

    protected function fetchAll($condition = null)
    {
        global $conn;
        $categories = array();
        $sql = "SELECT * FROM category";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $category = new Category(
                    $row['id'],
                    $row['name']
                );
                $categories[] = $category;
            }
        }
        return $categories;
    }

    function getAll()
    {
        return $this->fetchAll();
    }

    function find($id)
    {
        $condition = "id = $id";
        $categories = $this->fetchAll($condition);
        $category = current($categories);
        return $category;
    }

    function save($data)
    {
        global $conn;
        $name = $data["name"];
        $sql = "INSERT INTO category (name) VALUES ('$name')";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function update($category)
    {
        global $conn;
        $id = $category->getID();
        $name = $category->getName();
        $sql = "UPDATE category SET name = '$name' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function delete($category)
    {
        global $conn;
        $id = $category->getID();
        $sql = "DELETE FROM category WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }
}
