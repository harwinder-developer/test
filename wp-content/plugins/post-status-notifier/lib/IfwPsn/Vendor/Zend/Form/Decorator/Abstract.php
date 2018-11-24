<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    IfwPsn_Vendor_Zend_Form
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */

/** IfwPsn_Vendor_Zend_Form_Decorator_Interface */
require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Vendor/Zend/Form/Decorator/Interface.php';

/**
 * IfwPsn_Vendor_Zend_Form_Decorator_Abstract
 *
 * @category   Zend
 * @package    IfwPsn_Vendor_Zend_Form
 * @subpackage Decorator
 * @copyright  Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Abstract.php 481 2015-11-03 13:28:23Z timoreithde $
 */
abstract class IfwPsn_Vendor_Zend_Form_Decorator_Abstract implements IfwPsn_Vendor_Zend_Form_Decorator_Interface
{
    /**
     * Placement constants
     */
    const APPEND  = 'APPEND';
    const PREPEND = 'PREPEND';

    /**
     * Default placement: append
     * @var string
     */
    protected $_placement = 'APPEND';

    /**
     * @var IfwPsn_Vendor_Zend_Form_Element|IfwPsn_Vendor_Zend_Form
     */
    protected $_element;

    /**
     * Decorator options
     * @var array
     */
    protected $_options = array();

    /**
     * Separator between new content and old
     * @var string
     */
    protected $_separator = PHP_EOL;

    /**
     * Constructor
     *
     * @param  array|IfwPsn_Vendor_Zend_Config $options
     * @return void
     */
    public function __construct($options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        } elseif ($options instanceof IfwPsn_Vendor_Zend_Config) {
            $this->setConfig($options);
        }
    }

    /**
     * Set options
     *
     * @param  array $options
     * @return IfwPsn_Vendor_Zend_Form_Decorator_Abstract
     */
    public function setOptions(array $options)
    {
        $this->_options = $options;
        return $this;
    }

    /**
     * Set options from config object
     *
     * @param  IfwPsn_Vendor_Zend_Config $config
     * @return IfwPsn_Vendor_Zend_Form_Decorator_Abstract
     */
    public function setConfig(IfwPsn_Vendor_Zend_Config $config)
    {
        return $this->setOptions($config->toArray());
    }

    /**
     * Set option
     *
     * @param  string $key
     * @param  mixed $value
     * @return IfwPsn_Vendor_Zend_Form_Decorator_Abstract
     */
    public function setOption($key, $value)
    {
        $this->_options[(string) $key] = $value;
        return $this;
    }

    /**
     * Get option
     *
     * @param  string $key
     * @return mixed
     */
    public function getOption($key)
    {
        $key = (string) $key;
        if (isset($this->_options[$key])) {
            return $this->_options[$key];
        }

        return null;
    }

    /**
     * Retrieve options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Remove single option
     *
     * @param mixed $key
     * @return void
     */
    public function removeOption($key)
    {
        if (null !== $this->getOption($key)) {
            unset($this->_options[$key]);
            return true;
        }

        return false;
    }

    /**
     * Clear all options
     *
     * @return IfwPsn_Vendor_Zend_Form_Decorator_Abstract
     */
    public function clearOptions()
    {
        $this->_options = array();
        return $this;
    }

    /**
     * Set current form element
     *
     * @param  IfwPsn_Vendor_Zend_Form_Element|IfwPsn_Vendor_Zend_Form $element
     * @return IfwPsn_Vendor_Zend_Form_Decorator_Abstract
     * @throws IfwPsn_Vendor_Zend_Form_Decorator_Exception on invalid element type
     */
    public function setElement($element)
    {
        if ((!$element instanceof IfwPsn_Vendor_Zend_Form_Element)
            && (!$element instanceof IfwPsn_Vendor_Zend_Form)
            && (!$element instanceof IfwPsn_Vendor_Zend_Form_DisplayGroup))
        {
            require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Vendor/Zend/Form/Decorator/Exception.php';
            throw new IfwPsn_Vendor_Zend_Form_Decorator_Exception('Invalid element type passed to decorator');
        }

        $this->_element = $element;
        return $this;
    }

    /**
     * Retrieve current element
     *
     * @return IfwPsn_Vendor_Zend_Form_Element|IfwPsn_Vendor_Zend_Form
     */
    public function getElement()
    {
        return $this->_element;
    }

    /**
     * Determine if decorator should append or prepend content
     *
     * @return string
     */
    public function getPlacement()
    {
        $placement = $this->_placement;
        if (null !== ($placementOpt = $this->getOption('placement'))) {
            $placementOpt = strtoupper($placementOpt);
            switch ($placementOpt) {
                case self::APPEND:
                case self::PREPEND:
                    $placement = $this->_placement = $placementOpt;
                    break;
                case false:
                    $placement = $this->_placement = null;
                    break;
                default:
                    break;
            }
            $this->removeOption('placement');
        }

        return $placement;
    }

    /**
     * Retrieve separator to use between old and new content
     *
     * @return string
     */
    public function getSeparator()
    {
        $separator = $this->_separator;
        if (null !== ($separatorOpt = $this->getOption('separator'))) {
            $separator = $this->_separator = (string) $separatorOpt;
            $this->removeOption('separator');
        }
        return $separator;
    }

    /**
     * Decorate content and/or element
     *
     * @param  string $content
     * @return string
     * @throws IfwPsn_Vendor_Zend_Form_Decorator_Exception when unimplemented
     */
    public function render($content)
    {
        require_once IFW_PSN_LIB_ROOT . 'IfwPsn/Vendor/Zend/Form/Decorator/Exception.php';
        throw new IfwPsn_Vendor_Zend_Form_Decorator_Exception('render() not implemented');
    }
}
