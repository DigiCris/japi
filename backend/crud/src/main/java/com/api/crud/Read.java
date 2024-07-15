package com.api.crud;

import java.io.IOException;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.sql.*;
import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

public class Read {
	public static void main(String[] args) {
		try {
			// Crear el servidor HTTP en el puerto 8080
			HttpServer server = HttpServer.create(new InetSocketAddress(8080), 0);
			server.createContext("/", new HelloWorldHandler());
			server.setExecutor(null); // usar el thread pool predeterminado
			server.start();
			System.out.println("Servidor iniciado en http://localhost:8080/");
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	static class HelloWorldHandler implements HttpHandler {
		@Override
		public void handle(HttpExchange exchange) throws IOException {

			try {
				// Cargar el driver de MySQL
				Class.forName("com.mysql.cj.jdbc.Driver");

				// Conectarse a la base de datos
				String url = "jdbc:mysql://localhost:3306/curs_flashivery";
				String usuario = "root";
				String contrasena = "";
				Connection conexion = DriverManager.getConnection(url, usuario, contrasena);

				// Crear una consulta SQL
				String consulta = "SELECT *FROM `order`";
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
				String jsonString = gson.toJson(respuestaJSON);
				String response = jsonString;

				// Mostrar el JSON
				System.out.println(jsonString);

				// String response = "Hola mundo";
				exchange.sendResponseHeaders(200, response.length());
				OutputStream os = exchange.getResponseBody();
				os.write(response.getBytes());
				os.flush();
				os.close();

				// Cerrar la conexión
				resultado.close();
				declaracion.close();
				conexion.close();

			} catch (ClassNotFoundException e) {
				System.out.println("Error al cargar el driver: " + e.getMessage());
			} catch (SQLException e) {
				System.out.println("Error de SQL: " + e.getMessage());
			}

		}
	}
}