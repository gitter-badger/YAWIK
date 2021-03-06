<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2015 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */

/** InjectSettingsEntityResolverListener.php */
namespace Settings\Repository\Event;

use Doctrine\Common\EventSubscriber;
use Doctrine\ODM\MongoDB\Events;
use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Auth\Entity\UserInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InjectSettingsEntityResolverListener implements EventSubscriber, ServiceLocatorAwareInterface
{
    
    protected $services;
    
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->services = $serviceLocator;
        return $this;
    }
    
    public function getServiceLocator()
    {
        return $this->services;
    }
    
    
    public function getSubscribedEvents()
    {
        return array(Events::postLoad);
    }
    
    public function postLoad(LifecycleEventArgs $args)
    {
        $document = $args->getDocument();
        if (!$document instanceof UserInterface) {
            return;
        }
        
        $resolver = $this->services->get('Settings/EntityResolver');
        $document->setSettingsEntityResolver($resolver);
        
    }
}
