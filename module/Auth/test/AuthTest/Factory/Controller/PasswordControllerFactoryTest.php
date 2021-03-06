<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2015 Cross Solution (http://cross-solution.de)
 * @license       MIT
 */

namespace AuthTest\Factory\Controller;

use Auth\Factory\Controller\PasswordControllerFactory;
use Test\Bootstrap;
use Zend\Mvc\Controller\ControllerManager;

class PasswordControllerSLFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PasswordControllerFactory
     */
    private $testedObj;

    public function setUp()
    {
        $this->testedObj = new PasswordControllerFactory();
    }

    public function testCreateService()
    {
        $sm = clone Bootstrap::getServiceManager();
        $sm->setAllowOverride(true);

        $authenticationServiceMock = $this->getMockBuilder('Auth\AuthenticationService')
            ->disableOriginalConstructor()
            ->getMock();

        $repositoriesMock = $this->getMockBuilder('Core\Repository\RepositoryService')
            ->disableOriginalConstructor()
            ->getMock();

        $sm->setService('AuthenticationService', $authenticationServiceMock);
        $sm->setService('repositories', $repositoriesMock);

        $controllerManager = new ControllerManager();
        $controllerManager->setServiceLocator($sm);

        $result = $this->testedObj->createService($controllerManager);

        $this->assertInstanceOf('Auth\Controller\PasswordController', $result);
    }
}