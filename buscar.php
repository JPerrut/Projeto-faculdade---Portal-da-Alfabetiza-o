<?php
include 'conexao.php';

/**
 * Busca dados de uma tabela com condições opcionais.
 *
 * @param string $table Nome da tabela.
 * @param string $columns Colunas a serem buscadas.
 * @param array|null $where Condições (exemplo: ['id_empresa' => $id]).
 * @param mysqli $conn Conexão do banco de dados.
 * @return mysqli_result|false Resultado da consulta ou false em caso de erro.
 */
function fetchData($table, $columns, $where = null, $conn) {
    $sql = "SELECT $columns FROM $table";
    if ($where) {
        $conditions = [];
        foreach ($where as $column => $value) {
            $conditions[] = "$column = ?";
        }
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $stmt = $conn->prepare($sql);
    if ($where) {
        $types = str_repeat("s", count($where)); // Assume strings; ajuste conforme necessário
        $stmt->bind_param($types, ...array_values($where));
    }

    $stmt->execute();
    return $stmt->get_result();
}

/**
 * Gera uma tabela HTML dinamicamente a partir dos resultados do banco.
 *
 * @param mysqli_result $result Resultado da consulta.
 * @return string HTML da tabela.
 */
function generateTable($result) {
    if ($result->num_rows == 0) {
        return "<p>Nenhum dado encontrado.</p>";
    }

    $table = "<table>";
    $table .= "<tr>";
    $columns = array_keys($result->fetch_assoc());
    $result->data_seek(0); // Volta ao início dos resultados
    foreach ($columns as $column) {
        $table .= "<th>" . htmlspecialchars($column) . "</th>";
    }
    $table .= "<th>Ações</th></tr>";

    while ($row = $result->fetch_assoc()) {
        $table .= "<tr>";
        foreach ($columns as $column) {
            $table .= "<td>" . htmlspecialchars($row[$column]) . "</td>";
        }
        // Botão de edição dinâmico
        $table .= "<td><a href='edit.php?id=" . htmlspecialchars($row['id']) . "&table=" . $_GET['table'] . "'>Editar</a></td>";
        $table .= "</tr>";
    }
    $table .= "</table>";

    return $table;
}



