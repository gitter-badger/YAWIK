<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2015 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */

/** */
namespace Auth\Listener;

use Zend\EventManager\SharedEventManagerInterface;
use Zend\EventManager\SharedListenerAggregateInterface;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container as Session;

/**
 * This listener checks for query or post parameters "token" and "auth".
 *
 * If one of the two is found, it tries to restore the session.
 *
 * @author Mathias Gelhausen <gelhausen@cross-solution.de>
 */
class TokenListener implements SharedListenerAggregateInterface
{

    /**
     * Callback Handler.
     *
     * @var \Zend\Stdlib\CallbackHandler
     */
    protected $listener;

   
    /**
     * Attach to a shared event manager
     *
     * @param  SharedEventManagerInterface $events
     * @param  integer $priority
     */
    public function attachShared(SharedEventManagerInterface $events, $priority = 1000)
    {
        /* @var $events \Zend\EventManager\SharedEventManager */
        $this->listener = $events->attach('Zend\Mvc\Application', MvcEvent::EVENT_BOOTSTRAP, array($this, 'onBootstrap'), $priority);
    }

    /**
     * Detach all our listeners from the event manager
     *
     * @param  SharedEventManagerInterface $events
     * @return void
     */
    public function detachShared(SharedEventManagerInterface $events)
    {
        if ($events->detach('Zend\Mvc\Application', $this->listener)) {
            $this->listener = null;
        }

        return true;
    }

    public function onBootstrap(MvcEvent $e)
    {
        /* @var $request \Zend\Http\Request */
        $request = $e->getRequest();
        
        /*
         * Check "auth" param, restore session, if found.
         */
        $token = $request->getPost('auth') ?: $request->getQuery('auth');
        
        if ($token) {
            session_id($token);
            return;
        }
        
        /*
         * Check "token" param, set Session Container for AnonymousUser
         */
        $token = $request->getPost('token') ?: $request->getQuery('token');
        
        if ($token) {
            $session = new Session('Auth');
            $session->token = $token;
        }
        
    }
}
