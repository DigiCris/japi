package com.api.crud;

import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

@RestController
@RequestMapping("/api/orders")
public class OrderController {

    @GetMapping
    public String getOrders() {
        try {
            // Cargar el driver de MySQL
            Class.forName("com.mysql.cj.jdbc.Driver");

            // Conectarse a la base de datos
            String url = "jdbc:mysql://localhost:3306/curs_flashivery";
            String usuario = "root";
            String contrasena = "";
            Connection conexion = DriverManager.getConnection(url, usuario, contrasena);

            // Crear una consulta SQL
            String consulta = "SELECT " +
                    "  `id`, " +
                    "  `shop`, " +
                    "  `shopId`, " +
                    "  `order`, " +
                    "  `shipDate`, " +
                    "  `Status`, " +
                    "  `price`, " +
                    "  `pickAddress`, " +
                    "  `deliveryAddress`, " +
                    "  `quarrelDescription`, " +
                    "  `quarrelPicture`, " +
                    "  `reviewDescription`, " +
                    "  `reviewLevel`, " +
                    "  `deliveryId`, " +
                    "  `deliveryMoney`, " +
                    "  `userId` " +
                    "FROM `order`";
            Statement declaracion = conexion.createStatement();
            ResultSet resultado = declaracion.executeQuery(consulta);

            // Crear un objeto JSON con los resultados
            JsonArray ordenesJSON = new JsonArray();
            while (resultado.next()) {
                JsonObject ordenJSON = new JsonObject();
                ordenJSON.addProperty("id", resultado.getInt("id"));
                ordenJSON.addProperty("shop", resultado.getString("shop"));
                ordenJSON.addProperty("shopId", resultado.getInt("shopId"));
                ordenJSON.addProperty("order", resultado.getString("order"));
                ordenJSON.addProperty("shipDate", resultado.getString("shipDate"));
                ordenJSON.addProperty("Status", resultado.getString("Status"));
                ordenJSON.addProperty("price", resultado.getString("price"));
                ordenJSON.addProperty("pickAddress", resultado.getString("pickAddress"));
                ordenJSON.addProperty("deliveryAddress", resultado.getString("deliveryAddress"));
                ordenJSON.addProperty("quarrelDescription", resultado.getString("quarrelDescription"));
                ordenJSON.addProperty("quarrelPicture", resultado.getString("quarrelPicture"));
                ordenJSON.addProperty("reviewDescription", resultado.getString("reviewDescription"));
                ordenJSON.addProperty("reviewLevel", resultado.getInt("reviewLevel"));
                ordenJSON.addProperty("deliveryId", resultado.getInt("deliveryId"));
                ordenJSON.addProperty("deliveryMoney", resultado.getString("deliveryMoney"));
                ordenJSON.addProperty("userId", resultado.getInt("userId"));
                ordenesJSON.add(ordenJSON);
            }

            JsonObject respuestaJSON = new JsonObject();
            respuestaJSON.add("ordenes", ordenesJSON);

            // Convertir el objeto JSON a una cadena JSON
            Gson gson = new Gson();
            return gson.toJson(respuestaJSON);

        } catch (Exception e) {
            return "Error: " + e.getMessage();
        }
    }
}