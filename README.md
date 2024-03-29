# Flashivery
Flashivery

## Backend
Acá dejo los llamados a la API que hay disponibles. Esta desplegado en: https://cursoblockchain.com.ar/flashivery/api/v1
En swagger.json pueden ver la documentacion en formato openAPI de representantes de cada estilo de endpoint para que vean como funciona.
Eso lo pueden cargar en el swagger editor y probar los llamados: https://cursoblockchain.com.ar/flashivery/api/v1/swagger-editor
El swagger.json tambien lo tienen subido a: https://cursoblockchain.com.ar/flashivery/api/v1/swagger.json
También existe un archivo postman.json para quien prefiera la documentacion en un postman, el mismo te genera llamados en el lenguaje que le solicites para copiar y pegar codigo.

Los datos sencibles están encriptados con RSA y por ahora para que los puedan leer sin problemas puse por defecto que se complete las claves privadas.
Si cualquiera quisiese subir esto a su servidor recuerden que tienen que cambiar los datos de la base de datos en el archivo de configuracion.

Ejemplo para un llamado get:
https://cursoblockchain.com.ar/flashivery/api/v1/user/getById/8
https://cursoblockchain.com.ar/flashivery/api/v1/sectors/getAll
https://cursoblockchain.com.ar/flashivery/api/v1/order/getByUserId/123

-user

	-create
		-setAll

	-read
		-getAll
		-getByAdmin
		-getByCity
		-getByCountry
		-getByEmail
		-getByFirstName
		-getById
		-getByKyc
		-getByLastName
		-getByPassword
		-getByPhone
		-getByPriceKm
		-getByRol
		-getByState
		-getByTarjeta
		-getByUsername
		-getByZona1
		-getByZona2
		-getByZona3
		-getByZona4

	-update
		-updateAdminById
		-updateEmailById
		-updateStateById
		-updateAllByCuenta
		-updateFirstNameById
		-updateTarjetaById
		-updateAllById
		-updateKycById
		-updateUsernameById
		-updateAllByKyc
		-updateLastNameById
		-updateZona1ById
		-updateAllByRol
		-updatePasswordById
		-updateZona2ById
		-updateAllByUsername
		-updatePasswordByUsername
		-updateZona3ById
		-updateCityById
		-updatePhoneById
		-updateZona4ById
		-updateCountryById
		-updatePriceKmById
		-updateCuentaById
		-updateRolById

	-delete
		-deleteAll
		-deleteByAdmin
		-deleteByCountry
		-deleteById
		-deleteByKyc
		-deleteByRol
		-deleteByUsername



-order

	-create
		-setAll

	-read
		-getAll
		-getByDeliveryAddress
		-getByDeliveryId
		-getByDeliveryMoney
		-getById
		-getByOrder
		-getByPickAddress
		-getByPrice
		-getByQuarrelDescription
		-getByQuarrelPicture
		-getByReviewDescription
		-getByReviewLevel
		-getByShipDate
		-getByShop
		-getByShopId
		-getByStatus
		-getByUserId

	-update
		-updateAllById
		-updateDeliveryAddressById
		-updateDeliveryIdById
		-updateDeliveryMoneyById
		-updateOrderById
		-updatePickAddressById
		-updatePriceById
		-updateQuarrelDescriptionById
		-updateQuarrelPictureById
		-updateReviewDescriptionById
		-updateReviewLevelById
		-updateShopByShopId
		-updateStatusById
		-updateUserIdById

	-delete
		-deleteAll
		-deleteById
		-deleteByShop
		-deleteByShopId
		-deleteByStatus
		-deleteByUserId



-Sectors

	-create
		-setAll

	-read
		-getAll
		-getById
		-getByMoreUsed
		-getBySectorsName

	-update
		-updateAllById
		-updateMoreUsedById
		-updateMoreUsedBySectorsName
		-updateSectorsNameById

	-delete
		-deleteAll
		-deleteById

