<?php

namespace Aedes\MotoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Moto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Moto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="displacement", type="integer")
     */
    private $displacement;

    /**
     * @var integer
     *
     * @ORM\Column(name="fuel", type="integer")
     */
    private $fuel;

    /**
     * @var integer
     *
     * @ORM\Column(name="years", type="integer")
     */
    private $years;

    /**
     * @var integer
     *
     * @ORM\Column(name="mileage", type="integer")
     */
    private $mileage;

    /**
     * @var integer
     *
     * @ORM\Column(name="cooling", type="integer")
     */
    private $cooling;

    /**
     * @var string
     *
     * @ORM\Column(name="modifiedContent", type="text")
     */
    private $modifiedContent;

    /**
     * @var string
     *
     * @ORM\Column(name="tradingContent", type="text")
     */
    private $tradingContent;

    /**
     * @var integer
     *
     * @ORM\Column(name="brand", type="integer")
     */
    private $brand;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Aedes\AddressBundle\Entity\Country")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     */
    private $country;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Aedes\AddressBundle\Entity\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    private $city;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Aedes\AddressBundle\Entity\Area")
     * @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     */
    private $area;

    /**
     * @var string
     *
     * @ORM\Column(name="image1", type="string", length=255)
     */
    private $image1;

    /**
     * @var string
     *
     * @ORM\Column(name="image2", type="string", length=255)
     */
    private $image2;

    /**
     * @var string
     *
     * @ORM\Column(name="image3", type="string", length=255)
     */
    private $image3;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Moto
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Moto
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Moto
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set displacement
     *
     * @param integer $displacement
     * @return Moto
     */
    public function setDisplacement($displacement)
    {
        $this->displacement = $displacement;

        return $this;
    }

    /**
     * Get displacement
     *
     * @return integer 
     */
    public function getDisplacement()
    {
        return $this->displacement;
    }

    /**
     * Set fuel
     *
     * @param integer $fuel
     * @return Moto
     */
    public function setFuel($fuel)
    {
        $this->fuel = $fuel;

        return $this;
    }

    /**
     * Get fuel
     *
     * @return integer 
     */
    public function getFuel()
    {
        return $this->fuel;
    }

    /**
     * Set years
     *
     * @param integer $years
     * @return Moto
     */
    public function setYears($years)
    {
        $this->years = $years;

        return $this;
    }

    /**
     * Get years
     *
     * @return integer 
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * Set mileage
     *
     * @param integer $mileage
     * @return Moto
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;

        return $this;
    }

    /**
     * Get mileage
     *
     * @return integer 
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * Set cooling
     *
     * @param integer $cooling
     * @return Moto
     */
    public function setCooling($cooling)
    {
        $this->cooling = $cooling;

        return $this;
    }

    /**
     * Get cooling
     *
     * @return integer 
     */
    public function getCooling()
    {
        return $this->cooling;
    }

    /**
     * Set modifiedContent
     *
     * @param string $modifiedContent
     * @return Moto
     */
    public function setModifiedContent($modifiedContent)
    {
        $this->modifiedContent = $modifiedContent;

        return $this;
    }

    /**
     * Get modifiedContent
     *
     * @return string 
     */
    public function getModifiedContent()
    {
        return $this->modifiedContent;
    }

    /**
     * Set tradingContent
     *
     * @param string $tradingContent
     * @return Moto
     */
    public function setTradingContent($tradingContent)
    {
        $this->tradingContent = $tradingContent;

        return $this;
    }

    /**
     * Get tradingContent
     *
     * @return string 
     */
    public function getTradingContent()
    {
        return $this->tradingContent;
    }

    /**
     * Set brand
     *
     * @param integer $brand
     * @return Moto
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return integer 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set country
     *
     * @param integer $country
     * @return Moto
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return integer 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param integer $city
     * @return Moto
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return integer 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set area
     *
     * @param integer $area
     * @return Moto
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return integer 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set image1
     *
     * @param string $image1
     * @return Moto
     */
    public function setImage1($image1)
    {
        $this->image1 = $image1;

        return $this;
    }

    /**
     * Get image1
     *
     * @return string 
     */
    public function getImage1()
    {
        return $this->image1;
    }

    /**
     * Set image2
     *
     * @param string $image2
     * @return Moto
     */
    public function setImage2($image2)
    {
        $this->image2 = $image2;

        return $this;
    }

    /**
     * Get image2
     *
     * @return string 
     */
    public function getImage2()
    {
        return $this->image2;
    }

    /**
     * Set image3
     *
     * @param string $image3
     * @return Moto
     */
    public function setImage3($image3)
    {
        $this->image3 = $image3;

        return $this;
    }

    /**
     * Get image3
     *
     * @return string 
     */
    public function getImage3()
    {
        return $this->image3;
    }
}
