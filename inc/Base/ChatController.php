<?php
/**
 * @package Book-Plugin
 */

namespace Inc\Base;

use Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;


/**
 * 
 */
class ChatController extends BaseController
{
    public $callbacks;

    public $subpages = array();
    
    public function register()
    {
        
        $option = get_option('book_plugin');
        $activated = isset( $option['chat_manager'] ) ? $option['chat_manager'] : false;

        if(! $activated){
            return;
        }

        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks();
        
        $this->setSubpages();

        $this->settings->addSubPages($this->subpages)->register();
        
    }

    public function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'book_plugin',
                'page_title' => 'Chat Manager',
                'menu_title' => 'Chat Manager',
                'capability' => 'manage_options',
                'menu_slug' => 'book_chat',
                'callback' => array( $this->callbacks, 'adminChat' )
            ),
        );
    }
}