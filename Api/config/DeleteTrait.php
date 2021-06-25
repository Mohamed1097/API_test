<?php
trait Delete
{
    public function delete($condition,$conditionValues)
    {
        $this->query("DELETE FROM {$this->tableName} $condition");
        $this->bindValues($conditionValues);
        return $this->execute();
    }
}