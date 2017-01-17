<?php
namespace HTTP\Middleware;
use Slim\Middleware;

/**
 *
 */
class Before extends Middleware{

  public function call (){
    $this->app->hook('slim.before',[$this,'run']);
    $this->next->call();
  }

  public function run(){
    $this->app->baseUrl = $this->app->request->getScriptName();
    $this->app->referrer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : null;
    $this->IncludeTwigHelpers();
    $this->UserSessionHelper();
    #$this->CachingHelper();
  }

  public function IncludeTwigHelpers(){
    $app = $this->app;
    $twig = $this->app->view->getEnvironment();

    $function = new \Twig_SimpleFunction('assets', function ($path,$host = false) use($app) {
      if(substr($path,-1)==='/')
      {
        $path = substr($path,0,-1);
      }
      if(substr($path,0,1)==='/')
      {
        $path = substr($path,1);
      }
      return ($host) ? "http://".$_SERVER['HTTP_HOST'].$app->baseUrl."/public/".$path : $app->baseUrl."/public/".$path ;
    });

    $twig->addFunction( new \Twig_SimpleFunction('dump', function ($var){
        dump($var);
    }));
    $twig->addFunction($function);
  }

  public function UserSessionHelper()
  {
      $app = $this->app;
      try {
          if($app->request->get('access_token')){
              $access_token = $app->request->get('access_token');
              $app->setCookie('access_token',$access_token);
          }else{
              $access_token = $app->getCookie('access_token');
          }
          if($access_token){
              $userRequest = $this->app->Http->request('GET',$app->Config->get("auth.server")."/auth/user/{$access_token}");
              $response = json_decode($userRequest->getBody()->getContents());
              if($response && $response->authenticated){
                  $user = $response->user;
                  $this->app->auth = $user;
                  $this->app->view()->appendData([
                      "auth"=>$user
                  ]);
              }
          }else{
              $app->response->redirect($app->Config->get("auth.server").'/authorize?redirect_url=http://crm/authorize&response=code');
              return 0;
          }


      } catch (\Exception $e) {
          if($e->getResponse()->getStatusCode() == 403 ){
              $app->response->redirect($app->Config->get("auth.server").'/authorize?redirect_url=http://crm/authorize&response=code');
              return 0;
          }
      }
  }

  public function CachingHelper()
  {
    $this->app->lastModified(strtotime($this->app->siteInfo->last_modified));
    $this->app->expires('+1 year');
  }

}

 ?>
