package com.api.crud;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonObject;
import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

public class Create {
	public static void main(String[] args) {
		try {
			// Crear el servidor HTTP en el puerto 8080
			HttpServer server = HttpServer.create(new InetSocketAddress(8080), 0);
			server.createContext("/", new JsonHandler());
			server.setExecutor(null); // usar el thread pool predeterminado
			server.start();
			System.out.println("Servidor iniciado en http://localhost:8080/");
		} catch (IOException e) {
			e.printStackTrace();
		}
	}

	static class JsonHandler implements HttpHandler {
		@Override
		public void handle(HttpExchange exchange) throws IOException {
			if (exchange.getRequestMethod().equalsIgnoreCase("POST")) {
				// Leer el cuerpo de la solicitud
				BufferedReader reader = new BufferedReader(new InputStreamReader(exchange.getRequestBody()));
				StringBuilder requestBody = new StringBuilder();
				String line;
				while ((line = reader.readLine()) != null) {
					requestBody.append(line);
				}

				// Parsear el JSON
				Gson gson = new Gson();
				JsonObject jsonObject = gson.fromJson(requestBody.toString(), JsonObject.class);

				// Procesar la solicitud según el valor de la variable "method"
				String method = jsonObject.get("method").getAsString();
				String id = jsonObject.get("id").getAsString();
				String response;
				switch (method) {
					case "setAll":
						response = setAll(jsonObject);
						break;
					case "deleteById":
						response = deleteById(id);
						break;
					case "updateAllById":
						response = updateAllById(jsonObject);
						break;
					default:
						response = getAll();
						break;
				}

				// Enviar la respuesta
				exchange.sendResponseHeaders(200, response.length());
				OutputStream os = exchange.getResponseBody();
				os.write(response.getBytes());
				os.flush();
				os.close();
			} else {
				exchange.sendResponseHeaders(400, 0);
				OutputStream os = exchange.getResponseBody();
				os.close();
			}
		}

		private static String setAll(JsonObject jsonObject) {
			String shop = jsonObject.get("shop").getAsString();
			String shopId = jsonObject.get("shopId").getAsString();
			String order = jsonObject.get("order").getAsString();
			String shipDate = jsonObject.get("shipDate").getAsString();
			String status = jsonObject.get("Status").getAsString();
			String price = jsonObject.get("price").getAsString();
			String pickAddress = jsonObject.get("pickAddress").getAsString();
			String deliveryAddress = jsonObject.get("deliveryAddress").getAsString();
			String quarrelDescription = jsonObject.get("quarrelDescription").getAsString();
			String quarrelPicture = jsonObject.get("quarrelPicture").getAsString();
			String reviewDescription = jsonObject.get("reviewDescription").getAsString();
			String reviewLevel = jsonObject.get("reviewLevel").getAsString();
			String deliveryId = jsonObject.get("deliveryId").getAsString();
			String deliveryMoney = jsonObject.get("deliveryMoney").getAsString();
			String userId = jsonObject.get("userId").getAsString();

			try (Connection connection = DriverManager.getConnection("jdbc:mysql://localhost:3306/curs_flashivery",
					"root",
					"");
					PreparedStatement statement = connection.prepareStatement(
							"INSERT INTO `order` (shop, shopId, `order`, shipDate, status, price, pickAddress, deliveryAddress, quarrelDescription, quarrelPicture, reviewDescription, reviewLevel, deliveryId, deliveryMoney, userId) "
									+
									"VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {

				statement.setString(1, shop);
				statement.setString(2, shopId);
				statement.setString(3, order);
				statement.setString(4, shipDate);
				statement.setString(5, status);
				statement.setString(6, price);
				statement.setString(7, pickAddress);
				statement.setString(8, deliveryAddress);
				statement.setString(9, quarrelDescription);
				statement.setString(10, quarrelPicture);
				statement.setString(11, reviewDescription);
				statement.setString(12, reviewLevel);
				statement.setString(13, deliveryId);
				statement.setString(14, deliveryMoney);
				statement.setString(15, userId);

				int rowsInserted = statement.executeUpdate();

				if (rowsInserted > 0) {
					return "Método setAll ejecutado correctamente";
				} else {
					return "No se pudo insertar la orden en la base de datos";
				}
			} catch (SQLException e) {
				e.printStackTrace();
				return "Error al insertar la orden en la base de datos: " + e.getMessage();
			}
		}

		private static String deleteById(String id) {
			try {
				// Cargar el driver de MySQL
				Class.forName("com.mysql.cj.jdbc.Driver");

				// Conectarse a la base de datos
				String url = "jdbc:mysql://localhost:3306/curs_flashivery";
				String usuario = "root";
				String contrasena = "";
				Connection conexion = DriverManager.getConnection(url, usuario, contrasena);

				// Crear una consulta SQL para eliminar la fila
				String consulta = "DELETE FROM `order` WHERE id = ?";
				PreparedStatement declaracion = conexion.prepareStatement(consulta);
				declaracion.setString(1, id);
				int filasAfectadas = declaracion.executeUpdate();

				// Crear una respuesta JSON
				JsonObject respuestaJSON = new JsonObject();
				if (filasAfectadas > 0) {
					respuestaJSON.addProperty("mensaje", "Fila eliminada correctamente");
				} else {
					respuestaJSON.addProperty("mensaje", "No se encontró la fila con el ID especificado");
				}

				// Convertir el objeto JSON a una cadena JSON
				Gson gson = new Gson();
				String jsonString = gson.toJson(respuestaJSON);
				String response = jsonString;

				declaracion.close();
				conexion.close();

				return response;

			} catch (ClassNotFoundException e) {
				return ("Error al cargar el driver: " + e.getMessage());
			} catch (SQLException e) {
				return ("Error de SQL: " + e.getMessage());
			}
		}

		private static String updateAllById(JsonObject jsonObject) {
			return "updateAllById";
		}

		private static String getAll() {

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
				resultado.close();
				declaracion.close();
				conexion.close();

				// Mostrar el JSON
				return response;

			} catch (ClassNotFoundException e) {
				return ("Error al cargar el driver: " + e.getMessage());
			} catch (SQLException e) {
				return ("Error de SQL: " + e.getMessage());
			}

		}

	}
}