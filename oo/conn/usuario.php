<?php
namespace conn;

class Produto {

    private $id, $titulo, $descrição, $valor, $data, $pago, $usuario;

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getTitulo() {
        return $this->titulo;
    }
    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getDescri() {
        return $this->descrição;
    }
    public function setDescri($descrição) {
        $this->descrição = $descrição;
    }

    public function getValor() {
        return $this->valor;
    }
    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getData() {
        return $this->data;
    }
    public function setData($data) {
        $this->data = $data;
    }

    public function getPago() {
        return $this->pago;
    }
    public function setPago($pago) {
        $this->pago = $pago;
    }

    public function getUsuario() {
        return $this->usuario;
    }
    public function setUsuario($usu) {
        $this->usuario = $usu;
    }
}