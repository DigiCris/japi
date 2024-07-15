package com.api.crud;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.InetSocketAddress;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
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
			return "setall";
		}

		private static String deleteById(String id) {
			return "Eliminar por ID: " + id;
		}

		private static String updateAllById(JsonObject jsonObject) {
			return "updateAllById";
		}

		private static String getAll() {
			return "get";
		}
	}
}