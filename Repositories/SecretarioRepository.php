<?php
namespace Repositories;

use Lib\BaseDatos;
use Models\Secretario;

class SecretarioRepository {
    private BaseDatos $conexion;

    // Constructor que inicializa la conexión a la base de datos
    public function __construct() {
        $this->conexion = new BaseDatos();
    }

    // Método para realizar el login del secretario
public function login(string $email, string $password): ?Secretario {
    // Consulta SQL para obtener el secretario por su correo
    $sql = "SELECT * FROM secretarios WHERE email = :email";
    $result = $this->conexion->fetchAll($sql, [':email' => $email]);

    // Si se encuentran resultados, verifica la contraseña
    if (count($result) > 0) {
        $secretario = $result[0];
        
        // Verifica si la contraseña coincide
        if (password_verify($password, $secretario['password'])) {
            // Crear cookie de sesión con ID del secretario
            setcookie('secretario_id', $secretario['id'], time() + 3600, "/", "", false, true);

            // Retorna un objeto Secretario
            return new Secretario(
                nombre: $secretario['nombre'],
                email: $secretario['email'],
                password: $secretario['password'],
                id: $secretario['id']
            );
        }
    }

    // Retorna null si el login falla
    return null;
}

}
?>
