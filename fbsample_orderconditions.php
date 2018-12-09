<?php
/**
 * 2007-2017 Frédéric BENOIST
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    Frédéric BENOIST <http://www.fbenoist.com/>
 * @copyright 2013-2017 Frédéric BENOIST <contact@fbenoist.com>
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

if (!defined('_PS_VERSION_')) {
     exit;
}

use PrestaShop\PrestaShop\Core\Checkout\TermsAndConditions;

class FbSample_OrderConditions extends Module
{
    public function __construct()
    {
        $this->name = 'fbsample_orderconditions';
        $this->author = 'Frédéric BENOIST';
        $this->version = '1.0.0';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->tab = 'others';
        $this->ps_versions_compliancy = array(
            'min' => '1.7',
            'max' => _PS_VERSION_
        );
        parent::__construct();

        $this->displayName = $this->l('Add extra terms and conditions');
        $this->description = $this->l('Add extra terms and conditions in PrestaShop order process');
    }

    /**
     * Install module
     *
     * @return bool true if success
     */
    public function install()
    {
        if (!parent::install()
            || !$this->registerHook('termsAndConditions')
        ) {
            return false;
        }
        return true;
    }

    /**
     * Create new Terms and Conditions
     *
     * @param array $params hook call parameters (none)
     *
     * @return array of TermsAndConditions
     */
    public function hookTermsAndConditions($params)
    {
        $termsAndConditions = new TermsAndConditions();

        $termsAndConditions
            ->setText(
                $this->trans(
                    'I agree to the [Advanced terms of service] and will adhere to them unconditionally.',
                    array(),
                    'Shop.Theme.Checkout'
                ),
                'https://www.google.fr/intl/fr/policies/terms/regional.html'
            )
            ->setIdentifier('adv-terms-and-conditions');

        return array( $termsAndConditions);
    }
}
