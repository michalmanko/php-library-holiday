<?php

/*
 * This file is part of the Holiday Library.
 *
 * (c) Michał Mańko <github@michalmanko.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Michalmanko\Holiday\Test;

use Michalmanko\Holiday\Holiday;

class DenmarkTest extends AbstractProviderTest
{
    public $providerCountryCode = 'DK';
    public $providerInstanceOf  = '\\Michalmanko\\Holiday\\Provider\\Denmark';

    public function dataProvider()
    {
        return array(
            array('Nytårsdag', Holiday::TYPE_HOLIDAY, array('2015-01-01', '2020-01-01')),
            array('Skærtorsdag', Holiday::TYPE_HOLIDAY, array('2015-04-02', '2020-04-09')),
            array('Langfredag', Holiday::TYPE_HOLIDAY, array('2015-04-03', '2020-04-10')),
            array('Påskedag', Holiday::TYPE_HOLIDAY, array('2015-04-05', '2020-04-12')),
            array('2. Påskedag', Holiday::TYPE_HOLIDAY, array('2015-04-06', '2020-04-13')),
            array('Store bededag', Holiday::TYPE_HOLIDAY, array('2015-05-01', '2020-05-08', '2025-05-16')),
            array(
                'Kristi himmelfartsdag',
                Holiday::TYPE_HOLIDAY,
                array('2015-05-14', '2020-05-21', '2025-05-29'),
            ),
            array('Pinsedag', Holiday::TYPE_HOLIDAY, array('2015-05-24', '2020-05-31', '2025-06-08')),
            array('2. Pinsedag', Holiday::TYPE_HOLIDAY, array('2015-05-25', '2020-06-01', '2025-06-09')),
            array('Grundlovsdag', Holiday::TYPE_HOLIDAY, array('2015-06-05', '2016-06-05')),
            array('Juledag', Holiday::TYPE_HOLIDAY, array('2015-12-25', '2020-12-25')),
            array('2. Juledag', Holiday::TYPE_HOLIDAY, array('2015-12-26', '2020-12-26')),
        );
    }
}
