<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2015 Cross Solution (http://cross-solution.de)
 * @license   MIT
 * @author    weitz@cross-solution.de
 */

namespace Core\Paginator;

use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ConfigInterface;
use Zend\Paginator\Paginator;

/**
 * Class PaginatorService
 * @package Core\Paginator
 */
class PaginatorService extends AbstractPluginManager
{

    /**
     * check class
     *
     * @param mixed $plugin
     * @return bool|void
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof Paginator) {
            return true;
        }
        return false;
    }
}
