<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();


?>
<!DOCTYPE html>
<html>

<head>
    <?php include 'header.php'; ?>
</head>

<body>

    <?php include 'nav.php'; ?>

    <main id="ceremony-info" class="main">
            <div class="container">
                <div id="header-container" class="row">
                  <img src="/img/travel.jpg">
                </div>
                <div class="info-text">
                    <h2>Travel Policy</h2>
                    <p>
                        There are some important details to coordinate prior to attending your Long Servce Award cerremonty.
                        Make sure you connect with your <a href="mailto:">Long Service Award contact</a> to confirm the
                        process for your organization.
                    </p>
                </div>

                <div>
                  <h3>Time Off</h3>
                    <p>
                      You'll need to speak with your supervisor to schedule a reasonable amount time off to attend the ceremony.
                    </p>
                    <p>
                      If you're travelling from outside of Great Victoria, your ministry will cover one night of hotel accomodation.
                    </p>
                    <p>
                      For those in Greater Victoria, your supervisor needs to approve your time off for the day of your ceremony.
                    </p>
                    <p>
                      Time off to attend the Long Service Awards is gratned without any impact on daily pay.
                    </p>
                  </div>


                <div>
                  <h3>Travel expenses / reimbursement</h3>
                    <p>
                        Travel expensse are reimbursed for you and your guest at Group I rates. Most employees will need to fill out
                        a FIN 10 Travel Voucher. Be sure to check with your Long Service Award contact to cinform the correct process
                        for your organization.
                    </p>
                    <p>
                      For more information check out the Core Policy on travel.
                    </p>
                  </div>


                <div id="travel-policy">
                  <div>
                      <img src="/img/travel1.jpg">
                  </div>
                    <div>
                        <h3>Policy Links</h3>
                        <p>
<ul>
  <li>
    Accommodation (hotel or private accommodation)
  </li>
  <li>
    Business Travel Accommodation Listing
  </li>
  <li>
    Transportation (airline, ferry , bus, vehicle, mileage)
  </li>
  <li>
    Taxi fares (for travel to/from the ceremony)
  </li>
  <li>
    Meals
  </li>
  <li>
    Miscellaneous expenses
  </li>
  <li>
    Combining Personal and LSA travel
  </li>
  <li>
    Group Defnitions
  </li>
  <li>
    Reimbursing Expenses
  </li>
</ul>
                        </p>
                    </div>
                </div>

            </div>

            <div id="page-footer" class="container">
            <div >
                <h4>Questions?</h4>
                <div>
                  <p>
                      Email YOURMINISTRY@gov.bc.ca or LongServiceAwards@gov.bc.ca
                    </p>
                  </div>
            </div>

            <div class="row">
                <h4>Territorial Acknowledgement</h4>
                <p>
                    The Long Service Award ceremonies take place in the territory of the Lekwungen Peoples, also known as Songhees and Esquimalt Nations.
                    We acknowledge with respect that the public servants these ceremonies honor live and work throughout B.C. on the traditional lands of
                    Indigenous peoples. The BC Public Service is deeply committed to <u>true and lasting reconciliation</u>.
                </p>

            </div>
          </div>
    </main>
</body>


</html>
