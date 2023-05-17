<?php

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);

            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                //comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario){
                    //verificar el password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //Autenticar el usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellidoPaterno . " " . $usuario->apellidoMaterno;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //Redireccionamiento
                        if($usuario->admin === "1") {
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: ./admin');
                        }else{
                            header('Location: ./cita');
                        }

                        

                    }
                }else{
                    Usuario::setAlerta('error', 'usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();


        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];

        header('Location: ./');
    }

    public static function olvide(Router $router) {

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            
            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);

                if($usuario && $usuario->confirmado === "1"){
                    //General un Token
                    $usuario->crearToken();
                    $usuario->guardar();

                    //TODO: Enviar email

                    //Enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();



                    //Alerta exito
                    Usuario::setAlerta('exito', 'Revisa tu email');
                }else{
                    Usuario::setAlerta('error', ' El usuario no existe o no esta confirmado');
                    
                }

            }
        }


        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-password', [
            'alertas' => $alertas

        ]);


    }

    public static function recuperar(Router $router){
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);


        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('error', 'Token no valido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Leer el nuevo password y guardarlo

            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)) {
                $usuario->password = null;
                
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: ./');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error' => $error

        ]);
    }

    public static function crear(Router $router){
        $usuario = new Usuario($_POST);

        //alertas vacias
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alerta este vacio

            if(empty($alertas)){
                //Verificar que le usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                }else {
                    //hasehar el password
                    $usuario->hashPassword();

                    //generar un token único
                    $usuario->crearToken();

                    //enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();


                    //crear el usuario
                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: ./mensaje');
                    }


                    //No esta registrado
                    
                }
            }

        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){
        $alertas = [];
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no valido');
        } else {
            $usuario->confirmado = "1";
            $usuario->token = "null";
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Comprobada Correctamente');
        }

        $alertas = Usuario::getAlertas();

        //Renderizar la vista
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas ?? [],

        
            
        ]);
    }




}