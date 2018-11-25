<?php 

use app\models\Band;

class BandTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /*
     * Band model
     * Validation test
     */
    public function testValidation()
    {
        $isBand = Band::findOne(['band_name' => 'Toto Cotugno4']) !== null;
        $band = new Band();
        
        if ($isBand) {
            // Update
            $band->band_name = 'Toto Cotugno4';
            $this->assertFalse($band->validate(['band_name']));
        } else {
            // Create
            $band->band_name = 'Toto Cotugno4';
            $this->assertTrue($band->validate(['band_name']));
        }

        $band->band_name = '';
        $this->assertFalse($band->validate(['band_name']));

        $band->created_at = '2018-12-22';
        $this->assertTrue($band->validate(['created_at']));

        $band->updated_at = '2018-12-22';
        $this->assertTrue($band->validate(['updated_at']));
        
    }

    /*
     * Band model
     * Saving/Updating test
     */
    public function testSavingBand()
    {
        $band = new Band();

        $band->band_name = 'Toto Cotugno4';
        $band->created_at = '2018-12-22';
        $band->updated_at = '2018-12-22';
        $band->save();
        $this->assertEquals('Toto Cotugno4', $band->band_name);
    }

    /*
     * Band model
     * Saving/Updating - Deleting test
     */
    public function testSavingDeletingBand()
    {
        $band = new Band();

        $band->band_name = 'Toto Cotugno5';
        $band->created_at = '2018-12-22';
        $band->updated_at = '2018-12-22';
        $band->save();
        $this->assertEquals('Toto Cotugno5', $band->band_name);
        $band->delete();
        $isBand = Band::findOne(['band_name' => 'Toto Cotugno5']) !== null;
        $this->assertEquals($isBand, false);
    }
}