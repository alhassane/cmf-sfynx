<?php
/**
 * This file is part of the <name> project.
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BootStrap\MediaBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use BootStrap\MediaBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;

/**
 * This file has been generated by the EasyExtends bundle ( http://sonata-project.org/easy-extends )
 *
 * References :
 *   bundles : http://symfony.com/doc/current/book/bundles.html
 *
 * @author Etienne de Longeaux <etienne.delongeaux@gmail.com>
 */
class BootStrapMediaBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'SonataMediaBundle';
    }
    
    /**
     * Builds the bundle.
     *
     * It is only ever called once when the cache is empty.
     *
     * This method can be overridden to register compilation passes,
     * other extensions, ...
     *
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $container->addCompilerPass(new OverrideServiceCompilerPass());
        
//          if (!empty($_SERVER['HTTP_HOST']))
//              $url  = dirname('http://'. $_SERVER['HTTP_HOST'] . $_SERVER["SCRIPT_NAME"]);
//          elseif (!empty($_SERVER['SERVER_NAME']))
//              $url  = dirname('//'. $_SERVER['SERVER_NAME'] . $_SERVER["SCRIPT_NAME"]);
//          elseif (!empty($_SERVER['PHP_SELF']))
//              $url = substr(dirname($_SERVER['PHP_SELF']),0, -1);
//          else
//              $url = "//www.monsite.com";
         
//          $url = str_replace("http:", "", $url);
//          $url = str_replace("https:", "", $url);
         
//         $container->setParameter('kernel.http_host', $url);
        
        $container->setParameter('kernel.http_host', '');
        //$container->setParameter('sonata.media.provider.file.class.class', 'BootStrap\MediaBundle\Provider\FileProvider');
        //$container->setParameter('sonata.media.thumbnail.format', 'BootStrap\MediaBundle\Thumbnail\FormatThumbnail');
    }
    
    /**
     * Boots the Bundle.
     */
    public function boot()
    {
        //print_r('PiApptest2');
    }    
    
    /**
     * Shutdowns the Bundle.
     */
    public function shutdown()
    {
    }    
}