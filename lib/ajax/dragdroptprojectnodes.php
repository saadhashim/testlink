<?php
/** 
* 	TestLink Open Source Project - http://testlink.sourceforge.net/
* 
* 	@version 	$Id: dragdroptprojectnodes.php,v 1.3 2010/12/01 14:37:08 asimon83 Exp $
* 	@author 	Francisco Mancardi
* 
*   manage drag and drop on test project tree
*
*   Development Notes:
*   This code is called by javascript function writeNodePositionToDB() present
*   in javascript file with all function used to manage EXTJS tree.
*
*   rev: 20080605 - franciscom
*        
*/
require_once('../../config.inc.php');
require_once('common.php');
testlinkInitPage($db);


// check if this is really needed
$exclude_node_types=array('testplan' => 1, 'requirement' => 1, 'requirement_spec' => 1);

$args=init_args();
$treeMgr = new tree($db);

switch($args->doAction)
{
    case 'changeParent':
        $treeMgr->change_parent($args->nodeid,$args->newparentid);
    break;

    case 'doReorder':
        $dummy=explode(',',$args->nodelist);
        $treeMgr->change_order_bulk($dummy);
    break;
}




function init_args()
{
	// BUGID 4066 - take care of proper escaping when magic_quotes_gpc is enabled
	$_REQUEST=strings_stripSlashes($_REQUEST);
    
	$args=new stdClass();
    
    $key2loop=array('nodeid','newparentid','doAction',
                    'top_or_bottom','nodeorder','nodelist');
    
    foreach($key2loop as $key)
    {
        $args->$key=isset($_REQUEST[$key]) ? $_REQUEST[$key] : null;   
    }
    return $args;
}
?>

                                                                                              