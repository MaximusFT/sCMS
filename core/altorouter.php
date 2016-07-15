<?php

class AltoRouter {

	private $db;
	protected $routes = array();
	protected $namedRoutes = array();
	protected $basePath = '';
	protected $matchTypes = array(
		'i'  => '[0-9]++',
		'a'  => '[0-9A-Za-z]++',
		'h'  => '[0-9A-Fa-f]++',
		'*'  => '.+?',
		'**' => '.++',
		''   => '[^/\.]++'
	);

	/**
	  * Create router in one call from config.
	  *
	  * @param array $routes
	  * @param string $basePath
	  * @param array $matchTypes
	  */
	public function __construct( $routes = array(), $basePath = '', $matchTypes = array() ) {
		$this->addRoutes($routes);
		$this->setBasePath($basePath);
		$this->addMatchTypes($matchTypes);
		$this->breadcrumb = [];
		$this->lang = USER_LANG;
		$this->db = new medoo();
	}

	/**
	 * Retrieves all routes.
	 * Useful if you want to process or display routes.
	 * @return array All routes.
	 */
	public function getRoutes() {
		return $this->routes;
	}

	public function getRoutesNamed() {
		foreach ($this->routes as $key => $value) {
			$this->routesNamed[$key]['url'] = $this->basePath.$value[1];
			$this->routesNamed[$key]['function'] = $value[2];
			$this->routesNamed[$key]['menuId'] = $value[6];
			$this->routesNamed[$key]['categoryId'] = $value[7];
			$this->routesNamed[$key]['articleId'] = $value[8];
			$this->routesNamed[$key]['title'] = $value[9];
		}
		return $this->routesNamed;
	}

	/**
	 * Add multiple routes at once from array in the following format:
	 *
	 *   $routes = array(
	 *      array($method, $route, $target, $name)
	 *   );
	 *
	 * @param array $routes
	 * @return void
	 * @author Koen Punt
	 */
	public function addRoutes($routes){
		if(!is_array($routes) && !$routes instanceof Traversable) {
			throw new \Exception('Routes should be an array or an instance of Traversable');
		}
		foreach($routes as $route) {
			call_user_func_array(array($this, 'map'), $route);
		}
	}

	/**
	 * Set the base path.
	 * Useful if you are running your application from a subdirectory.
	 */
	public function setBasePath($basePath) {
		$this->basePath = $basePath;
	}

	/**
	 * Add named match types. It uses array_merge so keys can be overwritten.
	 *
	 * @param array $matchTypes The key is the name and the value is the regex.
	 */
	public function addMatchTypes($matchTypes) {
		$this->matchTypes = array_merge($this->matchTypes, $matchTypes);
	}

	/**
	 * Map a route to a target
	 *
	 * @param string $method One of 5 HTTP Methods, or a pipe-separated list of multiple HTTP Methods (GET|POST|PATCH|PUT|DELETE)
	 * @param string $route The route regex, custom regex must start with an @. You can use multiple pre-set regex filters, like [i:id]
	 * @param mixed $target The target where this route should point to. Can be anything.
	 * @param string $name Optional name of this route. Supply if you want to reverse route this url in your application.
	 */
	public function map($method, $route, $target, $name = null, $id = null, $type = 'view', $menuId = null, $catId = null, $artId = null) {

		$this->routes[] = array($method, $route, $target, $name, $id, $type, $menuId, $catId, $artId, $itemTitle);

		if($name) {
			if(isset($this->namedRoutes[$name])) {
				throw new \Exception("Can not redeclare route '{$name}'");
			} else {
				$this->namedRoutes[$name] = $route;
			}

		}

		return;
	}


	private function categoryChildren($params, $res, $someID, $rez, $check) {
	    foreach($params as $key => $value) {
	        foreach($value as $key => $index) {
	            if($key == 'id' && $check == 1) $rez[] = $res[$value['id']]['id'];
                if(is_array($index)) {
            		if($value['id'] == $someID) {
            			$check = 1;
            			// $rez['aaa'] = $res[$value['id']]['id'];
                		$rez = $this->categoryChildren($index, $res, $someID, $rez, $check);
	    				return $rez;
            		}
                	$rez = $this->categoryChildren($index, $res, $someID, $rez, $check);
                }
	        }
	    }
	    return $rez;
	}

	private function recursCategory($array, $res, $articleList, $firstId, $menu) {
	    foreach($array as $key => $value) {
	        $i = 0;
	        foreach($value as $key => $index) {
	            $i++;
	            if(is_array($index)) {
	                $this->recursCategory($index, $res, $articleList, $firstId, $menu);
	            } else {
			    	if ($index != $firstId) {
						$this->routes[] = [
							'GET',
							$res[$index]['path'],
							'comCategoryOnePageCtrl',
							'',
							$res[$index]['id'],
							'view',
							$menu['id'],
							$res[$index]['id'],
							'',
							$res[$index]['title']
						];
						$catResParams = json_decode($res[$index]['params'], true);
					    foreach ($articleList as $articleVal) {
					    	if ($articleVal['category_id'] == $res[$index]['id']) {
						    	if ($catResParams['noPath'] === true) {
						    		$articlePath = '/'.$articleVal['alias'].'/';
						    	} else {
						    		$articlePath = $res[$index]['path'].$articleVal['alias'].'/';
						    	}
								$this->routes[] = [
									'GET',
									$articlePath,
									'comArticleOnePageCtrl',
									'',
									$res[$index]['id'],
									'view',
									$menu['id'],
									$res[$index]['id'],
									$articleVal['id'],
									$articleVal['h1']
								];
					    	}
						}
			    	}
	            }
	        }
	    }
	}

	/**
	 * Map a AUTO route to a target by MySQL request
	 *
	 * @param string $method One of 5 HTTP Methods, or a pipe-separated list of multiple HTTP Methods (GET|POST|PATCH|PUT|DELETE)
	 * @param string $route The route regex, custom regex must start with an @. You can use multiple pre-set regex filters, like [i:id]
	 * @param mixed $target The target where this route should point to. Can be anything.
	 * @param string $name Optional name of this route. Supply if you want to reverse route this url in your application.
	 */
	public function mapdb() {
		/* Все статьи */
		$tempArticleRes = $this->db->select("content", '*', [
		    "AND" => [
		        "content.lang" => $this->lang,
		        "content.published" => 1
		    ],
		    "ORDER" => "content.publish_up DESC"
		]);
		foreach ($tempArticleRes as $key => $value) {
			$articleRes[$value['id']] = $value;
		}

		$menuRes = $this->db->select("menu", [
	        	"[>]extension" => ["menu.extension_id" => "id"],
	        	"[>]category" => ["menu.category_id" => "id"],
		    ], [
		        "menu.id",
		        "menu.menutype_id",
		        "menu.extension_id",
		        "menu.category_id",
		        "menu.link_id",
		        "menu.method",
		        "menu.title",
		        "menu.path",
		        "menu.params",
		        "extension.function(extension_function)",
		        "category.categorytype_id(category_categorytype_id)",
		        "category.params(category_params)",
		    ], [
				"AND" => [
					"menu.lang" => $this->lang,
					"menu.published" => 1
					]
				]
			);

	    // echo $this->db->last_query();
    	// var_dump($this->db->error());

	    foreach ($menuRes as $menuValue) {
			if ($menuValue['extension_id'] == 1 || $menuValue['extension_id'] == 2) {
				$this->routes[] = [
					$menuValue['method'],
					$menuValue['path'],
					$menuValue['extension_function'],
					$menuValue['link_id'],
					$menuValue['id'],
					'view',
					$menuValue['id'],
					'',
					$menuValue['link_id'],
					$menuValue['title']
				];
			} elseif ($menuValue['extension_id'] == 4) {
				$this->routes[] = [
					$menuValue['method'],
					$menuValue['path'],
					$menuValue['extension_function'],
					'',
					$menuValue['id'],
					'view',
					$menuValue['id'],
					$menuValue['category_id'],
					'',
					$menuValue['title']
				];

				$menuCatParams = json_decode($menuValue['category_params'], true);
			    foreach ($articleRes as $articleVal) {
			    	if ($articleVal['category_id'] == $menuValue['category_id']) {
				    	if ($menuCatParams['noPath'] === true) {
				    		$articlePath = '/'.$articleVal['alias'].'/';
				    	} else {
				    		$articlePath = $menuValue['path'].$articleVal['alias'].'/';
				    	}
						$this->routes[] = [
							'GET',
							$articlePath,
							'comArticleOnePageCtrl',
							$articleVal['id'],
							$menuValue['id'],
							'view',
							$menuValue['id'],
							$articleVal['category_id'],
							$articleVal['id'],
							$articleVal['h1']
						];
			    	}
				}
			} elseif ($menuValue['extension_id'] == 5) {
				$catTypeRes = $this->db->get("categorytype", "*",
					[
						"AND" => [
							"id" => $menuValue['category_id'],
							"lang" => $this->lang,
						]
					]
				);

				$catTypeResParams = json_decode($catTypeRes['params'], true);
				$catResFirstId = $catTypeResParams[0]['id'];
				$catResFirst = $this->db->get("category", "*", ["id" => $catResFirstId]);

				$this->routes[] = [
					'GET',
					$menuValue['path'],
					'comCategoryOnePageCtrl',
					'',
					$menuValue['id'],
					'view',
					$menuValue['id'],
					$catResFirstId,
					'',
					$catResFirst['title']
				];

		    	$catResFirstParams = json_decode($catResFirst['params'], true);
			    foreach ($articleRes as $articleVal) {
			    	if ($articleVal['category_id'] == $catResFirst['id']) {
						if ($catResFirstParams['noPath'] === true) {
							$articlePath = '/'.$articleVal['alias'].'/';
						} else {
							$articlePath = $catResFirst['path'].$articleVal['alias'].'/';
						}
						$this->routes[] = [
							'GET',
							$articlePath,
							'comArticleOnePageCtrl',
							$articleVal['id'],
							$menuValue['id'],
							'view',
							$menuValue['id'],
							$catResFirstId,
							$articleVal['id'],
							$articleVal['h1']
						];
			    	}
				}

				$catRes_alt = $this->db->select("category", "*",
					[
						"AND" => [
							"categorytype_id" => $catTypeRes['id'],
							"path[!]" => null,
							"published" => 1
						]
					]
				);
			    foreach ($catRes_alt as $key => $value) {
			        $catRes[$value['id']] = $value;
			    }

				$recursCatRoute = $this->recursCategory($catTypeResParams, $catRes, $articleRes, $catResFirstId, $menuValue);
			} elseif ($menuValue['extension_id'] == 6) {
				$this->routes[] = [
					$menuValue['method'],
					$menuValue['path'],
					$menuValue['extension_function'],
					'',
					$menuValue['id'],
					'view',
					$menuValue['id'],
					$menuValue['category_id'],
					$menuValue['link_id'],
					$menuValue['title']
				];
			} else {
				$this->routes[] = [
					$menuValue['method'],
					$menuValue['path'],
					$menuValue['extension_function'],
					'',
					$menuValue['id'],
					'view',
					$menuValue['id'],
					$menuValue['category_id'],
					'',
					$menuValue['title']
				];
			}
	    }

		$this->routes[] = [
			'GET',
			'/sitemap.xml',
			'comSitemapXLMPageCtrl',
			'',
			'',
			'view',
			'',
			'',
			'',
			''
		];

		return;
	}

	/**
	 * Reversed routing
	 *
	 * Generate the URL for a named route. Replace regexes with supplied parameters
	 *
	 * @param string $routeName The name of the route.
	 * @param array @params Associative array of parameters to replace placeholders with.
	 * @return string The URL of the route with named parameters in place.
	 */
	public function generate($routeName, array $params = array()) {

		// Check if named route exists
		if(!isset($this->namedRoutes[$routeName])) {
			throw new \Exception("Route '{$routeName}' does not exist.");
		}

		// Replace named parameters
		$route = $this->namedRoutes[$routeName];

		// prepend base path to route url again
		$url = $this->basePath . $route;

		if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {

			foreach($matches as $match) {
				list($block, $pre, $type, $param, $optional) = $match;

				if ($pre) {
					$block = substr($block, 1);
				}

				if(isset($params[$param])) {
					$url = str_replace($block, $params[$param], $url);
				} elseif ($optional) {
					$url = str_replace($pre . $block, '', $url);
				}
			}


		}

		return $url;
	}

	/**
	 * Match a given Request Url against stored routes
	 * @param string $requestUrl
	 * @param string $requestMethod
	 * @return array|boolean Array with route information on success, false on failure (no match).
	 */
	public function match($requestUrl = null, $requestMethod = null) {

		$params = array();
		$match = false;
		$notLng = false;

		// set Request Url if it isn't passed as parameter
		if($requestUrl === null) {
			$requestUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
		}

		// strip base path from request url
		$pos2 = stripos($requestUrl, $this->basePath);
		if ($pos2 !== false) {
			$requestUrl = substr($requestUrl, strlen($this->basePath));
		} else {
			if (IS_LANG === true) {
				$notLng = true;
			}
		}

		// Strip query string (?a=b) from Request Url
		if (($strpos = strpos($requestUrl, '?')) !== false) {
			$requestUrl = substr($requestUrl, 0, $strpos);
		}

		// set Request Method if it isn't passed as a parameter
		if($requestMethod === null) {
			$requestMethod = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';
		}

		// Force request_order to be GP
		// http://www.mail-archive.com/internals@lists.php.net/msg33119.html
		$_REQUEST = array_merge($_GET, $_POST);

		foreach($this->routes as $handler) {
			list($method, $_route, $target, $name, $id, $fileType, $menuId, $catId, $artId, $itemTitle) = $handler;

			$methods = explode('|', $method);
			$method_match = false;

			// Check if request method matches. If not, abandon early. (CHEAP)
			foreach($methods as $method) {
				if (strcasecmp($requestMethod, $method) === 0) {
					$method_match = true;
					break;
				}
			}

			// Method did not match, continue to next route.
			if(!$method_match) continue;

			// Check for a wildcard (matches all)
			if ($_route === '*') {
				$match = true;
			} elseif (isset($_route[0]) && $_route[0] === '@') {
				$pattern = '`' . substr($_route, 1) . '`u';
				$match = preg_match($pattern, $requestUrl, $params);
			} else {
				$route = null;
				$regex = false;
				$j = 0;
				$n = isset($_route[0]) ? $_route[0] : null;
				$i = 0;

				// Find the longest non-regex substring and match it against the URI
				while (true) {
					if (!isset($_route[$i])) {
						break;
					} elseif (false === $regex) {
						$c = $n;
						$regex = $c === '[' || $c === '(' || $c === '.';
						if (false === $regex && false !== isset($_route[$i+1])) {
							$n = $_route[$i + 1];
							$regex = $n === '?' || $n === '+' || $n === '*' || $n === '{';
						}
						if (false === $regex && $c !== '/' && (!isset($requestUrl[$j]) || $c !== $requestUrl[$j])) {
							continue 2;
						}
						$j++;
					}
					$route .= $_route[$i++];
				}

				$regex = $this->compileRoute($route);
				$match = preg_match($regex, $requestUrl, $params);
			}

			if(($match == true || $match > 0)) {
				if ($notLng == true) {
					return [
						'header' => 301,
					];
				}

				if($params) {
					foreach($params as $key => $value) {
						if(is_numeric($key)) unset($params[$key]);
					}
				}

				$resMenuSimple = $this->db->select("menu", '*', [
					"AND" => [
						"lang" => $this->lang,
						"published" => 1
						]
				]);
				$resMenus = $this->db->select("menutype", '*', [
						"lang" => $this->lang,
					]);
				foreach ($resMenus as $key => $value) {
					$qTmp = $this->db->select("menu", '*', [
						"AND" => [
							"menutype_id" => $value['id'],
							"published" => 1
							]
					]);
					$Menus[$value['name']]['params'] = $value['params'];
					foreach ($qTmp as $key => $val) {
						$Menus[$value['name']]['items'][$val['id']] = $val;
						if ($val['home'] == 1) {
							$menuItemHome = $val;
						}
					}
				}

				$resCategory = $this->db->select("categorytype", '*', [
						"lang" => $this->lang,
					]);
				foreach ($resCategory as $key => $value) {
					$qTmp = $this->db->select("category", '*', [
						"AND" => [
							"categorytype_id" => $value['id'],
							"published" => 1
							]
					]);
					$Categoryes[$value['id']]['id'] = $value['id'];
					$Categoryes[$value['id']]['name'] = $value['name'];
					$Categoryes[$value['id']]['published'] = $value['published'];
					$Categoryes[$value['id']]['params'] = $value['params'];
					foreach ($qTmp as $key => $val) {
						$Categoryes[$value['id']]['items'][$val['id']] = $val;
					}
				}

				$resMenu = $this->db->get("menu", '*', [
					"AND" => [
						"id" => $menuId,
						"published" => 1
						]
					]
				);
				$resMenu['params'] = json_decode($resMenu['params']);

				$resMenu['extension'] = $this->db->get("extension", '*', ["id" => $resMenu['extension_id']]);
				$resMenu['extension']['params'] = json_decode($resMenu['extension']['params']);

				if ($resMenu['extension_id'] == 5) {
					$resMenu['categorytype'] = $this->db->get("categorytype", '*', ["id" => $resMenu['category_id']]);
					$tempParams = json_decode($resMenu['categorytype']['params'], true);
					$resMenu['category'] = $this->db->get("category", '*', ["id" => $catId]);

					$resMenu['category']['children_id'] = $this->categoryChildren($tempParams, $Categoryes[$resMenu['categorytype']['id']]['items'], $catId);
					$resMenu['category']['params'] = json_decode($resMenu['category']['params']);
				} elseif ($resMenu['extension_id'] == 4) {
					$resMenu['category'] = $this->db->get("category", '*', ["id" => $catId]);
					$resMenu['category']['params'] = json_decode($resMenu['category']['params']);
				} else {
					$resMenu['category'] = $this->db->get("category", '*', ["id" => $catId]);
					$resMenu['category']['params'] = json_decode($resMenu['category']['params']);
				}

				$resContent = $this->db->get("content", '*', [
					"id" => $artId
				]);
				$resContent = snippetPos($resContent);

				$routers = $this->getRoutesNamed();
				$resBreadcrumbs = explode('/', trim($requestUrl, '/'));
				$this->breadcrumb['home']['title'] = $menuItemHome['title'];
				$this->breadcrumb['home']['path'] = S_URLs.$this->basePath;
				$this->breadcrumb['home']['menuId'] = $menuItemHome['id'];
				$this->breadcrumb['home']['categoryId'] = $menuItemHome['category_id'];
				$this->breadcrumb['home']['articleId'] = $menuItemHome['link_id'];
				foreach ($resBreadcrumbs as $valueBC) {
					if (!$valueBC) {
						continue;
					}
					$curr = str_replace('//', '/', $prev.'/'.$valueBC.'/');
					$prev = $curr;
					foreach ($routers as $key => $valueRoute) {
						if (array_search($curr, $valueRoute, true)) {
							if (!empty($valueRoute['articleId']) && $resMenu['category']['params']->noPath === true) {
					    		$resBreadcrumbs = explode('/', trim($resMenu['category']['path'].(trim($valueRoute['url'], '/')), '/'));
					    		$tempBread['home'] = $this->breadcrumb['home'];
								foreach ($resBreadcrumbs as $valueBCs) {
									if (!$valueBCs) {
										continue;
									}
									$currS = str_replace('//', '/', $prevS.'/'.$valueBCs.'/');
									$prevS = $currS;
									foreach ($routers as $keys => $valueRoutes) {
										if ($valueBC === $valueBCs) {
											$tempBread[$valueBCs]['2'] = 2;
											$tempBread[$valueBCs]['title'] = $valueRoute['title'];
											$tempBread[$valueBCs]['path'] = S_URLs.$this->basePath.$valueRoute['url'];
											$tempBread[$valueBCs]['menuId'] = $valueRoute['menuId'];
											$tempBread[$valueBCs]['categoryId'] = $valueRoute['categoryId'];
											$tempBread[$valueBCs]['articleId'] = $valueRoute['articleId'];
										} else {
											if (array_search($currS, $valueRoutes, true)) {
												$tempBread[$valueBCs]['3'] = 3;
												$tempBread[$valueBCs]['title'] = $valueRoutes['title'];
												$tempBread[$valueBCs]['path'] = S_URLs.$this->basePath.$currS;
												$tempBread[$valueBCs]['menuId'] = $valueRoutes['menuId'];
												$tempBread[$valueBCs]['categoryId'] = $valueRoutes['categoryId'];
												$tempBread[$valueBCs]['articleId'] = $valueRoutes['articleId'];
											}
									 	}
						    		}
					    		}
					    		unset($this->breadcrumb);
					    		$this->breadcrumb = $tempBread;
					    		break;
							} else {
								$this->breadcrumb[$valueBC]['1'] = 1;
								$this->breadcrumb[$valueBC]['title'] = $valueRoute['title'];
								$this->breadcrumb[$valueBC]['path'] = S_URLs.$this->basePath.$curr;
								$this->breadcrumb[$valueBC]['menuId'] = $valueRoute['menuId'];
								$this->breadcrumb[$valueBC]['categoryId'] = $valueRoute['categoryId'];
								$this->breadcrumb[$valueBC]['articleId'] = $valueRoute['articleId'];
						 	}
						}
					}
				}
				/**
				 * $url
				 * $path
				 * $title
				 */

				return [
					'routerCurrent' => [
						'basePath' => $this->basePath,
						'requestUrl' => $requestUrl,
						'method' => $method,
						'url' => $this->basePath.$requestUrl,
						'target' => $target,
						'id' => $id,
						'name' => $name,
						'fileType' => $fileType,
						'menuId' => $menuId,
						'catId' => $catId,
						'artId' => $artId,
						'params' => $params,
					],
					'extensionCurrent' => $resMenu['extension'],
					'categoryTypeCurrent' => $resMenu['categorytype'],
					'categoryCurrent' => $resMenu['category'],
					'menuItemCurrent' => $resMenu,
					'contentCurrent' => $resContent,
					'menuItems' => $Menus,
					'menuItemHome' => $menuItemHome,
					'categoryItems' => $Categoryes,
					/* NOT DELETE NEED FOR SADMIN */
					'target' => $target,
					'method' => $method,
					'name' => $name,
					'params' => $params,
					'routers' => $routers,
					'breadcrumb' => $this->breadcrumb,
				];
			}
		}

		$resMenus = $this->db->select("menutype", '*', [
				"lang" => $this->lang,
			]);
		foreach ($resMenus as $key => $value) {
			$qTmp = $this->db->select("menu", '*', [
				"AND" => [
					"menutype_id" => $value['id'],
					"published" => 1
					]
			]);
			$Menus[$value['name']]['params'] = $value['params'];
			foreach ($qTmp as $key => $val) {
				$Menus[$value['name']]['items'][$val['id']] = $val;
			}
		}

		return [
			'header' => 404,
			'routerCurrent' => [
				'basePath' => $this->basePath,
				'requestUrl' => $requestUrl,
				'method' => $method,
				'url' => $this->basePath.$requestUrl,
				'target' => $target,
				'id' => $id,
				'name' => $name,
				'fileType' => $fileType,
				'menuId' => $menuId,
				'catId' => $catId,
				'artId' => $artId,
				'params' => $params,
			],
			'extensionCurrent' => [
				'fileName' => P_HTML.'404-'.USER_LANG.'.php',
			],
			'menuItems' => $Menus,
			'routers' => $this->getRoutesNamed(),
		];
	}

	/**
	 * Compile the regex for a given route (EXPENSIVE)
	 */
	private function compileRoute($route) {
		if (preg_match_all('`(/|\.|)\[([^:\]]*+)(?::([^:\]]*+))?\](\?|)`', $route, $matches, PREG_SET_ORDER)) {

			$matchTypes = $this->matchTypes;
			foreach($matches as $match) {
				list($block, $pre, $type, $param, $optional) = $match;

				if (isset($matchTypes[$type])) {
					$type = $matchTypes[$type];
				}
				if ($pre === '.') {
					$pre = '\.';
				}

				//Older versions of PCRE require the 'P' in (?P<named>)
				$pattern = '(?:'
						. ($pre !== '' ? $pre : null)
						. '('
						. ($param !== '' ? "?P<$param>" : null)
						. $type
						. '))'
						. ($optional !== '' ? '?' : null);

				$route = str_replace($block, $pattern, $route);
			}

		}
		return "`^$route$`u";
	}
}
