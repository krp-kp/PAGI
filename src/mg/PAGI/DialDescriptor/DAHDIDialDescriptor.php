<?php
/**
 * DAHDI Dial Descriptor class.
 *
 * PHP Version 5.3
 *
 * @category PAGI
 * @package  DialDescriptor
 * @author   Agustín Gutiérrez <agu.gutierrez@gmail.com>
 * @license  http://www.noneyet.ar/ Apache License 2.0
 * @version  SVN: $Id$
 * @link     http://www.noneyet.ar/
 */
namespace PAGI\DialDescriptor;

/**
 * DAHDI Dial Descriptor class.
 *
 * @category PAGI
 * @package  DialDescriptor
 * @author   Agustín Gutiérrez <agu.gutierrez@gmail.com>
 * @license  http://www.noneyet.ar/ Apache License 2.0
 * @link     http://www.noneyet.ar/
 *
 * @todo     shall we include more options?
 * see http://www.asteriskguide.com/mediawiki/index.php/Analog_Channels
 **/
class DAHDIDialDescriptor extends DialDescriptor
{
    const TECHNOLOGY = 'DAHDI';

    /**
     * Channel or group identifier.
     *
     * @var string
     */
    protected $identifier;

    /**
     * Is group identifier.
     *
     * @var bool
     */
    protected $isGroup;

    /**
     * (non-PHPdoc)
     * @see DialDescriptor::getChannelDescriptor()
     */
    public function getChannelDescriptor()
    {
        $descriptor = self::TECHNOLOGY .'/';
        if ($this->isGroup) {
            $descriptor .= $this->descendantOrder
                ? 'G'
                : 'g';
        }

        $descriptor .= $this->identifier.'/' .$this->target;

        return $descriptor;
    }

    /**
     * (non-PHPdoc)
     * @see DialDescriptor::getTechnology()
     */
    public function getTechnology()
    {
        return self::TECHNOLOGY;
    }
 
    /**
     * Class constructor.
     *
     * @param string  $target     dial target
     * @param integer $identifier channel/group identifier
     * @param bool    $isGroup    whether identifier refs a group
     */
    public function __construct($target, $identifier, $isGroup = true)
    {
        $this->target = $target;
        $this->identifier = $identifier;
        $this->isGroup = $isGroup;
    }

    /**
     * Set group to use.
     *
     * @param integer $group group of channels to use
     *
     * @return void
     */
    public function setGroup($group)
    {
        $this->identifier = $group;
        $this->isGroup = true;
    }

    /**
     * Set channel to use.
     *
     * @param integer $channel channel to use
     *
     * @return void
     */
    public function setChannel($channel)
    {
        $this->identifier = $channel;
        $this->isGroup = false;
    }

}
