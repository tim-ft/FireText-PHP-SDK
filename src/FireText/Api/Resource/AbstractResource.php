<?php
namespace FireText\Api\Resource;

use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\Filter;

abstract class AbstractResource implements ResourceInterface
{
    protected $hydrator;

    public function __construct()
    {
        $hydrator = new ClassMethodsHydrator;
        $hydrator->setUnderscoreSeparatedKeys(false);
        foreach(array(
            'getHydrator',
        ) as $method) {
            $hydrator->addFilter($method, new Filter\MethodMatchFilter($method), Filter\FilterComposite::CONDITION_AND);
        }

        $this->setHydrator($hydrator);
    }

    public function getHydrator()
    {
        return $this->hydrator;
    }
    
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }
}
