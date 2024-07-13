Variables a usar de la tabla de order:

id = Identificador del pedido (para identificarlo y hacerle delete o update)
userId = Id del usuario que encarga el pedido (Para hacer la lectura por usuario)
price = cuanto vale la hamburguesa (Para tener el precio de lo que se compra)
order = Hamburguesa (Para saber que se está comprando)
shopId= cuantas hamburguesas (Para saber cuantas vamos a pedir)
quarrelPicture = url con la imagen de la hamburguesa (para saber que foto mostrar)

shopId y quarrelPicture tienen nombres raros porque estamos reutilizando los campos

Endpoints que necesitamos:

createOrder
readOrderByUserId
updateOrderById
deleteOrderById