<?php

namespace App\Model;

class ProdutoDao {
    public function create(Produto $p) {
        $sql = 'INSERT INTO despesas (titulo, descricao, valor, data, pago, usuario) VALUES (?, ?, ?, ?, ?, ?)';

        $stmt = Conexão::getConn()->prepare($sql);
        $stmt->bindValue(1, $p->getTitulo());
        $stmt->bindValue(2, $p->getDescri());
        $stmt->bindValue(3, $p->getValor());
        $stmt->bindValue(4, $p->getData());
        $stmt->bindValue(5, $p->getPago());
        $stmt->bindValue(6, $p->getUsuario());
        $stmt->execute();
    }

    public function read() {
        $sql = 'SELECT * FROM despesas';

        $stmt = Conexão::getConn()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0):
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        else:
            return [];
        endif;
    }

    public function update(Produto $p) {
        $sql = 'UPDATE despesas SET titulo = ?, descricao = ?, valor = ?, data = ?, pago = ?, usuario = ? WHERE id = ?';

        $stmt = Conexão::getConn()->prepare($sql);
        $stmt->bindValue(1, $p->getTitulo());
        $stmt->bindValue(2, $p->getDescri());
        $stmt->bindValue(3, $p->getValor());
        $stmt->bindValue(4, $p->getData());
        $stmt->bindValue(5, $p->getPago());
        $stmt->bindValue(6, $p->getUsuario());
        $stmt->bindValue(7, $p->getId());

        $stmt->execute();
    }

    public function pagar(Produto $p) {
        $sql = 'UPDATE despesas SET pago = ? WHERE id = ?';

        $stmt = Conexão::getConn()->prepare($sql);
        $stmt->bindValue(1, $p->getPago());
        $stmt->bindValue(2, $p->getId());

        $stmt->execute();
    }

    public function delete($id) {
        $sql = 'DELETE FROM despesas WHERE id = ?';
        $stmt = Conexão::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}