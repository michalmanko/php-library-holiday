<?php

namespace Michalmanko\Holiday\Test;

use Michalmanko\Holiday;

class DenmarkTest extends AbstractProviderTest
{
    public $providerCountryCode = 'DK';
    public $providerInstanceOf  = '\\Michalmanko\\Holiday\\Provider\\Denmark';

    public function dataProvider()
    {
        return array(
            array('Nytårsdag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-01-01', '2020-01-01')),
            array('Skærtorsdag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-04-02', '2020-04-09')),
            array('Langfredag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-04-03', '2020-04-10')),
            array('Påskedag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-04-05', '2020-04-12')),
            array('2. Påskedag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-04-06', '2020-04-13')),
            array('Store bededag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-05-01', '2020-05-08', '2025-05-16')),
            array(
                'Kristi himmelfartsdag',
                Holiday\Holiday::TYPE_HOLIDAY,
                array('2015-05-14', '2020-05-21', '2025-05-29'),
            ),
            array('Pinsedag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-05-24', '2020-05-31', '2025-06-08')),
            array('2. Pinsedag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-05-25', '2020-06-01', '2025-06-09')),
            array('Grundlovsdag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-06-05', '2016-06-05')),
            array('Juledag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-12-25', '2020-12-25')),
            array('2. Juledag', Holiday\Holiday::TYPE_HOLIDAY, array('2015-12-26', '2020-12-26')),
        );
    }
}
