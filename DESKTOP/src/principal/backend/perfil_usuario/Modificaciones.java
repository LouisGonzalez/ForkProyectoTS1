/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package principal.backend.perfil_usuario;

import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.logging.Level;
import java.util.logging.Logger;
import modelos.database.ConexionDb;
import modelos.objetos.Usuario;

/**
 *
 * @author luisGonzalez
 */
public class Modificaciones {
    
    private static String CADENA = "UPDATE usuario SET email = ?,nombre = ?,apellido = ?, telefono = ? WHERE username = ?";
    
    public void modificarDatos(Usuario user){
        try {
            PreparedStatement statement = ConexionDb.conexion.prepareStatement(CADENA);
            statement.setString(1, user.getEmail());
            statement.setString(2, user.getNombre());
            statement.setString(3, user.getApellido());
            statement.setString(4, user.getTelefono());
            statement.setString(5, user.getUsername());
            statement.executeUpdate();
        } catch (SQLException ex) {
            Logger.getLogger(Modificaciones.class.getName()).log(Level.SEVERE, null, ex);
        }
        
    }
    
}
