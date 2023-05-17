<?php

namespace Model;

class Paciente extends ActiveRecord
{
    protected static $tabla = 'paciente';
    protected static $columnasDB = [];

    public $id;
    public $nombre;
    public $apellidoPaterno;
    public $apellidoMaterno;
    public $fechaDeNacimiento;
    
    public $edad;
    public $sexo;
    public $curp;
    public $domicilio;
    public $telefono;

    public $email;
    public $semanasGestacion;
    public $indiceMasaCorporal;
    public $consejeria;
    public $metodoPlanificacionFamiliar;

    public $diagnosticoReferencia;
    public $diagnosticoAgregado;
    public $diagnosticoAltoRiesgo;
    public $unidadSalud;
    public $unidadReferencia;

    public $servicioEnvio;
    public $medicoQueRefiere;
    public $motivoDeEnvio;
    public $presionArterial;
    public $temperatura;

    public $frecuenciaRespiratoria;
    public $frecuenciaCardiaca;
    public $peso;
    public $talla;
    public $resumenClinico;

    public $diagnosticoContrarreferencia;
    public $apeo;
    public $fechaVisita;
    public $fechaReferencia;
    public $fechaContrarreferencia;

    public $fechaCita;
    public $horaCita;


    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->apellidoPaterno = $args['apellidoPaterno'] ?? null;
        $this->apellidoMaterno = $args['apellidoMaterno'] ?? null;
        $this->fechaDeNacimiento = $args['fechaDeNacimiento'] ?? null;

        $this->edad = $args['edad'] ?? null;
        $this->sexo = $args['sexo'] ?? null;
        $this->curp = $args['curp'] ?? null;
        $this->domicilio = $args['domicilio'] ?? null;
        $this->telefono = $args['telefono'] ?? null;

        $this->email = $args['email'] ?? null;
        $this->semanasGestacion = $args['semanasGestacion'] ?? null;
        $this->indiceMasaCorporal = $args['indiceMasaCorporal'] ?? null;
        $this->consejeria = $args['consejeria'] ?? null;
        $this->metodoPlanificacionFamiliar = $args['metodoPlanificacionFamiliar'] ?? null;

        $this->diagnosticoReferencia = $args['diagnosticoReferencia'] ?? null;
        $this->diagnosticoAgregado = $args['diagnosticoAgregado'] ?? null;
        $this->diagnosticoAltoRiesgo = $args['diagnosticoAltoRiesgo'] ?? null;
        $this->unidadSalud = $args['unidadSalud'] ?? null;
        $this->unidadReferencia = $args['unidadReferencia'] ?? null;

        $this->servicioEnvio = $args['servicioEnvio'] ?? null;
        $this->medicoQueRefiere = $args['medicoQueRefiere'] ?? null;
        $this->motivoDeEnvio = $args['motivoDeEnvio'] ?? null;
        $this->presionArterial = $args['presionArterial'] ?? null;
        $this->temperatura = $args['temperatura'] ?? null;

        $this->frecuenciaRespiratoria = $args['frecuenciaRespiratoria'] ?? null;
        $this->frecuenciaCardiaca = $args['frecuenciaCardiaca'] ?? null;
        $this->peso = $args['peso'] ?? null;
        $this->talla = $args['talla'] ?? null;
        $this->resumenClinico = $args['resumenClinico'] ?? null;


        $this->diagnosticoContrarreferencia = $args['diagnosticoContrarreferencia'] ?? null;
        $this->apeo = $args['apeo'] ?? null;
        $this->fechaVisita = $args['fechaVisita'] ?? null;
        $this->fechaReferencia = $args['fechaReferencia'] ?? null;
        $this->fechaContrarreferencia = $args['fechaContrarreferencia'] ?? null;

        $this->fechaCita = $args['fechaCita'] ?? null;
        $this->horaCita = $args['horaCita'] ?? null;
    }


    


}