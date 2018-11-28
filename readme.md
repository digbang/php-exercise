# Digbang Technical Challenge

Bienvenido a #Digbang Technical Challenge.
Te desafiamos a resolver este ejercicio programando en PHP>= 7.1. No te preocupes, sólo queremos conocerte a nivel técnico, explorar tus conocimientos y tu forma de pensar. 
Hacé lo más que puedas y de la mejor forma que sepas hacerlo. Si tenés alguna duda respecto a alguno de los puntos, tomá la decisión que consideres mas acorde.

Si te parece que podés agregar alguna funcionalidad o mejorar alguno de los casos, podes hacerlo sin problemas. Te pedimos que detalles con algún comentario, cual es el agregado y por qué lo hiciste.

El nombramiento en el codigo debe ser en ingles.


### ¿Cómo envío mi desafío?

Envianos, por mail, un link a un repositorio accesible públicamente.



### ¿Cómo utilizo el codigo provisto?

Si lo desea, puede utilizar [Docker](https://www.docker.com/products/docker-desktop) para levantar un ambiente con PHP y Composer (ver instrucciones al final) y ejecutar los tests provistos para utilizarlos como guia de las clases y metodos que debe implementar.


### Detalle
Un banco posee diferentes tipos de clientes y diferentes tipos de cuentas. 
Se pide:
* Generar las clases necesarias para representar los diferentes tipos de clientes **Multinacional**, **Pyme** y **Persona**. Cada cliente podrá tener una o más cuentas asociadas.

* Generar las clases necesarias para representar los diferentes tipos de cuentas **Classic** y **Gold**. El proximo semestre, el banco estará ampliando su cartera de productos.

* Las propiedades de las cuentas serán: Balance, Transacciones.
Cada transaccion consta de: 
    * Descripción
    * Tipo (Débito, Crédito)
    * Monto
    * Fecha/Hora
    * Origen (Banelco, Link, En Persona)

* Las cuentas deberán poder hacer movimientos según las siguientes reglas de negocio:
    * Para cuentas personales, el banco no retiene nada.
    * Debitar:
        * **Classic**: Si la transacción es desde un cajero BANELCO, debe debitar un 0.05% más. De LINK un 0.1% más. Desde CAJA no se agrega importe extra.
        * **Gold**: Desde BANELCO y CAJA no se agrega importe extra. Desde Link un 0.05% más.
    * Acreditar: 
        * El banco se queda con un 0.05% si es **Classic**.
        * Se queda con un 0.03% si es **Gold**, salvo que se esté acreditando 25.000 o más.


* Una vez por mes, el banco debe cobrar por sus servicios a los clientes. Programar un servicio que calcule los servicios a cobrar:
    * Si el cliente tiene cuenta **Classic**, el banco cobra, por cuenta, un monto fijo de $100 para **Personas** y $1000 para **empresas**.
    * Si el cliente tiene cuenta **Gold**, el banco cobra por cada débito realizado: 0.05% si es una cuenta **Persona**, 0.1% si la cuenta es **Pyme** y 0.5% si la cuenta es **Multinacional**.

## Uso de tests en Docker
1. `docker run -ti -v .:/code alexwijn/docker-git-php-composer bash`
2. `cd /code`
3. `composer install`
4. `vendor/bin/phpspec run`