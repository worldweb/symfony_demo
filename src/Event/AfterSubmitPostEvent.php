<?php
namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class AfterSubmitPostEvent extends Event
{
    private $post_id;

    public function __construct($post_id)
    {
        
    }
}
