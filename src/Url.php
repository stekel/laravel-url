<?php
 
namespace stekel\LaravelUrl;
 
class Url {
     
    /**
     * Parameters
     *
     * @var array|mixed
     */
    protected $parameters;
     
    /**
     * Route name prefix
     *
     * @var string
     */
    protected $prefix;
    
    /**
     * Additional routes
     *
     * @var array
     */
    protected $routes;
     
    /**
     * Construct
     *
     * @param  array|mixed $parameters
     * @param  string      $prefix
     * @param  array       $routes
     * @return void
     */
    public function __construct($parameters, $prefix='', $routes=null) {
         
        $this->parameters = $parameters;
        $this->routes = $routes;
         
        $object = is_array($parameters) ? array_first($parameters) : $parameters;
         
        $this->prefix = ($prefix == '') ? $object->getTable() : $prefix;
    }
     
    /**
     * Magic Method: __get
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key) {
        
        $routes = collect($this->routes);
        
        if ($routes->has($key)) {
            
            return $routes->get($key);
        }
        return (method_exists($this, $key)) ? $this->$key() : $this->$key;
    }
     
    /**
     * Create url
     *
     * @return string
     */
    public function create() {
         
        return route($this->prefix.'.create');
    }
     
    /**
     * Destory url
     *
     * @return string
     */
    public function destroy() {
         
        return route($this->prefix.'.destroy', $this->parameters);
    }
     
    /**
     * Edit url
     *
     * @return string
     */
    public function edit() {
         
        return route($this->prefix.'.edit', $this->parameters);
    }
     
    /**
     * Show url
     *
     * @return string
     */
    public function show() {
         
        return route($this->prefix.'.show', $this->parameters);
    }
     
    /**
     * Update url
     *
     * @return string
     */
    public function update() {
         
        return route($this->prefix.'.update', $this->parameters);
    }
}