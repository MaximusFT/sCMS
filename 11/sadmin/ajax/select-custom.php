<?if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
header('Content-Type: application/json');
switch ($_GET['params']) {
	case 'menu-method':
		$array['GET']      =  'GET';
		$array['POST']     =  'POST';
		$array['GET|POST'] =  'GET|POST';
		break;
	
	case 'extension-type':
		$array['component'] =  'component';
		$array['module']    =  'module';
		$array['snippet']    =  'snippet';
		break;
	
	case 'module-position':
		$array['after-nav']          =  'after-nav';
		$array['container-top']      =  'container-top';
		$array['page-header-bottom'] =  'page-header-bottom';
		$array['breadcrumb']         =  'breadcrumb';
		$array['before-content-1']   =  'before-content-1';
		$array['before-content-2']   =  'before-content-2';
		$array['after-content-1']    =  'after-content-1';
		$array['after-content-2']    =  'after-content-2';
		$array['aside-1']            =  'aside-1';
		$array['aside-2']            =  'aside-2';
		$array['aside-3']            =  'aside-3';
		$array['container-bottom']   =  'container-bottom';
		$array['after-container']    =  'after-container';
		$array['footer-pos-left']    =  'footer-pos-left';
		$array['footer-pos-center']  =  'footer-pos-center';
		$array['footer-pos-right']   =  'footer-pos-right';
		$array['after-footer']       =  'after-footer';
		// $array['module']          =  'module';
		break;
	
	default:
		# code...
		break;
}
print json_encode($array);
?>