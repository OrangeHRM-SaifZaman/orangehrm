<?php

/**
 * Test class for CountryService.
 * Generated by PHPUnit on 2012-01-21 at 19:45:40.
 */
class CountryServiceTest extends PHPUnit_Framework_TestCase {

    /**
     * @var CountryService
     */
    protected $service;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->service = new CountryService;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    /**
     * @covers CountryService::getCountryDao
     */
    public function testGetCountryDao() {
        $result = $this->service->getCountryDao();
        $this->assertTrue($result instanceof CountryDao);
        
        $countryDao = new CountryDao();
        $this->service->setCountryDao($countryDao);
        $result = $this->service->getCountryDao();
        $this->assertEquals($countryDao, $result);
        
    }
    
    public function testSetCountryDao() {
        $countryDao = new CountryDao();
        $this->service->setCountryDao($countryDao);
        $result = $this->service->getCountryDao();
        $this->assertEquals($countryDao, $result);
    }

    /**
     * @covers CountryService::searchCountries
     */
    public function testSearchCountries_Successful() {
        $countries = array(
            new Country(),
            new Country(),
            new Country(),
        );
        
        $searchParams = array(
            'sampleParam1' => 'sampleValue1',
            'sampleParam2' => 'sampleValue2',
        );
        
        $countryDaoMock = $this->getMock('CountryDao', array('searchCountries'));
        $countryDaoMock->expects($this->once())
                ->method('searchCountries')
                ->will($this->returnValue($countries));
        
        $this->service->setCountryDao($countryDaoMock);
        
        $this->assertEquals($countries, $this->service->searchCountries($searchParams));
    }

    /**
     * @covers CountryService::searchCountries
     * @expectedException ServiceException
     */
    public function testSearchCountries_WithException() {
        $searchParams = array(
            'sampleParam1' => 'sampleValue1',
            'sampleParam2' => 'sampleValue2',
        );
        
        $countryDaoMock = $this->getMock('CountryDao', array('searchCountries'));
        $countryDaoMock->expects($this->once())
                ->method('searchCountries')
                ->will($this->throwException(new DaoException));
        
        $this->service->setCountryDao($countryDaoMock);
        
        $this->service->searchCountries($searchParams);
    }

}

?>