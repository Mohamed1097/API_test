<?php
trait Update
{
    public function updateElement($data,$condition,$conditionValue)
    {
        $this->query("UPDATE {$this->tableName} SET {$this->getUpdatedElements($data)} $condition");
        if ($this->cheakValues($data)!=null) {
            return $this->errors;
        }
        $this->bindValues($data);
        if ($this->bindConditionValues($data,$conditionValue)==null) 
        {
            return json_encode(['message'=>'There something Wrong, Try Again Later 4334']);   
        }
        $this->execute();
        return $this->errors;
    }
    private function bindConditionValues($data,$conditionValues)
    {
        if (gettype($conditionValues)!="array")
         {
            return null;
        }
        for ($i=0; $i <count(array_values($conditionValues)); $i++) 
        {
            $this->bind(count(array_values($data))+1,array_values($conditionValues)[$i]); 
        }
        return true;
    }
    private function getUpdatedElements($data)
    {
      $keys=array_keys($data);
      $v='';
      for ($i=0; $i <count($keys) ; $i++) 
      {
        $v=$v."$keys[$i]"."="."?".",";  
      }
      $v=explode(',', $v);
      array_pop($v);
      $v=implode(',',$v);
      return $v;
    }
}