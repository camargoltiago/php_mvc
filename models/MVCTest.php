<?php
class MVCTest extends Model
{
    public function getQuantity()
    {
        $sql = "SELECT COUNT(*) AS quantity FROM test";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            return $sql['quantity'];
        }

        return 0;
    }

    public function test()
    {
        return 'MVC Test';
    }
}
