<?php
/**
 * File contains the DocBlox_Core_Validator_File class
 *
 * @category   DocBlox
 * @package    Core
 * @subpackage Validator
 * @copyright  Copyright (c) 2010-2011 Mike van Riel / Naenius. (http://www.naenius.com)
 * @author     Ben Selby <benmatselby@gmail.com>
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 */

/**
 * This class is responsible for validating the file docbloc
 *
 * @category   DocBlox
 * @package    Core
 * @subpackage Validator
 * @copyright  Copyright (c) 2010-2011 Mike van Riel / Naenius. (http://www.naenius.com)
 * @author     Ben Selby <benmatselby@gmail.com>
 * @author     Mike van Riel <mike.vanriel@naenius.com>
 */
class DocBlox_Core_Validator_File extends DocBlox_Core_Abstract implements DocBlox_Core_Validator
{
    /**
     * Name of the file being validated
     *
     * @var string
     */
    protected $filename;

    /**
     * Docblock for the file
     *
     * @var DocBlox_Reflection_DocBlock
     */
    protected $docblock;

    /**
     * Constructor
     *
     * @param string                      $filename Filename
     * @param DocBlox_Reflection_DocBlock $docblock Docbloc
     */
    public function __construct($filename, DocBlox_Reflection_DocBlock $docblock)
    {
        $this->filename = $filename;
        $this->docblock = $docblock;
    }

    /**
     * Is the docbloc valid
     *
     * @see DocBlox_Core_Validator::isValid()
     *
     * @return boolean
     */
    public function isValid()
    {
        $valid = true;

        if (null == $this->docblock)
        {
            return false;
        }

        if (!$this->docblock->hasTag('package'))
        {
            $valid = false;
            $this->log('No Page-level DocBlock was found for '.$this->filename, Zend_Log::ERR);
        }

        if (count($this->docblock->getTagsByName('package')) > 1)
        {
            $this->log('File cannot have more than one @package tag', Zend_Log::CRIT);
        }

        if ($this->docblock->hasTag('subpackage') && !$this->docblock->hasTag('package'))
        {
            $this->log('File cannot have a @subpackage when a @package tag is not present', Zend_Log::CRIT);
        }

        return $valid;
    }
}