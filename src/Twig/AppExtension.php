<?php
namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;


class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('datetime', array($this, 'datetimeFilter')),
        );
    }

    public function datetimeFilter($date)
    {
        $datetime = date_format($date, 'g:ia \o\n l jS F Y');;
        

        return $datetime;
    }
    
    public function getName()
    {
        return 'app_extension';
    }
}