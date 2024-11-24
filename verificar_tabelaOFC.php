<?php

if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
    // Administrador pode acessar tudo
    $where = null;
} else {
    // Usuário comum pode acessar apenas dados relacionados ao id_empresa
    $where = isset($id_empresa) 
        ? ['id_empresa' => $id_empresa] 
        : null; // Define como null se não houver id_empresa na sessão
}
// Buscar os dados
$result = fetchData($table, $columns, $where, $conn);
  