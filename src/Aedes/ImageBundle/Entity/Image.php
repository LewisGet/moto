<?php

namespace Aedes\ImageBundle\Entity;

use Aedes\UserBundle\AedesUserBundle;
use Aedes\UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Image
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Aedes\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="create_by", referencedColumnName="id")
     */
    protected $createBy;

    // ..... other fields

    /**
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName")
     *
     * @var File $imageFile
     */
    protected $imageFile;

    /**
     * @ORM\Column(type="string", length=255, name="image_name")
     *
     * @var string $imageName
     */
    protected $imageName;

    public function __toString()
    {
        return $this->imageName;
    }

    /**
     * getId
     *
     * @return  integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * setCreateBy
     *
     * @param $user
     *
     * @return  void
     */
    public function setCreateBy($user)
    {
        $this->createBy = $user;
    }

    /**
     * getCreateBy
     *
     * @return  mixed
     */
    public function getCreateBy()
    {
        return $this->createBy;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImageFile(File $image)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
    }

    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }
}