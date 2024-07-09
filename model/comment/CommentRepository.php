<?php
class CommentRepository extends BaseRepository
{
    protected function fetchAll($condition = null)
    {
        global $conn;
        $sql = "SELECT * FROM comment";
        if ($condition) {
            $sql .= " WHERE $condition";
        }
        $result = $conn->query($sql);
        $comments = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $comment = new Comment(
                    $row['id'],
                    $row['product_id'],
                    $row['email'],
                    $row['fullname'],
                    $row['star'],
                    $row['created_date'],
                    $row['description']
                );
                array_push($comments, $comment);
            }
            return $comments;
        }
        return $comments;
    }

    // Hàm lấy tất cả comment theo product_id
    function findByProductID($product_id)
    {
        $condition = "product_id = $product_id";
        $comments = $this->fetchAll($condition);
        return $comments;
    }

    // Hàm lấy chi tiết
    function find($id)
    {
        $condition = "id = $id";
        $comments = $this->fetchAll($condition);
        $comment = current($comments);
        return $comment;
    }

    // Hàm xóa 1 comment
    function delete($comment)
    {
        global $conn;
        $id = $comment->getID();
        $sql = "DELETE FROM comment WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;
    }

}
