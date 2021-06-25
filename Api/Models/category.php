<?php
class Category
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db=$db;
    }
    public function getAll()
    {
        
        $categories=$this->db->select("","*","","");
         if($categories!="0")
         {
             $api['data']=[];
             foreach($categories as $category)
             {  
                extract($category);
                foreach($category as $c)
                {
                $array=[
                    'id' => $id , 
                    'name' => $name , 
                    'createdAt' => $created_at 
                ];
               }
                array_push($api['data'],$array);
             }
             
             return json_encode($api);   
         }
         else
         {
            return json_encode(['message' => 'There No Categories In Here']);
         }
    }
    public function getCategory($id)
    {
        if(!$id){
            echo json_encode([
                'message' => 'Wrong value'
            ]); 

            return ; 
        }  
        $condValues=array("id"=>$id);
        $category=$this->db->select("","*","WHERE id = ?",$condValues);
        if($category!="0")
         {
            return json_encode($category);   
         }
         else
         {
            return json_encode(['message' => 'There No сategory']);
         }
    }
    public function createCategory($data)
    {
        if($this->db->insert($data)==null)
        {
            echo json_encode([
                'message' => 'Category Created'
            ]); 
        }
        else
        {
            echo json_encode($this->db->insert($data)); 
        }
    }
    public function updateCategory($data,$condvalues)
    {
        if ($this->db->updateElement($data,'WHERE id=?',$condvalues)==null) {
            echo json_encode([
                'message' => 'Category Updated'
            ]); 
        }
        else
        {
            echo $this->db->updateElement($data,'WHERE id=?',$condvalues); 
        }
    }
    public function deleteCategory($condvalue)
    {
        if (!$condvalue||gettype($condvalue['id'])!="integer")
         {
            return false; 
        }
        else
        {
            return $this->db->delete('WHERE id=?',$condvalue);

        }
    }


}