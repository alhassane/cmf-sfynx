<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Repositories
 * @package    Repository
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2012-01-06
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use BootStrap\TranslationBundle\Repository\TranslationRepository;

/**
 * TranslationPage Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 * 
 * @category   Admin_Repositories
 * @package    Repository
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TranslationPageRepository extends TranslationRepository
{
    // Lang types
    const LANG_REFERENCE    = 'Reference';
    const LANG_TRADUCTION    = 'Traduction';
    const LANG_DEFAULT        = 'Default';
    
    // Page status
    const STATUS_DRAFT        = 'Draft';
    const STATUS_REVIEWED    = 'Reviewed';
    const STATUS_PUBLISH    = 'Published';
    const STATUS_HIDDEN        = 'Hidden';
    const STATUS_TRASH        = 'Trash';
    const STATUT_REFUSED    = 'Refused';
        
    /**
     * Return list of available lang status
     *
     * @return array
     * @access public
     * @static
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2011-12-28
     */
    public static function getAvailableLangStatus()
    {
        return array(
                self::LANG_REFERENCE    => 'pi.page.' . self::LANG_REFERENCE,
                self::LANG_TRADUCTION    => 'pi.page.' . self::LANG_TRADUCTION,
                self::LANG_DEFAULT        => 'pi.page.' . self::LANG_DEFAULT,
        );
    }
    
    /**
     * Return list of available status
     *
     * @return array
     * @access public
     * @static
     * 
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2011-12-28
     */
    public static function getAvailableStatus()
    {
        return array(
                self::STATUS_DRAFT      => 'pi.page.' . self::STATUS_DRAFT,
                self::STATUS_REVIEWED   => 'pi.page.' . self::STATUS_REVIEWED,
                self::STATUS_PUBLISH    => 'pi.page.' . self::STATUS_PUBLISH,
                self::STATUS_HIDDEN     => 'pi.page.' . self::STATUS_HIDDEN,
                self::STATUS_TRASH        => 'pi.page.' . self::STATUS_TRASH,
                self::STATUT_REFUSED    => 'pi.page.' . self::STATUT_REFUSED,
        );
    }
    
    public function getLatestPages($limit = null)
    {
        $qb = $this->createQueryBuilder('b')
        ->select('b, c')
        ->leftJoin('b.comments', 'c')
        ->addOrderBy('b.created_at', 'DESC');
    
        if (false === is_null($limit))
            $qb->setMaxResults($limit);
    
        return $qb->getQuery()->getResult();
    }
        
    public function getTags()
    {
        $blogTags = $this->createQueryBuilder('b')
        ->select('b.tags')
        ->getQuery()
        ->getResult();
    
        $tags = array();
        foreach ($blogTags as $blogTag)
        {
            $tags = array_merge(explode(",", $blogTag['tags']), $tags);
        }
    
        foreach ($tags as &$tag)
        {
            $tag = trim($tag);
        }
    
        return $tags;
    }
    
    public function getTagWeights($tags)
    {
        $tagWeights = array();
        if (empty($tags))
            return $tagWeights;
    
        foreach ($tags as $tag)
        {
            $tagWeights[$tag] = (isset($tagWeights[$tag])) ? $tagWeights[$tag] + 1 : 1;
        }
        // Shuffle the tags
        uksort($tagWeights, function() {
            return rand() > rand();
        });
    
        $max = max($tagWeights);
    
        // Max of 5 weights
        $multiplier = ($max > 5) ? 5 / $max : 1;
        foreach ($tagWeights as &$tag)
        {
            $tag = ceil($tag * $multiplier);
        }
    
        return $tagWeights;
    }    
}