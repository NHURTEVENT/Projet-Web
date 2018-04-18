<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 18/04/2018
 * Time: 09:55
 */

namespace App\Controller;


class API
{ }
//initialize the request
//    function __construct()
//    {
//        $this->reqArgs();
//
//    }
//
//    // provides the response
//    function reqArgs()
//    {
//        // get the HTTP method, path and body of the request
//        $method = $_SERVER['REQUEST_METHOD'];
//
//        $this
//
//        $request = explode('/',trim($_SERVER['PATH_INFO'],'/'));
//        var_dump($request);
//        $input = json_decode(file_get_contents('php://input'),true);
//        var_dump($input);
//
//
//
//        if ($request){
//
//            // retrieve the table and key from the path
//            $table = str_replace("''","",$request[0]);
//            $key =  str_replace("'","",$request[1]);
//            //var_dump($table);
//            //var_dump($key);
//        }
//
//        if ($input)
//        {
//
//            // escape the columns and values from the input object
//            $columns =array_keys($input);
//            $values = array_values($input);
//            //var_dump($columns);
//            //var_dump($values);
//
//
//            // build the SET part of the SQL command
//            //$set = 'INSERT INTO '.$table."";
//            $set = array('columns'=>$columns,'values'=>$values);
//        }
//
//        if($method){
//            $bdd = new BDD();
//
//            switch ($method){
//
//                case 'GET' :
//                    $result = $bdd->getAction($table,$key);
//                    break;
//
//                case 'POST' :
//                    $result = $bdd->postAction($table,$set);
//                    break;
//                case 'PUT' :
//                    $result = $bdd->putAction($table,$key,$set);
//                    break;
//
//                case 'DELETE' :
//                    $result = $bdd->deleteAction($table,$key);
//                    break;
//                default:
//                    throw new Exception("Unsuported http method Exception",1);
//                    break;
//            }
//
//            echo json_encode($result);
//            //TODO You'd better to use a switch Method ;) <-that's simply not english
//        }
//    }
//}
//
//new API();
