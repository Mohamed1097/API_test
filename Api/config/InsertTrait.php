<?php
trait Insert
{
    public function insert($data)
    {
        $this->query("insert into {$this->tableName} ({$this->getKeys($data)}) VALUES ({$this->getValues($data)})");
        if ($this->cheakValues($data)!=null) {
            return $this->errors;
        }
        $this->bindValues($data);
        $this->execute();
        return $this->errors;
    }
    private function getValues($data)
    {
        $data=array_values($data);
        $value="";
        for ($i=0; $i <count($data) ; $i++) {
        $value=$value."?,";
        }
        $value=explode(',', $value);
        array_pop($value);
        $value=implode(',', $value);
        return $value;
    }
    private function getKeys($data)
    {
        $data=array_keys($data);
        $key="";
        for ($i=0; $i <count($data) ; $i++) {
        $key=$key."$data[$i],"; 
        }
        $key=explode(',', $key);
        array_pop($key);
        $key=implode(',', $key);
        return $key;
    }
}