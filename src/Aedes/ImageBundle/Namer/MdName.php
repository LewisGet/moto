<?php

namespace Aedes\ImageBundle\Namer;

use Vich\UploaderBundle\Naming\NamerInterface;

/**
 * UniqidNamer
 *
 * @author Emmanuel Vella <vella.emmanuel@gmail.com>
 */
class MdName implements NamerInterface
{
    /**
     * {@inheritDoc}
     */
    public function name($obj, $field)
    {
        $refObj = new \ReflectionObject($obj);

        $refProp = $refObj->getProperty($field);
        $refProp->setAccessible(true);

        $file = $refProp->getValue($obj);

        $name = uniqid() . "-" . md5_file($file);

        if ($extension = $file->guessExtension()) {
            $name = sprintf('%s.%s', $name, $file->guessExtension());
        }

        return $name;
    }
}
