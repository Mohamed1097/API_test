<?php
class Post
{
    private $db;
    public function __construct(Database $db)
    {
        $this->db=$db;
    }
    public function getAll()
    {
        $data='posts.id,categories.name as categoryName,posts.title,posts.body,posts.author,posts.created_at';
        $cond="LEFT JOIN categories ON posts.category_id=categories.id order by posts.created_at";
        $posts=$this->db->select("",$data,$cond,"");
         if($posts!="0")
         {
             $api['data']=[];
             foreach($posts as $post)
             {  
                extract($post);
                foreach($post as $p)
                {
                $array=[
                    'id' => $id , 
                    'categories' => $categoryName , 
                    'title' => $title ,
                    'body' => html_entity_decode($body) ,
                    'author' => $author ,
                    'createdAt' => $created_at ,
                ];
               }
                array_push($api['data'],$array);
             }
             
             return json_encode($api);   
         }
         else
         {
            return json_encode(['message' => 'There No Posts In Here']);
         }
    }
    public function getPost($postid)
    {
        if(!$postid){
            echo json_encode([
                'message' => 'Wrong value'
            ]); 

            return ; 
        }
        $data='posts.id,categories.name as categoryName,posts.title,posts.body,posts.author,posts.created_at';
        $cond="LEFT JOIN categories ON posts.category_id=categories.id WHERE posts.id=?";
        $condValues=array("id"=>$postid);
        $post=$this->db->select("",$data,$cond,$condValues);
        if($post!="0")
         {
            return json_encode($post);   
         }
         else
         {
            return json_encode(['message' => 'There No Posts In Here']);
         }
    }
    public function createPost($data)
    {
        if($this->db->insert($data)==null)
        {
            echo json_encode([
                'message' => 'Post Created'
            ]); 
        }
        else
        {
            echo json_encode($this->db->insert($data)); 
        }
    }
    public function updatePost($data,$condvalues)
    {
        if ($this->db->updateElement($data,'WHERE id=?',$condvalues)==null) {
            echo json_encode([
                'message' => 'Post Updated'
            ]); 
        }
        else
        {
            echo $this->db->updateElement($data,'WHERE id=?',$condvalues); 
        }
    }
    public function deletePost($condvalue)
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




