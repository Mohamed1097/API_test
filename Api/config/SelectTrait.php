<?php
trait Select
{
    private function cheakExist()
    {
        if($this->count()>0)
                {
                    return $this -> prepare -> fetchAll();
                }
                else
                {
                    return $this->count();
                }
    }
    public function select($func,$data,$cond,$condvalues)
    {
        if($func=='')
        {   
            $this->query("SELECT $data From {$this->tableName} $cond");
            if($cond!=''&&$condvalues!="")
            {
                $this->bindValues($condvalues);
            }
            return $this->cheakExist();
        }
        else
        {
            $this->query("SELECT $func($data) From {$this->tableName} $cond");
            if($cond!=''&&$condvalues!="")
            {
                $this->bindValues($condvalues);
            }
            $this -> execute();
            return $this->cheakExist();
            
        }
    }
}