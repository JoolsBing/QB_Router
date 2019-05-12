<?php


class QueryBuilder
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table){
        $sql = "SELECT * FROM $table";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectOne($table, $id){
        $sql = "SELECT * FROM $table WHERE id=:id";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([
            ":id" => $id
        ]);
        return $stm->fetch(PDO::FETCH_ASSOC);

    }

    public function create($table,$data) {
        $values  = ":". implode(",:",array_keys($data));
        $key = implode(",",array_keys($data));
        $sql = "INSERT INTO $table({$key}) VALUES ({$values})";
        $stm = $this->pdo->prepare($sql);
        $stm->execute($data);
    }

    public function update($table,$id,$data){
        $keys = array_keys($data);
        $str = '';
        foreach ($keys as $key) {
            $str .= $key . '=:'.$key. ',';
        }
        $keys = rtrim($str, ',');
        $data['id'] = $id;
        $sql = "UPDATE $table SET {$keys} WHERE id=:id";
        $stm = $this->pdo->prepare($sql);
        $stm->execute($data);
    }

    public function delete($table,$id){
        $sql = "DELETE FROM $table WHERE id=:id";
        $stm = $this->pdo->prepare($sql);
        $stm->execute([":id"=>$id]);
    }
}