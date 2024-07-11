<?php
class ImageItemRepository extends BaseRepository
{
    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM image_item";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $imageItems = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $imageItem = new ImageItem(
                    $row['id'],
                    $row['product_id'],
                    $row['name']
                );
                $imageItems[] = $imageItem;
            }
        }
        return $imageItems;
    }

    function getAll()
    {
        return $this->fetchAll();
    }

    function find($id)
    {
        $condition = "id = $id";
        $imageItems = $this->fetchAll($condition);
        return current($imageItems);
    }

    function getByProductID($product_id)
    {
        $condition = "product_id = $product_id";
        $imageItems = $this->fetchAll($condition);
        return $imageItems;
    }

    function save($data)
    {
        global $conn;
        $product_id = $data['product_id'];
        $name = $data['name'];
        $sql = "INSERT INTO image_item (product_id, name) VALUES ($product_id, '$name')";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error:" . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function update(ImageItem $imageItem)
    {
        global $conn;
        $id = $imageItem->getID();
        $product_id = $imageItem->getProductID();
        $name = $imageItem->getName();
        $sql = "UPDATE image_item SET product_id = $product_id, name = '$name' WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error:" . $sql . PHP_EOL . $conn->error;
        return false;
    }

    function delete(ImageItem $imageItem){
        global $conn;
        $id = $imageItem->getID();
        $sql = "DELETE FROM image_item WHERE id = $id";
        if($conn->query($sql) === TRUE){
            return true;
        }
        $this->error = "Error:" . $sql . PHP_EOL . $conn->error;
        return false;
    }
}
