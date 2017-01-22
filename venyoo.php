<?php
# @version		$version 0.1 Amvis United Company Limited  $
# @copyright	Copyright (C) 2017 AUnited Co Ltd. All rights reserved.
# @license		Venyoo plugin licensed under MIT, see LICENSE.md
# Updated		22nd January 2017
#
# Site: http://aunited.ru
# Email: info@aunited.ru
# Phone
#
# Joomla! is free software. This version may have been modified pursuant
# to the GNU General Public License, and as distributed it includes or
# is derivative of works licensed under the GNU General Public License or
# other free or open source software licenses.
# See COPYRIGHT.php for copyright notices and details.


// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin');

class plgSystemvenyoo extends JPlugin
{
	function plgvenyoo(&$subject, $config)
	{		
		parent::__construct($subject, $config);
		$this->_plugin = JPluginHelper::getPlugin( 'system', 'venyoo' );
		$this->_params = new JParameter( $this->_plugin->params );
	}
	
	function onAfterRender()
	{
        $app = JFactory::getApplication();
        if($app->isAdmin())
        {
            return;
        }
		// Initialise variables
		$enabled 			= $this->params->get( 'enabled', '' );
		$id 					= $this->params->get( 'id', '' );

		//getting body code and storing as buffer
		$buffer = JResponse::getBody();
		
		$script	=  " ";

		//is it enabled?
		$javascript='';
        if ($enabled)	$javascript= $javascript.$script;


		$buffer = preg_replace ("/<\/body>/", $javascript."\n\n</body>", $buffer);
		
		//output the buffer
		JResponse::setBody($buffer);
		
		return true;
	}
}
?>
