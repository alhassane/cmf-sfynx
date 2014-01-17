<?php
/**
 * This file is part of the <Admin> project.
 *
 * @category   Admin_Repositories
 * @package    Repository
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 * @since 2011-12-28
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PiApp\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;
use BootStrap\TranslationBundle\Repository\TranslationRepository;

/**
 * Tag Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 * 
 * @category   Admin_Repositories
 * @package    Repository
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class TagRepository extends TranslationRepository
{
    /**
     * Gets all groupname of tag.
     *
     * @return array
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-03-28
     */
    public function getArrayAllGroupName($locale)
    {
        $query = $this->createQueryBuilder('t')
        ->select('t.groupname')
        ->where('t.enabled = :enabled')
        ->setParameters(array(
                'enabled'    => 1,
        ))
        ->getQuery();
        
        $result = array();
        $data     = $this->findTranslationsByQuery($locale, $query, 'array', true);
        
        if ($data && is_array($data) && count($data)) {
            foreach ($data as $row) {
                if (!empty($row['groupname']))
                    $result[ $row['groupname'] ] = $row['groupname'];
            }
        }
        return $result;
    }
        
}