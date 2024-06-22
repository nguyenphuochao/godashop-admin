<?php
class CategoryRepository extends BaseRepository
{
    function fetchAll($condition = null, $sort = null, $limit = null)
    {
        global $conn;
        $categories = array();
        $sql = "SELECT * FROM category";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        if ($sort) {
            $sql .= " $sort";
        }
        if ($limit) {
            $sql .= " $limit";
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
}
