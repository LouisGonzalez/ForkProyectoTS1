/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package modelos.database;

import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;
import modelos.objetos.Energia;

/**
 *
 * @author jose_
 */
public class EnergiaDb {

    public void crear(Energia energia){
        try {
            PreparedStatement statement = ConexionDb.conexion.prepareStatement("INSERT INTO Energia "
                    + "(nombre) VALUES (?);");
            statement.setString(1, energia.getNombre());
            statement.executeUpdate();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
    }
    
    public void modificar(Energia energia){
        try {
            PreparedStatement statement = ConexionDb.conexion.prepareStatement("UPDATE Energia SET "
                    + "nombre=? WHERE id=?;");
            statement.setString(1, energia.getNombre());
            statement.setInt(2, energia.getId());
            statement.executeUpdate();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
    }
    
    public void eliminar (Energia energia){
        try {
            PreparedStatement statement = ConexionDb.conexion.prepareStatement("DELETE FROM Energia WHERE id=?;");
            statement.setInt(1, energia.getId());
            statement.executeUpdate();
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
    }
    
    public List<Energia> getEnergias(){
        List<Energia> energias = new ArrayList();
        try {
            PreparedStatement statement = ConexionDb.conexion.prepareStatement("SELECT * FROM Energia;");
            ResultSet resultado = statement.executeQuery();
            while(resultado.next()) energias.add(instanciarDeResultSet(resultado));
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return energias;
    }
    
    public Energia getEnergia(int id) {
        try {
            PreparedStatement statement = ConexionDb.conexion.prepareStatement("SELECT * FROM Energia WHERE id=?;");
            statement.setInt(1, id);
            ResultSet resultado = statement.executeQuery();
            if(resultado.next()) return instanciarDeResultSet(resultado);
        } catch (SQLException ex) {
            ex.printStackTrace();
        }
        return null;
    }
    
    private Energia instanciarDeResultSet(ResultSet resultado) throws SQLException{
        return new Energia(
                resultado.getInt("id"),
                resultado.getString("nombre")
        );
    }
}