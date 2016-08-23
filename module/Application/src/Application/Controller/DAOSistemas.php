<?php
/**
 * Created by PhpStorm.
 * User: jairj
 * Date: 17/08/2016
 * Time: 19:08
 */

namespace Application\Controller;
use Application\Model\Sistema;
use Zend\Http\Request;
use Zend\Paginator\Paginator;
use Application\Controller\SistemasController;
use Zend\View\Model\ViewModel;


class DAOSistemas extends SistemasController
{
    private $paginator;

    private $erroNaoenc="Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa.";
    private $danger='danger';

    /**
     * @return mixed
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    /**
     * @param mixed $paginator
     */
    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @return string
     */

    public function getErroEmail()
    {
        return $this->erroEmail;
    }

    /**
     * @return string
     */
    public function getErroNaoenc()
    {
        return $this->erroNaoenc;
    }

    /**
     * @return string
     */
    public function getDanger()
    {
        return $this->danger;
    }


    /**
     * @return mixed
     */
    public function getResp()
    {
        return $this->resp;
    }

    /**
     * @param mixed $resp
     */
    public function setResp($resp)
    {
        $this->resp = $resp;
    }



    public function pesquisarSistema(Request $request,$em)
    {

        $result = array();
        try {

            $descricao = $request->getQuery('descricao');
            $sigla = $request->getQuery('sigla');
            $email =$request->getQuery('email');
            $page =$request->getQuery('page');
            if($page==NULL)
                $page=1;

            if(!empty($email))
            {    $checkemail=$this->emailValido($email);
                if($checkemail==true)
                {
                    $sistema=new \Application\Model\Sistema();
                  
                    $paginator=$sistema->pesquisaSistema($descricao,$sigla,$email,$page,$em);
                    if($paginator->count()>0)
                    {
                        //$this->forward()
                        // ->toRoute('sistemas',array('action'=>'index','lista'=>$paginator));
                        $view=new ViewModel();
                        $view->setVariables(array('lista'=>$paginator,'email'=>$email));
                        return $view;

                    }

                    else
                    {
                        $result['resp']="Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa.";
                        $this->flashMessenger()->addErrorMessage($result["resp"]);
                        return new ViewModel( array('action' => 'index'));

                    }
                }
                else {

                    $result['resp']="E-mail inválido.";
                    $this->flashMessenger()->addErrorMessage($result["resp"]);
                    return new ViewModel( array('action' => 'index'));



                }
            }
            if(!empty($descricao)||!empty($sigla))
            {
                $sistema=new \Application\Model\Sistema();

                $paginator=$sistema->pesquisaSistema($descricao,$sigla,$email,$page,$em);
                if($paginator->count()>0)
                    return $paginator;
                else
                {
                    $result['resp']="Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa.";
                    $this->flashMessenger()->addErrorMessage($result["resp"]);
                    return new ViewModel( array('action' => 'index'));

                }



            }
            else
            {
                $result['resp']="Nenhum Sistema foi encontrado. Favor revisar os critérios da sua pesquisa.";
                $this->flashMessenger()->addErrorMessage($result["resp"]);
                return new ViewModel( array('action' => 'index'));

            }






            }
            catch (Exception $e)
            {
                $result=array();
                $result["resp"]=(String)$e;
                $this->flashMessenger()->addErrorMessage($result["resp"]);
                return new ViewModel( array('action' => 'index'));
            }

        /****
         * verificação se houve alguma requisicao via metodo HTTP
         * GET
         *
         */



        /****
         * verificação das variaveis se estão vazias
         * recebidas por GET anterior
         *
         */





    }
    public function emailValido($email)
    {
        if (preg_match("^[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\-]+\.[a-z]{2,8}$^", strtolower($email)))

            return true;
         else
            return false;
    }

}