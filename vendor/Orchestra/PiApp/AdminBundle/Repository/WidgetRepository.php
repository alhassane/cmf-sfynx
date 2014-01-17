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
 * Widget Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 * 
 * @category   Admin_Repositories
 * @package    Repository
 * 
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class WidgetRepository extends TranslationRepository
{
    /**
     * Return all widgets which use the options given in parameters.
     *
     * @param string    $plugin
     * @param string    $action
     * @param string    $option
     *
     * @return \PiApp\AdminBundle\Entity\Widget
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-04-05
     */
    public function getWidgetByOptions($plugin, $action, $option)
    {
        $query = $this->createQueryBuilder('p')
        ->select('p')
        ->where('p.enabled = :enabled')
        ->andwhere('p.plugin = :plugin')
        ->andWhere('p.action = :action')
        ->andWhere('p.configXml LIKE :option')
        ->setParameters(array(
                'enabled'    => 1,
                'plugin'    => $plugin,
                'action'    => $action,
                'option'    => "%$option%",
        ));
    
        return $query;
    }
    
    /**
     * Return all widget of a block.
     *
     * @return \PiApp\AdminBundle\Entity\Widget
     * @access public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     * @since 2012-01-23
     */
    public function getAllWidgetsByBlock($id_block, $ord = "ASC")
    {
        $query = $this->createQueryBuilder('w')
        ->select('w, b')
        ->leftJoin('w.block', 'b')
        ->where('w.enabled = :enabled')
        ->andWhere('b.id = :blockID')
        ->orderBy('w.position', $ord)
        ->setParameters(array(
                'enabled'    => 1,
                'blockID'    => $id_block,
        ));
    
        return $query->getQuery();
    }    
    
    /**
     * Find all snippet
     *
     * @param int    $enabled
     * @return object
     * @access    public
     *
     * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
     */
    public function getAllSnippet($enabled = 1, $ord = "ASC")
    {
        $query = $this->createQueryBuilder('w')
        ->select('w')
        ->where('w.enabled = :enabled')
        ->Andwhere("w.block is NULL")
        ->orderBy('w.configCssClass', $ord)
        ->setParameters(array(
                'enabled'    => $enabled,
        ))
        ;
         
        return $query->getQuery()->getResult();
    }    
        
}