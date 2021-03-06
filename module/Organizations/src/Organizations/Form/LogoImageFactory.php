<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013-2015 Cross Solution (http://cross-solution.de)
 * @license   MIT
 */

namespace Organizations\Form;

use Core\Form\FileUploadFactory;
use Zend\Stdlib\AbstractOptions;

class LogoImageFactory extends FileUploadFactory
{
    protected $fileName = 'image';
    protected $fileEntityClass = '\Organizations\Entity\OrganizationImage';
    protected $configKey = 'organization_logo_image';

    /**
     * use abstract options defined in "Applications/Options"
     *
     * @var string
     */
    protected $options="Jobs/Options";

    protected function configureForm($form, AbstractOptions $options)
    {
        $size = $options->getCompanyLogoMaxSize();
        $type = $options->getCompanyLogoMimeType();

        $form->get($this->fileName)->setViewHelper('FormImageUpload')
            ->setMaxSize($size)
            ->setAllowedTypes($type)
            ->setForm($form);

        $form->setIsDescriptionsEnabled(true);
        $form->setDescription(
            /*@translate*/ 'Choose a Logo. This logo will be shown in the job opening and the application form.'
        );
    }
}
