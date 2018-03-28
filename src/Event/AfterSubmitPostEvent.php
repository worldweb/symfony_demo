<?php
namespace App\Event;

use Symfony\Component\EventDispatcher\Event;
use App\Entity\PostMeta;

class AfterSubmitPostEvent extends Event
{
    const NAME = 'post.stored';
    protected $post_id;
    
    public function __construct($post_id)
    {
        $this->post_id = $post_id;
    }

    public function getPost()
    {
        return $this->post_id;
    }
    
    public function setPost($post_id){
        $this->post_id = $post_id;
    }
}
