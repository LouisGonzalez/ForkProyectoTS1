/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package principal.backend.ruedaCalendarica;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.time.LocalDate;
import java.util.Date;
import java.util.Locale;
import java.util.concurrent.TimeUnit;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.Icon;
import javax.swing.JLabel;
import modelos.database.FechaHaabDb;
import modelos.database.Utilidades;
import modelos.objetos.FechaHaab;

/**
 *
 * @author luisGonzalez
 */
public class CalculoFechas {
    
    private Date fecha = Utilidades.LocalDateToDate(LocalDate.now());
    private static CalculoFechas manejador;
    
    public static CalculoFechas getInstancia(){
        if(manejador == null){
            manejador = new CalculoFechas();
        }
        return manejador;
    }
    
    public Icon getIcon(int caso){
        return(new javax.swing.ImageIcon(getClass().getResource("/com/imagenesNahualesMayas/Nahual" + caso + ".jpg")));
    }
    
    public Icon getIconLvl(int caso){
        return(new javax.swing.ImageIcon(getClass().getResource("/com/imagenesNumerosMayas/numero" + caso + ".jpg")));
    }
    
    public int nahual(int cont){
        int contador = cont;
        int contadorNahual = 6;
        if(contador < 0){
            while (contador != 0) {                
                if(contadorNahual == 20){
                    contadorNahual = 1;
                } else {
                    contadorNahual++;
                }
                contador++;
            } 
            return contadorNahual;
        }
        while (contador != 0) {            
            if(contadorNahual == 1){
                contadorNahual = 20;
            } else {
                contadorNahual--;
            }
            contador--;
        }
        return contadorNahual;
    }
    
    public int nivel(int cont){
        int contador = cont;
        int contadorNahual = 4;
        if(contador < 0){
            while(contador != 0){
                if(contadorNahual == 13){
                    contadorNahual = 1;
                } else {
                    contadorNahual++;
                }
                contador++;
            }
            return contadorNahual;
        }
        while (contador != 0) {            
            if(contadorNahual == 1){
                contadorNahual = 13;
            } else {
                    contadorNahual--;
            }
            contador--;       
        }
        return contadorNahual;
    }
    
    public int timeCholqij(long date){
        String cadena = "Nov 15, 2020 00:00:00 AM";
        SimpleDateFormat simple = new SimpleDateFormat("MMM d, yyy h:mm:ss a", Locale.ROOT);
        try {
            Date pivote = simple.parse(cadena);
            long regresar = TimeUnit.DAYS.convert(pivote.getTime() - date, TimeUnit.MILLISECONDS);
            return (int) regresar;
        } catch (ParseException ex) {
            Logger.getLogger(CalculoFechas.class.getName()).log(Level.SEVERE, null, ex);
        }
        return 1;
    }
    
    //PARTE DEL CALENDARIO HAAB
    
    public void escribirFecha(FechaHaabDb acceso, JLabel winal, JLabel mesHaab, JLabel nahual, JLabel diaHaab, Date fecha){
        FechaHaab fechaActual = acceso.getFechaEspecifica(Utilidades.DateToLocalDate(fecha));
        mesHaab.setText(fechaActual.getWinal().getNombre());
        diaHaab.setText(fechaActual.getNahual().getNombre());
        fechaActual.getWinal().getImagen().colocarImagen(winal);
        fechaActual.getNahual().getImagen().colocarImagen(nahual);
    }
}

