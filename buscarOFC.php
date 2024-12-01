<?php
include 'conexaoOFC.php';
/**
 * Busca dados de uma tabela com condições opcionais.
 *
 * @param string $table Nome da tabela.
 * @param string $columns Colunas a serem buscadas.
 * @param array|null $where Condições (exemplo: ['id_empresa' => $id]).
 * @param mysqli $conn Conexão do banco de dados.
 * @return mysqli_result|false Resultado da consulta ou false em caso de erro.
 */ 

function fetchData($tableName, $columns, $where = null, $conn) {
    $sql = "SELECT $columns FROM $tableName";
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

function generateTable($result, $tableName, $columns) {
    if ($result->num_rows == 0) {
        return "<p>Nenhum dado encontrado.</p>";
    }

    if (is_string($columns)) {
        $columns = explode(',', $columns); // Garante que seja um array
    }

    // Verificar se o botão de funcionários deve ser exibido
    $showEmployees = isset($_GET['showEmployees']) ? filter_var($_GET['showEmployees'], FILTER_VALIDATE_BOOLEAN) : true;

    $table = "<table>";
    $table .= "<tr>";

    // Adicionar cabeçalhos das colunas principais
    $resultColumns = array_keys($result->fetch_assoc());
    $result->data_seek(0); // Retorna ao início dos resultados
    
    foreach ($resultColumns as $column) {
        // Verifica se a coluna é `id_empresa` e omite se estiver exibindo funcionários
        if ($tableName !== 'funcionarios' || $column !== 'id_empresa') {
            $table .= "<th>" . htmlspecialchars($column) . "</th>";
        }
    }

    // Adicionar cabeçalho da coluna "Editar"
    $table .= "<th>Editar</th>";

    // Adicionar cabeçalho da coluna "Funcionários" apenas se necessário
    if ($showEmployees && $tableName === 'empresas') {
        $table .= "<th>Funcionários</th>";
    }

    $table .= "</tr>";

    // Adicionar dados das linhas
    while ($row = $result->fetch_assoc()) {
        $table .= "<tr>";
        foreach ($columns as $column) {
            // Verifica se a coluna é `id_empresa` e omite se estiver exibindo funcionários
            if ($tableName !== 'funcionarios' || $column !== 'id_empresa') {
                $table .= "<td>" . htmlspecialchars($row[$column]) . "</td>";
            }
        }

        // Adicionar célula de edição
        if ($tableName === 'funcionarios') {
            $table .= "<td><a href='edita.php?"
                . "id=" . htmlspecialchars($row['id_funcionario'])
                . "&table=" . htmlspecialchars($tableName)
                . "&columns=" . htmlspecialchars(implode(',', $columns))
                . "&id_empresa=" . htmlspecialchars($row['id_empresa'])
                . "'>Editar</a></td>";
        } elseif ($tableName === 'empresas') {
            $table .= "<td><a href='edita.php?"
                . "id=" . htmlspecialchars($row['id_empresa']) // Corrige para empresas
                . "&table=" . htmlspecialchars($tableName)
                . "&columns=" . htmlspecialchars(implode(',', $columns))
                . "'>Editar</a></td>";
        }

        // Adicionar célula de funcionários apenas se necessário
        if ($showEmployees && $tableName === 'empresas') {
            $table .= "<td><a href='admin_funcionariosOFC.php?id_empresa=" . htmlspecialchars($row['id_empresa']) . "&showEmployees=false'>Ver Funcionários</a></td>";
        }

        $table .= "</tr>";
    }
    $table .= "</table>";

    return $table;
}







